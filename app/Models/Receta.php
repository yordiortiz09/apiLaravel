<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingrediente;
use App\Models\tipoPlato;
use App\Models\Chef;


class Receta extends Model
{
    use HasFactory;
    protected $table="recetas";

    public function ingrediente()
{
    return $this->hasMany(Ingrediente::class);
   
}
public function chef()

{
    return $this->hasMany(Chef::class);
}
public function tipoPlato(){
    return $this->hasOne(tipoPlato::class);
}


}


