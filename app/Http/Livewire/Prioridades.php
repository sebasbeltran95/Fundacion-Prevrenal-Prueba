<?php

namespace App\Http\Livewire;

use App\Models\Prioridades as ModelsPrioridades;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class Prioridades extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $nombre;
    public $idx, $nombrex;
    public $search  = "";

        protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

        public function getPrioridadProperty()
    {
        if($this->search == ""){
            return ModelsPrioridades::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsPrioridades::
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

        
            $user = new ModelsPrioridades();
            $user->nombre =  $this->nombre;
            $user->save();

            $this->reset();
            $msj = ['!Registrado!', 'Se registro la Prioridad', 'success'];
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

            $data = ModelsPrioridades::find($this->idx);
            $data->nombre = $this->nombrex;
    
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo la Prioridad', 'success'];
            $this->emit('ok', $msj);

          } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }




    public function render()
    {
        return view('livewire.prioridades')->extends('layouts.plantilla_back')->section('contenido');
    }
}
