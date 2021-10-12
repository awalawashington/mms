<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorldCountry extends Model
{
    use HasFactory;
    
    public function codeUsers()
    {
        return $this->hasMany(CodeUser::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
