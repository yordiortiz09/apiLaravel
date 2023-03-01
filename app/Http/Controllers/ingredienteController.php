<?php

namespace App\Http\Controllers;


use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class ingredienteController extends Controller
{
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
}
if($request->ip()=="25.63.10.104"){
    $response = Http::withToken($request->token)->post('http://25.62.178.77:8000/api/ingredientedani/crear',
    [
        "ingredientes" =>$request->ingredientes,
         "unidades"=>$request->unidades
    ] );
    }
    if ($response->status()==200){
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
    }else
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
$ingrediente= DB::table('ingredientes')->get()->all();
return response()->json(
    $ingrediente
);
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
}
if($request->ip()=="25.63.10.104"){
    $response = Http::withToken($request->token)->put('http://25.62.178.77:8000/api/ingredientedani/actualizar/'.$id,
    [
        "ingredientes" =>$request->ingredientes,
         "unidades"=>$request->unidades
    ] );
    }

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
