<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'country_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(WorldCountry::class);
    }
}
