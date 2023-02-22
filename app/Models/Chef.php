<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Receta;

class Chef extends Model
{
    use HasFactory;
    protected $table="chefs";

public function chef(){
    return $this->hasOne(Receta::class);
}
    
}
