<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;

class tipoPlato extends Model
{
    use HasFactory;
    protected $table="tipo_platos";

    public function receta()
    {
        return $this->hasOne(Receta::class);
    }
  
}
