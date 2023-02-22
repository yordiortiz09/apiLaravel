<?php

namespace App\Http\Controllers\Actividad3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Seguro;
use Illuminate\Support\Facades\Http;

class SeguroController2 extends Controller
{
    //
    public function create(Request $request)
    {
        Log::channel('slack')->info("Algo esta sucediendo en la tabla Seguro",[$request]);
        $validacion = Validator::make(
            $request->all(),
            [
                'id_paciente'=>"required",
                'numero_de_seguro'=>"required",
                'nombre_del_seguro'=>"required",
                

            ]);
            if ($validacion->fails())
            {
                return response()->json(["status"=>400,"message"=>$validacion->errors(),"data"=>[]],400);
            }
            // if($request->ip()=="25.63.10.104"){
            //     $response = Http::post('http://25.62.178.77:8000/api/conductor/crear2',
            //      [
            //         "id_paciente"=>$request->id_paciente,
            //         "numero_de_seguro"=>$request->numero_de_seguro,
            //     "nombre_del_seguro"=>$request->nombre_del_seguro

            //      ] );}
            $seguro = new Seguro();
            $seguro->id_paciente=$request->id_paciente;
            $seguro->numero_de_seguro=$request->numero_de_seguro;
            $seguro->nombre_del_seguro=$request->nombre_del_seguro;
            
            $seguro->save;

            if ($seguro->save())
            return response()->json([

"status"=>200,
"message"=>"datos almcenados",
"error"=>[],
"data"=>$request->all()


            ]);
    }
public function inde3(Request $request)
{
    //ver
    $seguro=DB::table('conductors')->get()->all();
    return response()->json(["table"=>"CONDUCTORES",$seguro]);
}
public function update(Request $request, $id)
{
$validacion = Validator::make($request->all(),[
    'id_paciente'=>"required",
    'numero_de_seguro'=>"required",
    'nombre_del_seguro'=>"required",
]);
if($validacion->fails()){
return response()->json([
    "Error"=>$validacion->errors()
],400);
// }
// if($request->ip()=="25.63.10.104"){
//     $response = Http::put('http://25.62.178.77:8000/api/conductor/actualizar2/'.$id,
//      [
//         "id_paciente"=>$request->id_paciente,
// "numero_de_seguro"=>$request->numero_de_seguro,
// "nombre_del_seguro"=>$request->nombre_del_seguro
//      ] );
}

$seguro = Seguro::find($id);
$seguro->id_paciente=$request->id_paciente;
$seguro->numero_de_seguro=$request->numero_de_seguro;
$seguro->nombre_del_seguro=$request->nombre_del_seguro;
$seguro->status=1;

$seguro->save;

if ($seguro ->save()){
return response()->json([
    "status"=>201,
    "mgs"=>" Se ha guardado exitosamente",
    "error"=>null,
    "data" =>$seguro
]);
}

}
public function delete(Request $request, int $id)
{
    // if($request->ip()=="25.63.10.104"){
    //     $response = Http::delete('http://25.62.178.77:8000/api/conductor/borrar2/'.$id);
    // }
$seguro = Seguro::find($id); 
if ($seguro){
    $seguro ->status = false; 
    $seguro ->save();
    return response()->json([
        "status"=>200,
        "msg"=>"Se ha eliminado correctamente",
        "error"=>null,
        "data"=>$seguro,
    ]);
}
}
}
