<?php

namespace App\Models;

use Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class role extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    protected $table="roles";

// public function rol(){
//     return new Attribute(
//         get: fn($value)=>["invitado","user","admi"][$value]
//     );
//  //   return $this->hasOne(User::class);
// }
public function rol()
{
    return $this->hasMany(User::class);
}

// public function hasAnyRole($roles)
// {
//     if (is_array($roles))
//     {
//         foreach ($roles as $role)
//         {
//             if ($this->hasRole($role))
//             {
//                 return true;
//             }else
//             {
//                 if ($this->hasRole($role))
//                 {
//                     return true;
//                 }
//             }
//         }
//     }
//     return false;
// }
// public function hasRole($role)
// {
//     if ($this->rol()->where('name',$role->first()))
//     {
//         return true;
//     }
//     return false;
// }
}
