<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conductor;
use App\Models\hospital;



class Seguro extends Model
{
    use HasFactory;
    protected $table="seguros";

    public function pasardatos()
    {
        return $this->hasMany(Conductor::class);
        return $this->hasOne(hospital::class);
    }
}
