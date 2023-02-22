<?php

namespace App\Http\Controllers\Actividad3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tipoPlato;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class tipoPlatoController2 extends Controller
{
    //
    public function create(Request $request)
    {
$validacion = Validator::make($request->all(),[
    'nombre'=>'required',
    'descripcion'=>'required',
]);
if($validacion->fails()){
    return response()->json([
        "Error"=>$validacion->errors()
    ],400);
}
$tipoplato = new tipoPlato();
$tipoplato->nombre =$request->nombre;
$tipoplato->descripcion= $request->descripcion;
$tipoplato->save;

if ($tipoplato ->save()){
return response()->json([
    "status"=>201,
    "mgs"=>" Se ha guardado exitosamente",
    "error"=>null,
    "data" =>$tipoplato
]);
}

}
public function info(Request $request)
{
    $tipoplato= DB::table('tipo_platos')->get()->all();
return response()->json([
    "table" => "tipo_platos",
    $tipoplato
]);
}


public function update(Request $request, $id)
{
$validacion = Validator::make($request->all(),[
    'nombre'=>'required',
    'descripcion'=>'required'
]);
if($validacion->fails()){
return response()->json([
    "Error"=>$validacion->errors()
],400);
}
// if($request->ip()=="25.63.10.104"){
//     $response = Http::put('http://25.62.178.77:8000/api/ingrediente/update/'.$id,
//     [
//         "ingredientes" =>$request->ingredientes,
//          "unidades"=>$request->unidades
//     ] );
//     }

$tipoplato = tipoPlato::find($id);
$tipoplato->nombre =$request->nombre;
$tipoplato->descripcion= $request->descripcion;
$tipoplato-> save;

if ($tipoplato ->save()){
return response()->json([
    "status"=>201,
    "mgs"=>" Se ha guardado exitosamente",
    "error"=>null,
    "data" =>$tipoplato
]);
}

}
}
