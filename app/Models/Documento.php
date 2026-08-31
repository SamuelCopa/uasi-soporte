<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'titulo',
        'archivo',
        'nombre_original',
        'tipo',
        'tamanio',
    ];
}