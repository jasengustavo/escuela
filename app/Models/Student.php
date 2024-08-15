<?php

namespace App\Models;

use App\Models\Tutor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

      protected $guarded = [];


      public function users(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

     public function tutors(): BelongsTo
    {
        return $this->belongsTo(Tutor::class,'tutor_id');
    }
}
