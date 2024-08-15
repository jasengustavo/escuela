<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    
    const ADMINISTRADOR = 1;

    const SECRETARIO = 2;

   

    protected $fillable = [

        'name',
    ];

     public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

     

}
