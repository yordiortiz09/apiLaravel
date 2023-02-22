<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Receta;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
 


class recetaController extends Controller
{
    public function create(Request $request)
    {

        $validacion = Validator::make($request->all(),[
            'nombre'=>'required|max:30',
            'duracion' =>'required|max:40',
            'preparacion' =>'required',
            'chef' =>'required',
            'ingrediente' => 'required',
            'tipo_plato' => 'required'
        ]);
        if($validacion->fails()){
            return response()->json([
                "Error"=>$validacion->errors()
            ],400);
        }

    $response = Http::withToken('7|5Pzo7JPusA0EGUosWLsk65Duw3xSx7o8LhWVugAl')->post('http://25.62.178.77:8000/api/recetadani/crear',
    [
        "nombre"=>$request->nombre,
        "duracion" =>$request->duracion,
        "preparacion" =>$request->preparacion,
        "chef" =>$request->chef,
        "ingrediente" =>$request->ingrediente,
         "tipo_plato" =>$request->tipo_plato
    ] );
  
        
    if ($response->status()==200){
            $receta = new Receta ();
            $receta->nombre =$request->nombre;
            $receta->duracion =$request->duracion;
            $receta->preparacion =$request->preparacion;
            $receta->chef =$request->chef;
            $receta->ingrediente =$request->ingrediente;
            $receta->tipo_plato =$request->tipo_plato;
            $receta->save;
        
        if ($receta ->save()){
            return response()->json([
                "status"=>201,
                "mgs"=>" Se ha guardado exitosamente",
                "error"=>null,
                "data" =>$receta
            ]);
        }
    }
    else
    {
        return response()->json([
            //  "status"=>$response->status(),
              "status"=>$response->status(),
            //  "mgs"=>" Se ha guardado exitosamente",
              "error"=>"los datos no fueron ingresados correctamente",
             
          ]);
    }
            
        }
        public function info(Request $request)
        {
        $receta= DB::table('recetas')->get()->all();
        return response()->json([
            "table" => "recetas",
            $receta
        ]);
        }
        public function update(Request $request, $id)
        {
        $validacion = Validator::make($request->all(),[
            'nombre'=>'required|max:30',
            'duracion' =>'required|max:40',
            'preparacion' =>'required',
            'chef' =>'required',
            'ingrediente' => 'required',
            'tipo_plato' => 'required',
        ]);
        if($validacion->fails()){
        return response()->json([
            "Error"=>$validacion->errors()
        ],400);
        }
        
            $response = Http::withToken($request->token)->put('http://25.63.10.104:8000/api/receta/updateyordi/'.$id,
             [
                "nombre" =>$request->nombre,
                "duracion" =>$request->duracion,
                "preparacion"=>$request->preparacion,
                "chef" =>$request->chef,
                "ingrediente" =>$request->ingrediente,
                "tipo_plato" =>$request->tipo_plato
             ] );
        
        $receta = Receta::find($id);
        $receta->nombre =$request->nombre;
        $receta->duracion =$request->duracion;
        $receta->preparacion =$request->preparacion;
        $receta->chef =$request->chef;
        $receta->ingrediente =$request->ingrediente;
        $receta->tipo_plato =$request->tipo_plato;
        $receta-> save;
        
        if ($receta ->save()){
        return response()->json([
            "status"=>201,
            "mgs"=>" Se ha guardado exitosamente",
            "error"=>null,
            "data" =>$receta
        ]);
        }
        
        }
       
}