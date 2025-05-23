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
                'fecha_inicio' => 'required',
                'fecha_fin' => 'required',
                'id_estado' => 'required|numeric',
            ],[
                'titulo.required' => 'El campo Titulo es obligatorio',
                'titulo.string' => 'El campo Titulo recibe solo cadena de texto',
                'titulo.max' => 'El campo Titulo debe contener maximo 255 caracteres',
                'descripcion.required' => 'El campo Descripcion es obligatorio',
                'descripcion.string' => 'El campo Descripcion recibe solo cadena de texto',
                'descripcion.max' => 'El campo Descripcion debe contener maximo 255 caracteres',
                'fecha_inicio.required' => 'El campo Fehca Inicio es obligatorio',
                'fecha_fin.required' => 'El campo Fecha Fin es obligatorio',
                'id_estado.required' => 'El campo Estado es obligatorio',
                'id_estado.numeric' => 'El campo Estado recibe solo numeros enteros',
            ]);

        
            $user = new ModelsProyectos();
            $user->titulo =  $this->titulo;
            $user->descripcion =  $this->descripcion;
            $user->fecha_inicio =  $this->fecha_inicio;
            $user->fecha_fin =  $this->fecha_fin;
            $user->id_estado =  $this->id_estado;
            $user->save();

            $this->reset();
            $msj = ['!Registrado!', 'Se registro el proyecto', 'success'];
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
        $this->fecha_iniciox =  $obj['fecha_inicio'];
        $this->fecha_finx =  $obj['fecha_fin'];
        $this->id_estadox =  $obj['id_estado'];
    }


        public function actua()
    {
        try { 

            $this->validate([
                'titulox' => 'required|string|max:255',
                'descripcionx' => 'required|string|max:255',
                'fecha_iniciox' => 'required',
                'fecha_finx' => 'required',
                'id_estadox' => 'required|numeric',
            ],[
                'titulox.required' => 'El campo Titulo es obligatorio',
                'titulox.string' => 'El campo Titulo recibe solo cadena de texto',
                'titulox.max' => 'El campo Titulo debe contener maximo 255 caracteres',
                'descripcionx.required' => 'El campo Descripcion es obligatorio',
                'descripcionx.string' => 'El campo Descripcion recibe solo cadena de texto',
                'descripcionx.max' => 'El campo Descripcion debe contener maximo 255 caracteres',
                'fecha_iniciox.required' => 'El campo Fehca Inicio es obligatorio',
                'fecha_finx.required' => 'El campo Fecha Fin es obligatorio',
                'id_estadox.required' => 'El campo Estado es obligatorio',
                'id_estadox.numeric' => 'El campo Estado recibe solo numeros enteros',
            ]);

            $data = ModelsProyectos::find($this->idx);
            $data->titulo = $this->titulox;
            $data->descripcion = $this->descripcionx;
            $data->fecha_inicio = $this->fecha_iniciox;
            $data->fecha_fin = $this->fecha_finx;
            $data->id_estado = $this->id_estadox;
    
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo el proyecto', 'success'];
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
