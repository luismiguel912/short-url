<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $filleable = ['url','user_id'];
    // Relacion con la tabla usuario
    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}
