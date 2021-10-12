<?php

namespace App\Models;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pages extends Model
{
    use HasFactory;
    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'page_id' , 'id')->orderBy('created_at', 'DESC');
    }
}
