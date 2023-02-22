<?php

namespace App\Http\Controllers\Actividad2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\hospital;
use Illuminate\Support\Facades\Http;
class HospitalController extends Controller
{
    //
      //create 
      public function create(Request $request)
      {
          Log::channel('slack')->info("Algo esta sucediendo en la tabla hospital",[$request]);
          $validacion = Validator::make(
              $request->all(),
              [
                  'no_de_seguro'=>"required",
                  'numero_de_seo'=>"required",
                  'nombre_del_hospital'=>"required"
                  
  
              ]);
              if ($validacion->fails())
              {
                  return response()->json(["status"=>400,"message"=>$validacion->errors(),"data"=>[]],400);
              }
              if($request->ip()=="25.63.10.104"){
                $response = Http::withToken($request->token)->post('http://25.62.178.77:8000/api/hospitaldani/crear',
                [
                    "no_de_seguro"=>$request->no_de_seguro,
                    "numero_de_seo"=>$request->numero_de_seo,
                    "nombre_del_hospital"=>$request->nombre_del_hospital
                ] );
                }
                if ($response->status()==200){
              $hospital = new hospital();
              $hospital->no_de_seguro=$request->no_de_seguro;
              $hospital->numero_de_seo=$request->numero_de_seo;
              $hospital->nombre_del_hospital=$request->nombre_del_hospital;
              
              $hospital->save;
  
              if ($hospital->save())
              return response()->json([
  
  "status"=>200,
  "message"=>"datos almcenados",
  "error"=>[],
  "data"=>$request->all()
  
  
              ]);
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
  public function inde3(Request $request)
  {
      //ver
     dd( $hospital=DB::table('hospitals')->get()->all());
      return response()->json(["table"=>"CONDUCTORES",$hospital]);
  }



  public function update(Request $request, $id)
  {
  $validacion = Validator::make($request->all(),[
    'no_de_seguro'=>"required",
    'numero_de_seo'=>"required",
    'nombre_del_hospital'=>"required"
  ]);
  if($validacion->fails()){
  return response()->json([
      "Error"=>$validacion->errors()
  ],400);
  }
  
  
if($request->ip()=="25.63.10.104"){
    $response = Http::withToken($request->token)->put('http://25.62.178.77:8000/api/hospitaldani/actualizar/'.$id,
     [
    "no_de_seguro"=>$request->no_de_seguro,
  "numero_de_seo"=>$request->numero_de_seo,
  "nombre_del_hospital"=>$request->nombre_del_hospital
  
     ] );}
  
  $hospital = hospital::find($id);
  
  $hospital->no_de_seguro=$request->no_de_seguro;
  $hospital->numero_de_seo=$request->numero_de_seo;
  $hospital->nombre_del_hospital=$request->nombre_del_hospital;
  
  $hospital->save;
  
  
  if ($hospital ->save()){
  return response()->json([
      "status"=>201,
      "mgs"=>" Se ha guardado exitosamente",
      "error"=>null,
      "data" =>$hospital
  ]);
  }
  
  }
  public function delete(Request $request, int $id)
  {
    if($request->ip()=="25.63.10.104"){
        $response = Http::withToken($request->token)->delete('http://25.62.178.77:8000/api/hospitaldani/borrar/'.$id);
    }
  $hospital = hospital::find($id); 
  if ($hospital){
      $hospital ->status = false; 
      $hospital ->save();
      return response()->json([
          "status"=>200,
          "msg"=>"Se ha eliminado correctamente",
          "error"=>null,
          "data"=>$hospital,
      ]);
  }
  }
}
