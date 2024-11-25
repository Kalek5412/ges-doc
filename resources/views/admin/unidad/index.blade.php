@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">mi unidad </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="bi bi-folder-fill"></i> carpeta
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">nombre de la carpeta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form action="{{ url('/admin/unidad') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="user_id" class="form-control"
                                                    value="{{ Auth::user()->id }}" hidden>
                                                <input type="text" name="nombre" class="form-control" id="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">crear</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </ol>
        </div>
    </div>
    <hr>
    <h3>carpetas</h3>
    <div class="row">
        @foreach ($carpetas as $carpeta)
            <div class="col-md-3">
                <div style="background:white;border:1px solid #c0c0c0; border-radius:  10px; margin-top:10px "
                    data-toggle="tooltip" data-placement="bottom" title="{{ $carpeta->nombre }}">
                    <div class="row" style="padding: 15px">
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <i class="bi bi-folder-fill" style="font-size: 24pt; color: {{ $carpeta->color }}"></i>
                        </div>
                        <div class="col-8" style="margin-top: 5px;">
                            <a href="{{ url('admin/unidad/carpeta', $carpeta->id) }}"
                                style="color: #333; font-size: 16px; font-weight: 600; text-decoration: none;">
                                {{ $carpeta->nombre }}
                            </a>
                        </div>
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <div class="btn-group" role="group">
                                <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"
                                    style="color: #007bff; background: none; border: none; font-size: 16px;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item" data-toggle="modal"
                                        data-target="#modal_cambiar_nombre{{ $carpeta->id }}"><i
                                            class="bi bi-pencil"></i>cambiar nombre
                                    </a>
                                    <a href="#" class="dropdown-item"><i class="bi bi-gear"></i>
                                        eveneto
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ url('/admin/unidad') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="blue" id="" hidden>
                                                <input type="text" name="id" value="{{ $carpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:blue"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('/admin/unidad') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="green" id="" hidden>
                                                <input type="text" name="id" value="{{ $carpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:green"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('/admin/unidad') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="yellow" id=""
                                                    hidden>
                                                <input type="text" name="id" value="{{ $carpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:yellow"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('/admin/unidad') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="red" id=""
                                                    hidden>
                                                <input type="text" name="id" value="{{ $carpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:red"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </a>
                                    <form action="{{url('admin/unidad/eliminar_carpeta',$carpeta->id)}}" onclick="preguntar_c{{$carpeta->id}}(event)"
                                        method="post" id="miFormulario{{$carpeta->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="id" value="{{$carpeta->id}}" hidden>
                                        <button type="submit" class="dropdown-item"><i class="bi bi-trash"></i>
                                            Eliminar</button>
                                    </form>
                                    <script>
                                        function preguntar_c{{$carpeta->id}}(event) {
                                            event.preventDefault();
                                            Swal.fire({
                                                title: 'Eliminar registro',
                                                text: '¿Desea eliminar este registro?',
                                                icon: 'question',
                                                showDenyButton: true,
                                                confirmButtonText: 'Eliminar',
                                                confirmButtonColor: '#a5161d',
                                                denyButtonColor: '#270a0a',
                                                denyButtonText: 'Cancelar',
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    var form = $('#miFormulario{{$carpeta->id}}');
                                                    form.submit();
                                                }
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para cambiar nombre de la carpeta-->
            <div class="modal fade" id="modal_cambiar_nombre{{ $carpeta->id }}" data-backdrop="static"
                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">cambiar nombre de la carpeta</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="{{ url('/admin/unidad') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" value="{{ $carpeta->id }}" name="id" hidden>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="nombre" class="form-control"
                                                value="{{ $carpeta->nombre }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
