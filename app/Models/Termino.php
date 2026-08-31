<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Termino extends Model
{
    protected $table = 'terminos';

    protected $fillable = [
        'titulo',
        'contenido',
    ];
}
