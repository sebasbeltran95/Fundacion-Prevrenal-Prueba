<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioridades extends Model
{
    use HasFactory;
    protected $table = 'prioridades';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'nombre',
        'valor',
        'created_at',
        'updated_at'
    ];
}
