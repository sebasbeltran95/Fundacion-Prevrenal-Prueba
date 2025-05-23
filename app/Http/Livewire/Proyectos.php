<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class Proyectos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $nombre;
    public $idx, $nombrex;
    public $search  = "";




    public function render()
    {
        return view('livewire.proyectos')->extends('layouts.plantilla_back')->section('contenido');
    }
}
