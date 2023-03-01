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
 
    public function create(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'ingredientes' => 'required',
            'unidades' => 'required',
        ]);
        if ($validacion->fails()) {
            return response()->json([
                "Error" => $validacion->errors()
            ], 400);
        }
        $ingrediente = new Ingrediente();
        $ingrediente->ingredientes = $request->ingredientes;
        $ingrediente->unidades = $request->unidades;
        $ingrediente->save;

        if ($ingrediente->save()) {
            return response()->json([
                "status" => 201,
                "mgs" => " Se ha guardado exitosamente",
                "error" => null,
                "data" => $ingrediente
            ]);
        }
    }
    public function info(Request $request)
    {
        $ingrediente = DB::table('ingredientes')->get()->all();
        return response()->json([
            "table" => "ingredientes",
            $ingrediente
        ]);
    }


    public function update(Request $request, $id)
    {
        $validacion = Validator::make($request->all(), [
            'ingredientes' => 'required',
            'unidades' => 'required'
        ]);
        if ($validacion->fails()) {
            return response()->json([
                "Error" => $validacion->errors()
            ], 400);
        }


            $ingrediente = Ingrediente::find($id);
            $ingrediente->ingredientes = $request->ingredientes;
            $ingrediente->unidades = $request->unidades;
            $ingrediente->save;

            if ($ingrediente->save()) {
                return response()->json([
                    "status" => 201,
                    "mgs" => " Se ha guardado exitosamente",
                    "error" => null,
                    "data" => $ingrediente
                ]);
            }
        
    }
    public function infoIngrediente($id)
{
    $ingrediente= DB::table('ingredientes')->where('id', $id)->first();

    if (!$ingrediente) {
        return response()->json([
            "error" => "ingrediente no encontrado"
        ], 404);
    }
    return response()->json(
        $ingrediente
    );
}
public function delete(int $id)
{
   
$ingrediente = Ingrediente::find($id); 
if ($ingrediente){
    $ingrediente ->status = false; 
    $ingrediente ->save();
    return response()->json([
        "status"=>200,
        "msg"=>"Se ha eliminado correctamente",
        "error"=>null,
        "data"=>$ingrediente,
    ]);
}
}

}
