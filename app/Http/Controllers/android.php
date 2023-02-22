<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\android as doi;

class android extends Controller
{
    //
    public function create(Request $request)
    {




     $chef = new doi();
    $chef->Values =$request->nombre;
  
    $chef-> save;

if ($chef ->save()){
    return response()->json([
    //    "status"=>$response->status(),
        "status"=>201,
        "mgs"=>" Se ha guardado exitosamente",
        "error"=>null,
        "data" =>$chef
    ]);
}
    
}
}
