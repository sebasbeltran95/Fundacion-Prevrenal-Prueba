<?php

namespace App\Http\Livewire;

use App\Models\Tareas as ModelsTareas;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class Tareas extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $titulo, $descripcion, $id_estado, $id_prioridad, $id_categoria, $id_user,  $id_proyectos, $fecha_inicio, $fecha_fin;
    public $idx, $titulox, $descripcionx, $id_estadox, $id_prioridadx, $id_categoriax, $id_userx,  $id_proyectosx, $fecha_iniciox, $fecha_finx;
    public $search;

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getTareasProperty()
    {
        if($this->search == ""){
            return ModelsTareas::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsTareas::
            orWhere('titulo', 'LIKE', '%'.$this->search.'%')
            ->orWhere('descripcion', 'LIKE', '%'.$this->search.'%')
            ->paginate(3);
        } 
    }

    public function crear()
    {
        try { 

            $this->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255',
                'id_estado' => 'required|numeric',
                'id_prioridad' => 'required|numeric',
                'id_categoria' => 'required|numeric',
                'id_proyectos' => 'required|numeric',
                'fecha_inicio' => 'required',
                'fecha_fin' => 'required',
            ],[
                'titulo.required' => 'El campo Titulo es obligatorio',
                'titulo.string' => 'El campo Titulo recibe solo cadena de texto',
                'titulo.max' => 'El campo Titulo debe contener maximo 255 caracteres',
                'descripcion.required' => 'El campo Descripcion es obligatorio',
                'descripcion.string' => 'El campo Descripcion recibe solo cadena de texto',
                'descripcion.max' => 'El campo Descripcion debe contener maximo 255 caracteres',
                'id_estado.required' => 'El campo Estado es obligatorio',
                'id_estado.numeric' => 'El campo Estado recibe solo numeros enteros',
                'id_prioridad.required' => 'El campo Prioridad es obligatorio',
                'id_prioridad.numeric' => 'El campo Prioridad recibe solo numeros enteros',
                'id_proyectos.required' => 'El campo Proyectos es obligatorio',
                'id_proyectos.numeric' => 'El campo Proyectos recibe solo numeros enteros',
                'fecha_inicio.required' => 'El campo Fehca Inicio es obligatorio',
                'fecha_fin.required' => 'El campo Fecha Fin es obligatorio',
                'id_categoria.required' => 'El campo Categoria es obligatorio',
                'id_categoria.numeric' => 'El campo Categoria recibe solo numeros enteros',
            ]);
    
            $user = new ModelsTareas();
            $user->titulo =  $this->titulo;
            $user->descripcion =  $this->descripcion;
            $user->id_estado =  $this->id_estado;
            $user->id_prioridad =  $this->id_prioridad;
            $user->id_categoria =  $this->id_categoria;
            $user->id_user =  Auth()->user()->id;
            $user->id_proyectos =  $this->id_proyectos;
            $user->fecha_inicio =  $this->fecha_inicio;
            $user->fecha_fin =  $this->fecha_fin;
            $user->save();

            $this->reset();
            $msj = ['!Registrado!', 'Se registro la Tarea', 'success'];
            $this->emit('ok', $msj);
        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }


        public function delete($post)
    {
        ModelsTareas::where('id',$post)->first()->delete();
    }

    public function render()
    {
        return view('livewire.tareas')->extends('layouts.plantilla_back')->section('contenido');
    }
}
