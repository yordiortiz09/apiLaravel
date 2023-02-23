<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


class chefController extends Controller
{
    public function create(Request $request)
    {

$validacion = Validator::make($request->all(),[
    'nombre'=>'required|max:25',
    'ap_paterno' =>'required|max:30',
    'ap_materno' =>'required|max:30',
    'nacionalidad' =>'required',Rule::in(['Mexicana', 'Italiana']),
    'edad' => 'required',
    
]);
if($validacion->fails()){
    return response()->json([
        "Error"=>$validacion->errors()
    ],400);
}
$token=$request->token;

//if($request->ip()=="25.63.10.104"){
$response = Http::withToken($request->token)->post('http://25.62.178.77:8000/api/chefdani/crear',
[
    "nombre"=>$request->nombre,
    "ap_paterno"=>$request->ap_paterno,
    "ap_materno"=>$request->ap_materno,
    "nacionalidad"=>$request->nacionalidad,
    "edad"=>$request->edad
] );

//dd($response->status());
if ($response->status()==200)
{
//}
    $chef = new Chef();
    $chef->nombre =$request->nombre;
    $chef->ap_paterno =$request->ap_paterno;
    $chef->ap_materno =$request->ap_materno;
    $chef->nacionalidad =$request->nacionalidad;
    $chef-> edad = $request -> edad;
    $chef-> save;

if ($chef ->save()){
    return response()->json([
        "status"=>$response->status(),
        "status"=>201,
        "status_de_la_url"=>$response->status(),
        "mgs"=>" Se ha guardado exitosamente",
        "error"=>null,
        "data" =>$chef
    ],201);
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
$chef= DB::table('chefs')->get()->all();
return response()->json([
    "table" => "chefs",
    $chef
]);
}
public function update(Request $request, $id)
{
    if($request->ip()=="25.63.10.104"){
        $response = Http::withToken($request->token)->put('http://25.62.178.77:8000/api/chefdani/actualizar/'.$id,
        [
            "nombre"=>$request->nombre,
            "ap_paterno"=>$request->ap_paterno,
            "ap_materno"=>$request->ap_materno,
            "nacionalidad"=>$request->nacionalidad,
            "edad"=>$request->edad
        ] );
        }
$validacion = Validator::make($request->all(),[
'nombre'=>'required|max:25',
'ap_paterno' =>'required|max:30',
'ap_materno' =>'nullable|max:30',
'nacionalidad' =>'required',Rule::in(['Mexicana', 'Italiana']),
'edad' => 'required'
]);
if($validacion->fails()){
return response()->json([
    "Error"=>$validacion->errors()
],400);
}


$chef = Chef::find($id);
$chef->nombre =$request->nombre;
$chef->ap_paterno =$request->ap_paterno;
$chef->ap_materno =$request->ap_materno;
$chef->nacionalidad =$request->nacionalidad;
$chef-> edad = $request -> edad;
$chef-> save;

if ($chef ->save()){
return response()->json([
    "status"=>201,
    "mgs"=>" Se ha guardado exitosamente",
    "error"=>null,
    "data" =>$chef
]);
}

}
public function delete(Request $request, int $id)
{
    if($request->ip()=="25.63.10.104"){
        $response = Http::withToken($request->token)->delete('http://25.62.178.77:8000/api/chef/delete/'.$id);
    }
$chef = Chef::find($id); 
if ($chef){
    $chef ->status = false; 
    $chef ->save();
    return response()->json([
        "status"=>200,
        "msg"=>"Se ha eliminado correctamente",
        "error"=>null,
        "data"=>$chef,
    ]);
}
}
}
