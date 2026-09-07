<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Especialidad extends Model
{
    use HasFactory;
    protected $perPage = 1000;
    protected $table = 'especialidades';
    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'activo',
    ];

    // public function usuarios(): HasMany
    // {
    //     return $this->hasMany(User::class, 'especialidad_id');
    // }



public function usuarios(): BelongsToMany
{
    return $this->belongsToMany(
        User::class,
        'especialidad_user',
        'especialidad_id',
        'user_id'
    )->withTimestamps();
}
}