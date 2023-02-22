<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conductor;
class Tipo_de_avion extends Model
{
    use HasFactory;
    protected $table ='tipo_de_avions';
public function agregarconduc()
{
    return $this->hasMany(Conductor::class);
}
    
}
