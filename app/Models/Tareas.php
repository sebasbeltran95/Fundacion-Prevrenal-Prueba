<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use HasFactory;
        protected $table = 'tareas';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'titulo',
        'descripcion',
        'fecha_creacion',
        'fecha_vencimiento',
        'id_estado',
        'id_prioridad',
        'id_categoria',
        'id_user',
        'id_proyectos',
        'fecha_inicio',
        'fecha_fin',
        'created_at',
        'updated_at'
    ];
}
