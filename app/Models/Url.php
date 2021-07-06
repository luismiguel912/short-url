<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Clases\codeGenerator;

class Url extends Model
{
    use HasFactory;

    protected $filleable = ['url','user_id'];
    // Relacion con la tabla usuario
    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public function short_url( $long_url ){
        $url = self::create([
            'url' => $long_url,
            'user_id' => Auth::user()->id
        ]);

        // Generamos el codigo
        $code = (new codeGenerator())->get_code( $url->id );

        // actualizamos url
        $url->code = $code;
        $url->save();

        return $url->code;
    }
}
