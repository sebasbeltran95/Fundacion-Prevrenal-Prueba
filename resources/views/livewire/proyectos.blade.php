<div>
    @section('title', 'Proyectos')
    <div class="container-fluid">
        <div class="row text-center mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="display-4">Proyectos</h1>
                <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                    data-bs-target="#modalCrearSlug">+</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                            <th colspan="6">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control"
                                    placeholder="Buscar..."
                                    wire:model="search">
                                </div>
                            </th>
                            <tr>
                                <th class="text-center">titulo</th>
                                <th class="text-center">descripcion</th>
                                <th class="text-center">fecha inicio</th>
                                <th class="text-center">fecha fin</th>
                                <th class="text-center">estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->proyectos as $cat)
                                <tr>
                                    <td class="text-center">{{ $cat->titulo }}</td>
                                    <td class="text-center">{{ $cat->descripcion }}</td>
                                    <td class="text-center">{{ $cat->fecha_inicio }}</td>
                                    <td class="text-center">{{ $cat->fecha_fin }}</td>
                                    <td class="text-center">{{ $cat->id_estado }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-warning"
                                                wire:click="cargacategory({{ $cat }})" data-bs-toggle="modal"
                                                data-bs-target="#Modaleditar"><i class="fas fa-user-edit"></i></button>
                                            {{--  <button type="submit" class="btn btn-sm btn-danger"
                                                wire:click="$emit('deletePost',{{$cat->id}})"><i
                                                    class="fas fa-trash-alt"></i></button>  --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $this->proyectos->links() }}
                </div>
            </div>
        </div>

        {{-- Modal crear categoria --}}
        <div class="modal fade" id="modalCrearSlug" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Proyecto</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="@error('titulox') text-danger @enderror">Titulo</label>
                                        <input type="text" class="form-control @error('titulox') text-danger @enderror" wire:model="titulox">
                                        <i class="text-danger">
                                            @error('titulox') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="@error('descripcionx') text-danger @enderror">Descripcion</label>
                                        <textarea class="form-control @error('descripcionx') text-danger @enderror" wire:model="descripcionx" rows="4"></textarea>
                                            <i class="text-danger">
                                                @error('descripcionx') {{ $message }} @enderror
                                            </i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="@error('fecha_iniciox') text-danger @enderror">Fecha Inicio</label>
                                        <input type="date" class="form-control @error('fecha_iniciox') text-danger @enderror" wire:model="fecha_iniciox">
                                        <i class="text-danger">
                                            @error('fecha_iniciox') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('fecha_finx') text-danger @enderror">Fecha Fin</label>
                                        <input type="date" class="form-control @error('fecha_finx') text-danger @enderror" wire:model="fecha_finx">
                                        <i class="text-danger">
                                            @error('fecha_finx') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('id_estado') text-danger @enderror">Estado</label>
                                        <select class="form-select @error('id_estado') text-danger @enderror" wire:model="id_estado">
                                            <option value="">Seleccione una opción...</option>
                                            @foreach ($estado as $est)
                                                <option value="{{$est->id}}">{{ $est->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <i class="text-danger">
                                            @error('id_estado') {{ $message }} @enderror
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Proyecto</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin modal crear categoria --}}


        {{--  editar   --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="Modaleditar" tabindex="-1" wire:ignore.self>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Proyecto</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="@error('nombrex') text-danger @enderror">Nombre</label>
                                        <input type="text" class="form-control @error('nombrex') text-danger @enderror" wire:model="nombrex">
                                        <i class="text-danger">
                                            @error('nombrex') {{ $message }} @enderror
                                        </i>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" wire:click="actua">Editar
                                        Proyecto</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  editar   --}}
    </div>
</div>
@push('js')
    <script>
        Livewire.on('ok', msj =>{
            Swal.fire(
                msj[0],
                msj[1],
                msj[2],
            )
        });
        livewire.on('deletePost', postId => {
            Swal.fire({
                title: "¿Estas Seguro?",
                text: "¿Desea Eliminar este registro?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "SI"
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emitTo('category', 'delete', postId);

                    Swal.fire({
                    title: "!Eliminado!",
                    text: "Se elimino la Categoria",
                    icon: "success"
                    });
                }
            });
        });
    </script>
@endpush