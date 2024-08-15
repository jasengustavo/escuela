<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Business extends User
{
     public function newQuery($excludeDeleted = true): Builder 
    
    {
        return parent::newQuery($excludeDeleted)
                ->where(function($query) {
                    $query->where('role_id', Role::SECRETARIO);
                })
                ->where('status', 1);

    }
}
