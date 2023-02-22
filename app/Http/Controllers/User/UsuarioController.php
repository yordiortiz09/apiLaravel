<?php
  
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\email2;
use App\Jobs\emails;
use App\Mail\SendMail;
use App\Mail\ContactanosMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use PhpParser\Node\Expr\Cast\String_;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Session;
use App\Jobs\mensajes;
use App\Jobs\sms;
use App\Jobs\eSendmail;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function info($id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        if (!$user) {
            return response()->json([
                "error" => "Usuario no encontrado"
            ], 404);
        }

        return response()->json([
            "table" => "users",
            "user" => $user
        ]);
    }
    
    //
    public function crearusuario(Request $request)
    {
       


        $validacion=Validator::make($request->all(),[
       'name'=>'required|string|max:255',
       'email'=>'required|string|email:rfc,dns|max:255|unique:users',
       'password'=>'required|string|min:8',
       'telefono'=>'required|numeric|digits:10|unique:users'

        ]);  
        if($validacion->fails()){
            return response()->json([
                "error"=>$validacion->errors()

            ],400);
        }
        srand (time());
        $numero_aleatorio= rand(5000,6000);
         $user=User::create([
'name'=>$request->name,
'email'=>$request->email,
'rol_id'=>3,
'status'=>0,
'password'=>Hash::make($request->password),
'telefono'=>$request->telefono,
'no°verificación'=>$numero_aleatorio
         ]);
          
           $token=$user->createToken("Token")->plainTextToken;
           $valor=$user->id;
          // eSendmail::dispatch('Solicitud','solicitud en espera');
           //$user2 = User::where('email', $request->email)->first();
           $url= URL::temporarySignedRoute(
            'validarnumero', now()->addMinutes(30), ['url' => $valor]
        );

      
          // dd($url);
         // sms::dispatch( Mail::to($request->email)->send(new SendMail($user,$url)));
       #Mail::to($request->email)->send(new SendMail($user,$url));
mensajes::dispatch($user,$url)->onQueue('mensajes')->onConnection('database')->delay(now()->addSeconds(10));
      

  
        return response()->json([
            "status"=>"Desactivado",
            "mensaje"=>"Se inserto de manera correcta",
            "error"=>[],
            "datos"=>$user->email,
            "Activacion"=>"Para activar su cuenta necesita confirmar en su correo electronico"
        ],201);
       

        
    
    }
  
   
    public $numerodeverificacion;

        Public function numerodeverificacionmovil(Request $request)
        {
            if (! $request->hasValidSignature()) {
                abort(401,"EL CODIGO ES INCORRECTO");
            }
           // srand (time());
            
      //  $numero_aleatorio2 = rand(5000,6000);

        $numeroiddelaurl= $request->url;

            //   $url= URL::temporarySignedRoute(
            //     'telefonoregistr', now()->addMinutes(30), ['url' => $numero_aleatorio2]
            // );

            $user = User::where('id', $numeroiddelaurl )->first();
            
            sms::dispatch($user)->onQueue('sms')->onConnection('database')->delay(now()->addSeconds(5));
            $correo=$user->email;
            email2::dispatch($user,$correo)->onQueue('mensajes')->onConnection('database')->delay(now()->addSeconds(3));
            
            $domain = substr($user->email, strpos($user->email, '@') + 1);
             
             
                           
                    
                    header("Status: 301 Moved Permanently");
                    header("Location:https://".$domain);
                    exit;
                    
            
                    
        }
       
        
        public function registrarSMS(Request $request)
        {
        //     if (! $request->hasValidSignature()) {
        //         abort(401,"EL CODIGO ES INCORRECTO");
        //     }
         
        
         $validacion=Validator::make($request->all(),[
          
             
            'codigo'=>'required|digits:4'
      
              ]);
              if($validacion->fails()){
                  return response()->json([
                      "error"=>$validacion->errors()
      
                  ],400);
                 }
                 $user = User::where('no°verificación', $request->codigo)->first();
         
                
                 if( $user->no°verificación==$request->codigo)
                 {

                
               //  $user = User::where('email', $request->confirm_mail)->first();
             //  $user=  Auth::check($request->token);
           //  dd($user);
                
                if (!$user)
                {
                    abort(401,"usuario no encontrado");
                }
                $id=$user->id;
                $userupdate = User::find($id);
               $userupdate->status=1;
               $userupdate->save;
               if ($userupdate ->save())               
                    return response()->json([
                        "mensage"=>"tu sessioncion a sido actualizada",
                        "usuario"=>$userupdate
        
                    ],201);
                }else
                {
                    return response()->json([
                        "mensage"=>"codigo invalido",
                        
        
                    ],401); 
                }
                 
        }
        

    public function InicioSesion(Request $request)
    {
        $validacion = Validator::make(
            $request->all(),
            [
                
                'email'=>'required|email',
                'password'=>'required',
            ]);

           if($validacion->fails()){
            return response()->json([
                'status'=>false,
                'mensaje'=>'Error de validacion',
                'error'=> $validacion->errors()
            ], 401);
           } 

           $user = User::where('email', $request->email)->first();
 
           if (! $user || ! Hash::check($request->password, $user->password)) {
               throw ValidationException::withMessages([
                   'email' => ['The provided credentials are incorrect.'],
               ]);
            }
               
            return response()->json([
                'status'=>true,
                'msg'=>"Inicio sesion correctamente",
                'user'=>$user,
                'token'=> $user->createToken("Token")->plainTextToken
            ],201);
        
        }
        public function logout(Request $request) {
            
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Cerraste sesion correctamente'],201);
        }
    }
    

