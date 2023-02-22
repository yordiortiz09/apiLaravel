<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\seguro;
use App\Models\hospital;
use App\Models\Tipo_de_avion;

class Conductor extends Model
{
    use HasFactory;

    protected $table='conductors';
    public function tipo_de_avions()
    {
        return $this->hasOne(Seguro::class);
        return $this->hasOne(hospital::class);
        return $this->hasOne(Tipo_de_avion::class);

    }
}
