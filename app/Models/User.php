<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\role;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;
    

    protected $table='users';
    protected $table2='roles';
    public function validaciondelrol(...$role)
    {

        $user2 = role::where('id',$this->rol_id  )->first();
        return in_array($user2->nombre,...$role);
    }
    public function roles(...$role)
    {
        if (is_array(...$role))
        {
            foreach ($role as $roles)
            {
                if ($this->hasRole(...$roles))
                {
                    return true;
                }
            
            }
        }
                else{
                    if ($this->hasRole(...$role))
                    {
                        return true;
                    }
                }
            

            
        return false;
    }

     public function hasRole($role)
     {
     
        
      
   
         if ($role==$this->rol_id)
         { 
             return true;
         } 
        
         return false;
        
    }

     
    /**
     * The attributes that are mass assignable.
     
     *
     * @var array<int, string>
     */

    public function role()

    {
        return $this->hasMany(role::class);
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',
        'status',
        'no°verificación',
        'telefono'
        
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
   
}
