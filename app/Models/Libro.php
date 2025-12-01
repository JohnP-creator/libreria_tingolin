<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
  use HasFactory;

  protected $fillable = [
    'titulo',
    'autor',
    'isbn',
    'descripcion',
    'imagen',
    'precio',
    'stock',
    'editorial',
    'año_publicacion'
  ];

  protected $casts = [
    'precio' => 'decimal:2',
    'año_publicacion' => 'integer',
    'stock' => 'integer'
  ];
}
