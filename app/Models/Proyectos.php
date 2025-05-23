<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
    protected $table = 'proyectos';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'id_estado',
        'created_at',
        'updated_at'
    ];
}
