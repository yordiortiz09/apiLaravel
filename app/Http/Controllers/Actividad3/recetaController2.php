<?php

namespace App\Http\Controllers\Actividad3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Receta;

class recetaController2 extends Controller
{
    //
    public function delete(Receta $receta)
    {
        $receta->update(['status' => 0]);
        $receta->ingrediente->update(['status' => 0]);
        $receta->chef->update(['status' => 0]);
        $receta->tipoPlato->update(['status' => 0]);
    
        return response()->json([
            'message' => 'Receta eliminada correctamente.',
            'data' => $receta,
        ]);
    }
    
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
       
    
        
        
            $receta = new Receta();
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
              //  "status2"=>$response->status(),
                "mgs"=>" Se ha guardado exitosamente",
                "error"=>null,
                "data" =>$receta
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
        // if($request->ip()=="25.63.10.104"){
        //     $response = Http::put('http://25.62.178.77:8000/api/receta/update/'.$id,
        //      [
        //         "nombre" =>$request->nombre,
        //         "duracion" =>$request->duracion,
        //         "preparacion"=>$request->preparacion,
        //         "chef" =>$request->chef,
        //         "ingrediente" =>$request->ingrediente,
        //         "tipo_plato" =>$request->tipo_plato
        //      ] );} 
        
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
          //  "status2"=>$response->status(),
            "mgs"=>" Se ha guardado exitosamente",
            "error"=>null,
            "data" =>$receta
        ]);
        }
        
        }
       
}
