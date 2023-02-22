<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seguro;

class hospital extends Model
{
    use HasFactory;
    protected $table="hospitals";
    public function obtenerdatosdeseguro()
    {
        return $this->hasMany(Seguro::class);
    }
}
