<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Classes\codeGenerator;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['url','user_id'];
    // Relacion con la tabla usuario
    public function users(){
        return $this->belongsTo('App\Models\User');
    }

    public function short_url( $long_url ){
        // dd($long_url);
        $url = self::create([
            'url' => $long_url,
            'user_id' => Auth::user()->id
        ]);
        // dd($url);

        // Generamos el codigo
        $code = (new codeGenerator())->get_code( $url->id );
        // dd($code);

        // actualizamos url
        $url->codigo = $code;
        $url->save();

        return $url->codigo;
    }
}
