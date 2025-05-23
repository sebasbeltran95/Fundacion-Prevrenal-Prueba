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
    public $search, $search_fecha_inicio, $search_fecha_fin;

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getTareasProperty()
    {

        if($this->search_fecha_inicio == '' && $this->search_fecha_fin == ''){
            if($this->search == ""){
                return ModelsTareas::orderBy('id','DESC')->paginate(5);
            } else {
                return ModelsTareas::
                orWhere('titulo', 'LIKE', '%'.$this->search.'%')
                ->orWhere('descripcion', 'LIKE', '%'.$this->search.'%')
                ->paginate(3);
            } 
        } else {
           return ModelsTareas::where('fecha_inicio', $this->search_fecha_inicio)
            ->where('fecha_fin', $this->search_fecha_fin)
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

        public function cargacategory($obj)
    {
        $this->idx =  $obj['id'];
        $this->titulox =  $obj['titulo'];
        $this->descripcionx =  $obj['descripcion'];
        $this->id_estadox =  $obj['id_estado'];
        $this->id_prioridadx =  $obj['id_prioridad'];
        $this->id_categoriax =  $obj['id_categoria'];
        $this->id_proyectosx =  $obj['id_proyectos'];
        $this->fecha_iniciox =  $obj['fecha_inicio'];
        $this->fecha_finx =  $obj['fecha_fin'];
    }

    
    public function actua()
    {
        try { 

            $this->validate([
                'titulox' => 'required|string|max:255',
                'descripcionx' => 'required|string|max:255',
                'id_estadox' => 'required|numeric',
                'id_prioridadx' => 'required|numeric',
                'id_categoriax' => 'required|numeric',
                'id_proyectosx' => 'required|numeric',
                'fecha_iniciox' => 'required',
                'fecha_finx' => 'required',
            ],[
                'titulox.required' => 'El campo Titulo es obligatorio',
                'titulox.string' => 'El campo Titulo recibe solo cadena de texto',
                'titulox.max' => 'El campo Titulo debe contener maximo 255 caracteres',
                'descripcionx.required' => 'El campo Descripcion es obligatorio',
                'descripcionx.string' => 'El campo Descripcion recibe solo cadena de texto',
                'descripcionx.max' => 'El campo Descripcion debe contener maximo 255 caracteres',
                'id_estadox.required' => 'El campo Estado es obligatorio',
                'id_estadox.numeric' => 'El campo Estado recibe solo numeros enteros',
                'id_prioridadx.required' => 'El campo Prioridad es obligatorio',
                'id_prioridadx.numeric' => 'El campo Prioridad recibe solo numeros enteros',
                'id_proyectosx.required' => 'El campo Proyectos es obligatorio',
                'id_proyectosx.numeric' => 'El campo Proyectos recibe solo numeros enteros',
                'fecha_iniciox.required' => 'El campo Fehca Inicio es obligatorio',
                'fecha_finx.required' => 'El campo Fecha Fin es obligatorio',
                'id_categoriax.required' => 'El campo Categoria es obligatorio',
                'id_categoriax.numeric' => 'El campo Categoria recibe solo numeros enteros',
            ]);

            $data = ModelsTareas::find($this->idx);
            $data->titulo = $this->titulox;
            $data->descripcion = $this->descripcionx;
            $data->id_estado = $this->id_estadox;
            $data->id_prioridad = $this->id_prioridadx;
            $data->id_categoria = $this->id_categoriax;
            $data->id_proyectos = $this->id_proyectosx;
            $data->fecha_inicio = $this->fecha_iniciox;
            $data->fecha_fin = $this->fecha_finx;
    
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo la Tarea', 'success'];
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
