<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\example\EjemploController;
use App\Http\Controllers\Actividad2\ConductoreController;
use App\Http\Controllers\Actividad2\HospitalController;
use App\Http\Controllers\Actividad2\SeguroController;
use App\Http\Controllers\Actividad3\chefController2;
use App\Http\Controllers\Actividad3\SeguroController2;
use App\Http\Controllers\Actividad3\YordiHospitalController2;
use App\Http\Controllers\Actividad3\yordiConductorController;
use Illuminate\Support\Facades\URL;
use App\Jobs\email;
use App\Jobs\sms;

use App\Http\Controllers\Actividad3\ingredienteController2;
use App\Http\Controllers\Actividad3\recetaController2;
use App\Http\Controllers\Actividad3\TipodeavionController2;
use App\Http\Controllers\Actividad3\tipoPlatoController2;
use App\Http\Controllers\ingredienteController;
use App\Http\Controllers\chefController;
use App\Http\Controllers\recetaController;
use App\Http\Controllers\tipoPlatoController;
use App\Http\Controllers\Actividad2\TipodeavionController;
use App\Http\Controllers\User\UsuarioController;
use App\Http\Controllers\SmsController;
use App\Http\Middleware\validacioninfo;


use App\Models\Conductor;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
});



Route::get("/conductor",[ConductoreController::class,"index"]);
Route::post("/conductor/crear",[ConductoreController::class,"create"]);
Route::put("/conductor/actualizar/{id?}",[ConductoreController::class,"update"])->where("id","[0-9]+");
Route::delete("/conductor/borrar/{id?}",[ConductoreController::class,"delete"])->where("id","[0-9]+");

Route::middleware(['auth:sanctum','role:Administrador'])->group(function(){
   
    Route::put("/user/update/status/{id}",[UsuarioController::class,'updateStatus'])->where('id',"[0-9]+");
    Route::put("/user/update/role/{id}",[UsuarioController::class,'updateRole'])->where('id',"[0-9]+");
    Route::delete("/user/delete/{id}",[UsuarioController::class,'destroy'])->where('id',"[0-9]+");
    Route::put("/user/update/{id}",[UsuarioController::class,'updateUser'])->where('id',"[0-9]+");
    Route::get("/users",[UsuarioController::class,'getUsers']);

    
    

 Route::get("/conductoryordi",[yordiConductorController::class,"index"]);
 Route::post("/conductor/crearyordi",[yordiConductorController::class,"create"]);
 Route::put("/conductoryordi/actualizar/{id?}",[yordiConductorController::class,"update"])->where("id","[0-9]+");
 Route::delete("/conductoryordi/borrar/{id?}",[yordiConductorController::class,"delete"])->where("id","[0-9]+");
});
 //-----------------------------------------------------------------------------------------------------------------------

Route::get("/conductor/info1",[HospitalController::class,"inde3"]);
Route::post("/conductor/crear1",[HospitalController::class,"create"]);
Route::put("/conductor/actualizar1/{id?}",[HospitalController::class,"update"])->where("id","[0-9]+");
Route::delete("/conductor/borrar1/{id?}",[HospitalController::class,"delete"])->where("id","[0-9]+");

Route::middleware(['auth:sanctum','role:Administrador,Usuario'])->group(function(){
    

Route::get("/conductoryordi/info1",[YordiHospitaController2::class,"inde3"]);
Route::post("/conductoryordi/crear1",[YordiHospitalController2::class,"create"]);
Route::put("/conductoryordi/actualizar1/{id?}",[YordiHospitalController2::class,"update"])->where("id","[0-9]+");
Route::delete("/conductoryordi/borrar1/{id?}",[YordiHospitalController2::class,"delete"])->where("id","[0-9]+");

});

//-------------------------------------------------------------------------------------------------------------------

Route::get("/conductor/info2",[SeguroController::class,"index3"]);
Route::post("/conductor/crear2",[SeguroController::class,"create"]);
Route::put("/conductor/actualizar2/{id?}",[SeguroController::class,"update"])->where("id","[0-9]+");
Route::delete("/conductor/borrar2/{id?}",[SeguroController::class,"delete"])->where("id","[0-9]+");

Route::middleware(['auth:sanctum','role:Administrador,Usuario'])->group(function(){
    

Route::get("/conductoryordi/info2",[SeguroController2::class,"index3"]);
Route::post("/conductoryordi/crear2",[SeguroController2::class,"create"]);
Route::put("/conductoryordi/actualizar2/{id?}",[SeguroController2::class,"update"])->where("id","[0-9]+");
Route::delete("/conductoryordi/borrar2/{id?}",[SeguroController2::class,"delete"])->where("id","[0-9]+");
});
//----------------------------------------------------------------------------------------------------------------------
Route::get("/conductor/info3",[TipodeavionController::class,"index3"]);
Route::post("/conductor/crear3",[TipodeavionController::class,"create"]);
Route::put("/conductor/actualizar3/{id?}",[TipodeavionController::class,"update"])->where("id","[0-9]+");
Route::delete("/conductor/borrar3/{id?}",[TipodeavionController::class,"delete"])->where("id","[0-9]+");

