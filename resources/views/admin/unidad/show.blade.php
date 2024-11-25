@extends('layouts.admin')

@section('content')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $carpeta->nombre }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <div>
                    <a href="{{ url('/admin/unidad') }}" type="button" class="btn btn-primary mr-2">
                        <i class="bi bi-arrow-bar-left"></i> volver
                    </a>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_cargar_archivos">
                        <i class="bi bi-cloud-upload-fill"></i> subir archvio
                    </button>
                    <!-- Modal para subir archivos-->
                    <div class="modal fade" id="modal_cargar_archivos" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">sube un archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </div>

                                <form action="{{ url('admin/unidad/carpeta/upload') }}" method="POST" class="dropzone"
                                    id="myDropzone" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="text" value="{{ $carpeta->id }}" name="id" hidden>
                                        <div class="fallback">
                                            <input type="file" type="file" multiple />
                                        </div>
                                    </div>
                                    {{--                      <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">crear</button>
                                        </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        Dropzone.options.myDropzone = {
                            paramName: "file",
                            dictDefaultMessage: "Arrstra y suelta los arquivos aqui o click para seleccioanr archviso!..."
                        };
                    </script>
                    <button type="button" class="btn btn-secondary mr-2" data-toggle="modal" data-target="#exampleModal">
                        <i class="bi bi-folder-fill"></i> nueva carpeta
                    </button>
                    <!-- Modal de creacion de carpetas-->
                    <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">carpeta</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </div>

                                <form action="{{ url('/admin/unidad/carpeta/crear_subcarpeta') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" value="{{ $carpeta->id }}"
                                                        name="carpeta_padre_id" hidden>
                                                    <input type="text" name="user_id" class="form-control"
                                                        value="{{ Auth::user()->id }}" hidden>
                                                    <input type="text" name="nombre" class="form-control">
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">crear</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </ol>
        </div>
    </div>
    <hr>
    <h3>carpetas y archivos</h3>
    <div class="row">
        @foreach ($subcarpetas as $subcarpeta)
            <div class="col-md-3">
                <div style="background:white;border:1px solid #c0c0c0; border-radius:  10px; margin-top:10px ">
                    <div class="row" style="padding: 15px">
                        <div class="col-2 d-flex justify-content-center align-items-center">
                            <i class="bi bi-folder-symlink-fill"
                                style="font-size: 24pt; color: {{ $subcarpeta->color }}"></i>
                        </div>
                        <div class="col-8" style="margin-top: 5px;">
                            <a href="{{ url('admin/unidad/carpeta', $subcarpeta->id) }}"
                                style="color: #333; font-size: 16px; font-weight: 600; text-decoration: none;">
                                {{ $subcarpeta->nombre }}
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
                                        data-target="#modal_cambiar_nombre{{ $subcarpeta->id }}"><i
                                            class="bi bi-pencil"></i>cambiar nombre
                                    </a>
                                    <a href="#" class="dropdown-item"><i class="bi bi-gear"></i>
                                        eveneto
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ url('/admin/unidad/carpeta') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="blue" id=""
                                                    hidden>
                                                <input type="text" name="id" value="{{ $subcarpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:blue"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('/admin/unidad/carpeta') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="green" id=""
                                                    hidden>
                                                <input type="text" name="id" value="{{ $subcarpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:green"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('/admin/unidad/carpeta') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="yellow" id=""
                                                    hidden>
                                                <input type="text" name="id" value="{{ $subcarpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:yellow"></i>
                                                </button>
                                            </form>
                                            <form action="{{ url('/admin/unidad/carpeta') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="color" value="red" id=""
                                                    hidden>
                                                <input type="text" name="id" value="{{ $subcarpeta->id }}"
                                                    id="" hidden>
                                                <button style="background-color: white;border:0px">
                                                    <i class="bi bi-circle-fill" style="color:red"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item"><i class="bi bi-trash"></i> Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal fade" id="modal_cambiar_nombre{{ $subcarpeta->id }}" data-backdrop="static"
                data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">cambiar nombre de la carpeta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/admin/unidad/carpeta') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" value="{{ $subcarpeta->id }}" name="id" hidden>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="nombre" class="form-control"
                                                value="{{ $subcarpeta->nombre }}">
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
    <hr>
    <table class="table table-responsive table-hover table-striped">
        <thead>
            <tr>
                <th>nr</th>
                <th>nombre</th>
                <th>fecha</th>
                <th>acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($archivos as $archivo)
                <tr>
                    <td style="text-align: center">{{ $i = $i + 1 }}</td>
                    <td>
                        <?php
                        $nombre=$archivo->nombre;
                        $extension=pathinfo($nombre, PATHINFO_EXTENSION);
                        if($extension=='png' || $extension=='jpg'){?>
                        <img src="{{ mix('resources/template/img/icon_jpg.png') }}" width="30px" alt="">
                        <?php  }                   
                        if($extension=='pdf'){?>
                        <img src="{{ mix('resources/template/img/icon_pdf.png') }}" width="30px" alt="">
                        <?php  }        
                        if($extension=='docx' || $extension=='doc' ){?>
                        <img src="{{ mix('resources/template/img/icon_word.png') }}" width="30px" alt="">
                        <?php  }         
                        if($extension=='xlsx' || $extension=='xls' || $extension=='xlsm'){?>
                        <img src="{{ mix('resources/template/img/icon_excel.png') }}" width="30px" alt="">
                        <?php }        
                        ?>
                        <a data-toggle="modal" data-target="#modal_visor{{ $archivo->id }}">
                            {{ $archivo->nombre }}
                        </a>
                        <?php if($extension=='png' || $extension=='jpg'){?>
                        <div class="modal fade" id="modal_visor{{ $archivo->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $archivo->nombre }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ mix('storage/' . $carpeta->id . '/' . $archivo->nombre) }}"
                                            width="100%" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  }?>

                        <?php if($extension=='pdf'){?>
                        <div class="modal fade" id="modal_visor{{ $archivo->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $archivo->nombre }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <iframe src="{{ mix('storage/' . $carpeta->id . '/' . $archivo->nombre) }}"
                                            width="100%" height="550px" alt=""></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  }?>

                        <?php if($extension=='docx' || $extension=='doc'){?>
                        <div class="modal fade" id="modal_visor{{ $archivo->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $archivo->nombre }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ mix('resources/template/img/icon_word.png') }}" width="50%"
                                            alt=""><br>
                                        <a href="{{ mix('storage/' . $carpeta->id . '/' . $archivo->nombre) }}"
                                            class="btn btn-success">
                                            descargar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  }?>
                        <?php if($extension=='mp4'){?>

                        <div class="modal fade" id="modal_visor{{ $archivo->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $archivo->nombre }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <video id="my-video" class="video-js" controls preload="auto" data-setup="{}">
                                            <source
                                                src="{{ mix('storage/' . $carpeta->id . '/' . $archivo->nombre) }}"
                                                type="video/mp4" />
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  }?>
                    </td>
                    <td>{{ $archivo->created_at }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">


                            <form action="{{ url('/admin/unidad/carpeta') }}"
                                onclick="preguntar{{ $archivo->id }}(event)" method="POST"
                                id="miFormulario{{ $archivo->id }}">
                                @csrf
                                @method('DELETE')
                                <input type="text" value="{{ $archivo->id }}" name="id" hidden>
                                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                            <script>
                                function preguntar{{ $archivo->id }}(event) {
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
                                            var form = $('#miFormulario{{ $archivo->id }}');
                                            form.submit();
                                        }
                                    });
                                }
                            </script>
                            <button class="btn btn-success" data-toggle="modal"
                                data-target="#modal_compartir_{{ $archivo->id }}"><i class="bi bi-share-fill"></i>

                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal_compartir_{{ $archivo->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{ $archivo->nombre }}</p>
                                            <?php 
                                            if(($archivo->estado_archivo)=="PRIVADO"){?>
                                            <b>archivo de ofrma priivada</b>
                                            <form action="{{ route('unidad.archivo.cambiar.privado.publico') }}"
                                                method="GET">
                                                @csrf
                                                <input type="text" name="id" value="{{ $archivo->id }}" hidden>
                                                <button class="btn btn-success" type="submit">cambair pulbico</button>
                                            </form>

                                            <?php 
                                            }else{?>
                                            <b>archivo de ofrmula publica</b>
                                            <form action="{{ route('unidad.archivo.cambiar.publico.privado') }}"
                                                method="post">
                                                @csrf
                                                <input type="text" name="id" value="{{ $archivo->id }}" hidden>
                                                <button class="btn btn-primary" type="submit">cambair privado</button>
                                            </form>

                                            <hr>
                                                <button type="button" class="btn btn-outline-primary"  data-clipboard-target="#foo{{$archivo->id}}" hidden>copiar link</button>
                                                <input type="text" id="foo{{$archivo->id}}" value="{{asset('http://localhost/gestion-documentos/public/'.'storage/'.$carpeta->id.'/'.$archivo->nombre) }}" class="form-control">
                                                <script>var clipboard=new Clipboard('.btn');</script>
                                                <br>
                                                <div id="qrcode{{$archivo->id}}" style="align-items: center"></div>
                                                <script>
                                                    var opciones={
                                                        width:150,
                                                        height:150
                                                    };
                                                    var texto="{{asset('localhost/gestion-documentos/public/'.'storage/'.$carpeta->id.'/'.$archivo->nombre) }}";
                                                    var qrcode= new QRCode("qrcode{{$archivo->id}}",opciones);
                                                    qrcode.makeCode(texto);
                                                </script>
                                            <?php }?>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


   
@endsection
