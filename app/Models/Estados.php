<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;
    protected $table = 'estados';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'fecha_creacion',
        'id_estado',
        'created_at',
        'updated_at'
    ];
}
