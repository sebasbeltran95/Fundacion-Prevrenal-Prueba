<?php

namespace App\Http\Livewire;

use App\Models\Estados;
use App\Models\Prioridades;
use App\Models\Proyectos as ModelsProyectos;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class Proyectos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $descripcion, $fecha_inicio, $fecha_fin, $id_estado;
    public $idx, $titulox, $descripcionx, $fecha_iniciox, $fecha_finx, $id_estadox;
    public $search  = "";
    public $estado, $estados;

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getProyectosProperty()
    {
        if($this->search == ""){
            return ModelsProyectos::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsProyectos::
            orWhere('nombre', 'LIKE', '%'.$this->search.'%')
            ->paginate(3);
        } 
    }

        public function crear()
    {
        try { 

            $this->validate([
                'nombre' => 'required|string|max:255',
            ],[
                'nombre.required' => 'El campo Nombre es obligatorio',
                'nombre.string' => 'El campo Nombre recibe solo cadena de texto',
                'nombre.max' => 'El campo Nombre debe contener maximo 255 caracteres',
            ]);

        
            $user = new ModelsProyectos();
            $user->nombre =  $this->nombre;
            $user->save();

            $this->reset();
            $msj = ['!Registrado!', 'Se registro la Categoria', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }


    public function cargacategory($obj)
    {
        $this->idx =  $obj['id'];
        $this->nombrex =  $obj['nombre'];
    }


        public function actua()
    {
        try { 


            $this->validate([
                'nombrex' => 'required|string|max:255',
            ],[
                'nombrex.required' => 'El campo Nombre es obligatorio',
                'nombrex.string' => 'El campo Nombre recibe solo cadena de texto',
                'nombrex.max' => 'El campo Nombre debe contener maximo 255 caracteres',
            ]);

            $data = ModelsProyectos::find($this->idx);
            $data->nombre = $this->nombrex;
    
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo la Categoria', 'success'];
            $this->emit('ok', $msj);

          } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }



    public function render()
    {
        $this->estado = Estados::all();
        $this->estados = Estados::class;
        return view('livewire.proyectos')->extends('layouts.plantilla_back')->section('contenido');
    }
}
