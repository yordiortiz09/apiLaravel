<?php

namespace App\Http\Controllers\Actividad3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingrediente;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ingredienteController2 extends Controller
{
    //
    public function create(Request $request)
    {
$validacion = Validator::make($request->all(),[
    'ingredientes'=>'required',
    'unidades'=>'required',
]);
if($validacion->fails()){
    return response()->json([
        "Error"=>$validacion->errors()
    ],400);
// }
// if($request->ip()=="25.63.10.104"){
//     $response = Http::post('http://25.62.178.77:8000/api/ingrediente',
//     [
//         "ingredientes" =>$request->ingredientes,
//          "unidades"=>$request->unidades
//     ] );
     }
$ingrediente = new Ingrediente();
$ingrediente->ingredientes =$request->ingredientes;
$ingrediente->unidades =$request->unidades;
$ingrediente->save;

if ($ingrediente ->save()){
return response()->json([
    "status"=>201,
    "mgs"=>" Se ha guardado exitosamente",
    "error"=>null,
    "data" =>$ingrediente
]);
}

}
public function info(Request $request)
{
$ingrediente= DB::table('ingredientes')->get()->all();
return response()->json([
    "table" => "ingredientes",
    $ingrediente
]);
}


public function update(Request $request, $id)
{
$validacion = Validator::make($request->all(),[
    'ingredientes'=>'required',
    'unidades'=>'required'
]);
if($validacion->fails()){
return response()->json([
    "Error"=>$validacion->errors()
],400);
// }
// if($request->ip()=="25.63.10.104"){
//     $response = Http::put('http://25.62.178.77:8000/api/tipo_plato/update/'.$id,
//     [
//         "ingredientes" =>$request->ingredientes,
//          "unidades"=>$request->unidades
//     ] );
//     }

$ingrediente = Ingrediente::find($id);
$ingrediente->ingredientes =$request->ingredientes;
$ingrediente->unidades =$request->unidades;
$ingrediente-> save;

if ($ingrediente ->save()){
return response()->json([
    "status"=>201,
    "mgs"=>" Se ha guardado exitosamente",
    "error"=>null,
    "data" =>$ingrediente
]);
}

}

}
}
