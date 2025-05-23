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
        'nombre',
        'created_at',
        'updated_at'
    ];
}
