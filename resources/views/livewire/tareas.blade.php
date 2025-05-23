<div>
    @section('title', 'Tareas')
    <div class="container-fluid">
        <div class="row text-center mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="display-4">Tareas</h1>
                <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                    data-bs-target="#modalCrearSlug">+</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                            <th colspan="4">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control"
                                    placeholder="Buscar..."
                                    wire:model="search">
                                </div>
                            </th>
                            <th colspan="3">
                                <div class="input-group input-group-sm">
                                    <input type="date" class="form-control"
                                    wire:model="search_fecha_inicio">
                                </div>
                            </th>
                            <th colspan="3">
                                <div class="input-group input-group-sm">
                                    <input type="date" class="form-control"
                                    wire:model="search_fecha_fin">
                                </div>
                            </th>
                            <tr>
                                <th class="text-center">Titulo</th>
                                <th class="text-center">Descripcion</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Prioridad</th>
                                <th class="text-center">Categoria</th>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Proyecto</th>
                                <th class="text-center">Fecha Inicio</th>
                                <th class="text-center">Fecha Fin</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->tareas as $cat)
                                <tr>
                                    <td class="text-center">{{ $cat->titulo }}</td>
                                    <td class="text-center">{{ $cat->descripcion }}</td>
                                    <td class="text-center">{{ $estados::find($cat->id_estado)->nombre}}</td>
                                    <td class="text-center">{{ $prioridades::find($cat->id_prioridad)->nombre}}</td>
                                    <td class="text-center">{{ $categorias::find($cat->id_categoria)->nombre}}</td>
                                    <td class="text-center">{{ $usuario::find($cat->id_user)->name}}</td>
                                    <td class="text-center">{{ $proyectos::find($cat->id_proyectos)->titulo}}</td>
                                    <td class="text-center">{{ $cat->fecha_inicio }}</td>
                                    <td class="text-center">{{ $cat->fecha_fin }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-warning"
                                                wire:click="cargacategory({{ $cat }})" data-bs-toggle="modal"
                                                data-bs-target="#Modaleditar"><i class="fas fa-user-edit"></i></button>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                wire:click="$emit('deletePost',{{$cat->id}})"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">No hay registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $this->tareas->links() }}
                </div>
            </div>
        </div>

        {{-- Modal crear categoria --}}
        <div class="modal fade" id="modalCrearSlug" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Tarea</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="@error('titulo') text-danger @enderror">Titulo</label>
                                        <input type="text" class="form-control @error('titulo') text-danger @enderror" wire:model="titulo">
                                        <i class="text-danger">
                                            @error('titulo') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="@error('descripcion') text-danger @enderror">Descripcion</label>
                                        <textarea class="form-control @error('descripcion') text-danger @enderror" wire:model="descripcion" rows="4"></textarea>
                                            <i class="text-danger">
                                                @error('descripcion') {{ $message }} @enderror
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
                                    <div class="form-group mb-2">
                                        <label class="@error('id_prioridad') text-danger @enderror">Priodidad</label>
                                        <select class="form-select @error('id_prioridad') text-danger @enderror" wire:model="id_prioridad">
                                            <option value="">Seleccione una opción...</option>
                                            @foreach ($prioridad as $pri)
                                                <option value="{{$pri->id}}">{{ $pri->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <i class="text-danger">
                                            @error('id_prioridad') {{ $message }} @enderror
                                        </i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label class="@error('id_categoria') text-danger @enderror">Categoria</label>
                                        <select class="form-select @error('id_categoria') text-danger @enderror" wire:model="id_categoria">
                                            <option value="">Seleccione una opción...</option>
                                            @foreach ($categoria as $cate)
                                                <option value="{{$cate->id}}">{{ $cate->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <i class="text-danger">
                                            @error('id_categoria') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="@error('id_proyectos') text-danger @enderror">Proyecto</label>
                                        <select class="form-select @error('id_proyectos') text-danger @enderror" wire:model="id_proyectos">
                                            <option value="">Seleccione una opción...</option>
                                            @foreach ($proyecto as $proy)
                                                <option value="{{$proy->id}}">{{ $proy->titulo }}</option>
                                            @endforeach
                                        </select>
                                        <i class="text-danger">
                                            @error('id_proyectos') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('fecha_inicio') text-danger @enderror">Fecha Inicio</label>
                                        <input type="date" class="form-control @error('fecha_inicio') text-danger @enderror" wire:model="fecha_inicio">
                                        <i class="text-danger">
                                            @error('fecha_inicio') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('fecha_fin') text-danger @enderror">Fecha Fin</label>
                                        <input type="date" class="form-control @error('fecha_fin') text-danger @enderror" wire:model="fecha_fin">
                                        <i class="text-danger">
                                            @error('fecha_fin') {{ $message }} @enderror
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Tarea</button>
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
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Categoria</h4>
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
                                                <div class="form-group">
                                                    <label class="@error('id_estadox') text-danger @enderror">Estado</label>
                                                    <select class="form-select @error('id_estadox') text-danger @enderror" wire:model="id_estadox">
                                                        <option value="">Seleccione una opción...</option>
                                                        @foreach ($estado as $est)
                                                            <option value="{{$est->id}}">{{ $est->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="text-danger">
                                                        @error('id_estadox') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="@error('id_prioridadx') text-danger @enderror">Priodidad</label>
                                                    <select class="form-select @error('id_prioridadx') text-danger @enderror" wire:model="id_prioridadx">
                                                        <option value="">Seleccione una opción...</option>
                                                        @foreach ($prioridad as $pri)
                                                            <option value="{{$pri->id}}">{{ $pri->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="text-danger">
                                                        @error('id_prioridadx') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                    <label class="@error('id_categoriax') text-danger @enderror">Categoria</label>
                                                    <select class="form-select @error('id_categoriax') text-danger @enderror" wire:model="id_categoriax">
                                                        <option value="">Seleccione una opción...</option>
                                                        @foreach ($categoria as $cate)
                                                            <option value="{{$cate->id}}">{{ $cate->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="text-danger">
                                                        @error('id_categoriax') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="@error('id_proyectosx') text-danger @enderror">Proyecto</label>
                                                    <select class="form-select @error('id_proyectosx') text-danger @enderror" wire:model="id_proyectosx">
                                                        <option value="">Seleccione una opción...</option>
                                                        @foreach ($proyecto as $proy)
                                                            <option value="{{$proy->id}}">{{ $proy->titulo }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="text-danger">
                                                        @error('id_proyectosx') {{ $message }} @enderror
                                                    </i>
                                                </div>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" wire:click="actua">Editar
                                        Tarea</button>
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
                    livewire.emitTo('tareas', 'delete', postId);

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