Route::middleware(['auth:sanctum','role:Administrador,Usuario'])->group(function(){
    

Route::get("/conductoryordi/info3",[TipodeavionController2::class,"index3"]);
Route::post("/conductoryordi/crear3",[TipodeavionController2::class,"create"]);
Route::put("/conductoryordi/actualizar3/{id?}",[TipodeavionController2::class,"update"])->where("id","[0-9]+");
Route::delete("/conductoryordi/borrar3/{id?}",[TipodeavionController2::class,"delete"])->where("id","[0-9]+");
});
//----------------------------------------------------------------------------------------


Route::post("/chef",[chefController::class,"create"]);
Route::get("/chef/info",[chefController::class,"info"]);
Route::put("/chef/update/{id}",[chefController::class,"update"])->where('id',"[0-9]+");
Route::delete("/chef/delete/{id}",[chefController::class,"delete"]);

Route::middleware(['auth:sanctum','role:Administrador,invitado'])->group(function(){
    

Route::post("/chefyordi",[chefController2::class,"create"]);
Route::get("/chef/infoyordi",[chefController2::class,"getChefs"]);
Route::get("/chef/infoyordi/{id}",[chefController2::class,"chefInfo"]);
Route::put("/chef/updateyordi/{id}",[chefController2::class,"update"])->where('id',"[0-9]+");
Route::delete("/chef/deleteyordi/{id}",[chefController2::class,"delete"]);

});

//---------------------------------------------------------------------------------------------

Route::post("/receta",[recetaController::class,"create"]);
Route::get("/receta/info",[recetaController::class,"info"]);
Route::put("/receta/update/{id}",[recetaController::class,"update"])->where('id',"[0-9]+");

Route::middleware(['auth:sanctum','role:Administrador,Usuario'])->group(function(){
    

Route::post("/recetayordi",[recetaController2::class,"create"]);
Route::get("/receta/infoyordi",[recetaController2::class,"info"]);
Route::put("/receta/updateyordi/{id}",[recetaController2::class,"update"])->where('id',"[0-9]+");
Route::delete("/receta/deleteyordi/{id}",[recetaController2::class,"delete"]);
});


//------------------------------------------------------------------------------------------------

Route::post("/ingrediente",[ingredienteController::class,"create"]);
Route::get("/ingredientes/info",[ingredienteController::class,"info"]);
Route::put("/ingrediente/update/{id}",[ingredienteController::class,"update"])->where('id',"[0-9]+");


Route::middleware(['auth:sanctum','role:Administrador,invitado,Usuario'])->group(function(){
    

Route::post("/ingredienteyordi",[ingredienteController2::class,"create"]);
Route::get("/ingredienteyordi/info",[ingredienteController2::class,"info"]);
Route::put("/ingredienteyordi/update/{id}",[ingredienteController2::class,"update"])->where('id',"[0-9]+");
Route::get("/ingredienteyordi/info/{id}",[ingredienteController2::class,"infoIngrediente"]);
Route::delete("/ingredienteyordi/delete/{id}",[ingredienteController2::class,"delete"]);

});

//------------------------------------------------------------------------------------------------------
//mi propia enviar datos a yordi

Route::post("/tipo_plato",[tipoPlatoController::class,"create"]);
Route::put("/tipo_plato/update/{id}",[tipoPlatoController::class,"update"])->where('id',"[0-9]+");
Route::get("/tipo_plato/info",[tipoPlatoController::class,"info"]);


//tipo plato para mi base de datos
Route::middleware(['auth:sanctum','role:Administrador,invitado'])->group(function(){
    Route::post("/tipo_platoyordi",[tipoPlatoController2::class,"create"]);
Route::put("/tipo_platoyordi/update/{id}",[tipoPlatoController2::class,"update"])->where('id',"[0-9]+");
Route::get("/tipo_platoyoerdi/info",[tipoPlatoController2::class,"info"]);
Route::get("/tipo_platoyordi/info/{id}",[tipoPlatoController2::class,"infoPlato"]);
Route::delete("/tipo_platoyordi/delete/{id}",[tipoPlatoController2::class,"delete"]);
});

Route::delete("/cerrar",[UsuarioController::class,'logout']);


Route::post("/user/regis",[UsuarioController::class,'crearusuario']);



Route::post("/user/registraryordi",[UsuarioController::class,'irayordi']);
Route::post("/user/registro",[UsuarioController::class,'InicioSesion']);
Route::get("/user/{id}",[UsuarioController::class,'info']);

   
   Route::post("/telefonoregistr",[UsuarioController::class,"registrarSMS"])->name('telefonoregistr');
   Route::get("/validarnumero/{url}",[UsuarioController::class,"numerodeverificacionmovil"])->name('validarnumero');

   Route::middleware('auth:sanctum')->get('/verifyToken', function (Request $request) {
    return response()->json(['message' => 'Token válido'], 200);
});

// Route::get('/verify-role', function (Request $request) {
//     return response()->json(['message' => 'Usuario con rol'], 200);
// })->middleware('role:Administrador,invitado,Usuario' ,'auth:sanctum');

Route::middleware('auth:sanctum','role:Administrador')->get('/verify-role', function (Request $request) {
    $user = $request->user();
        return response()->json(['message' => 'Usuario con rol de administrador'], 200);
});
Route::middleware('auth:sanctum','role:Usuario')->get('/verify/role', function (Request $request) {
        return response()->json(['message' => 'Usuario con rol de Usuario'], 200);
});





   //Route::Post