<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ ucfirst($valores_tipo.'s') }} :: {{ $vista_tit }}</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="row">
                <div id="nav" class="top-right links">
                        <a href="{{ route('users_lista') }}">Usuarios</a>
                        <a href="{{ route('posts_lista') }}">Posts</a>
                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            </div>

            <div id="panel-contenido-main" class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Gestión de datos</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active">Usuarios</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Main row -->
                        <div class="row">

                        @if ($vista_tipo == 'listado')

                            @include('inc.modal_ins_user')

                            @isset($accion)
                                @include('inc.modal_accion_msg', [
                                    'accion' => $accion
                                ])
                            @endisset

                            <section class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex p-0">
                                        <h3 class="card-title p-3">
                                            <i class="fas fa-users mr-1"></i>
                                            {{-->> SIN Paginación
                                            Usuarios [<strong>{{ $valoresTOT }}</strong> disponible(s)]--}}
                                            {{-->> CON Paginación--}}
                                            Usuarios [<strong>{{ $valores->total() }}</strong> disponible(s)]
                                        </h3>
                                        <ul class="nav nav-pills ml-auto p-2">
                                            <li class="nav-item">
                                                <button class="nav-link btn btn-primary" type="button" title="Insertar registro" data-toggle="modal" data-target="#regInsModal">Nuevo</button>
                                            </li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>NICK</th>
                                                    <th>Email</th>
                                                    <th>Fecha Registro</th>
                                                    <th>Activo</th>
                                                    <th>Modificar</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php //var_dump($valores);
                                                //>> SIN Paginación
                                                ////$contador = 0;
                                                //>> CON Paginación
                                                //      => Orden ASC
                                                ////$contador = ($valores->perPage() * ($valores->currentPage() - 1));
                                                //      => Orden DESC
                                                $contador = ($valores->total() - ($valores->perPage() * ($valores->currentPage() - 1))); ?>
                                                @forelse ($valores as $valor)
                                                    {{-- SIN o CON Paginación [ASC] --}}
                                                    {{--@php
                                                        $contador++;
                                                    @endphp--}}

                                                @include('inc.modal_confirm_del', [
                                                    'modal_id' => 'confirmModal_' . $valor->id,
                                                    'ruta_nom' => 'users_borrar',
                                                ])

                                                <tr>
                                                    <td class="lista_indice">{{ $contador < 10 ? '0'.$contador : $contador }}</td>
                                                    <td><a href="{{ url('/'.$valores_tipo.'s/detalle/'.$valor->id) }}" title="Ir al detalle" class="negrita{{ $valor->activo == 0 ? ' registro_activo_no' : ' registro_activo_si' }}">{{ $valor->name }}</a></td>
                                                    <td>{{ $valor->username }}</td>
                                                    <td>{{ $valor->email }}</td>
                                                    <td>{{ $valor->created_at }}</td>
                                                    @php
                                                        $valor_activo_tit = '';
                                                        $valor_activo_nuevo = '';
                                                        if($valor->activo == 0) {
                                                            $valor_activo_tit = 'Clic para activar';
                                                            $valor_activo_nuevo = 1;
                                                        } else {
                                                            $valor_activo_tit = 'Clic para desactivar';
                                                            $valor_activo_nuevo = 0;
                                                        }
                                                    @endphp
                                                    <td><form action="{{ route('users_editar_campo', ['id' => $valor->id, 'campo' => 'activo', 'valor' => $valor_activo_nuevo]) }}" method="get"><input type="checkbox"{{ $valor->activo == 1 ? ' checked' : '' }} onchange="this.form.submit();" title="{{ $valor_activo_tit }}"></form></td>
                                                    <td><a href="{{ route('users_detalle', ['id' => $valor->id]) }}" class="text-primary" title="Editar este registro"><i class="fas fa-pencil-alt"></i></a> <a href="javascript: void(0);" class="text-danger" title="Borrar este registro" data-toggle="modal" data-target="#confirmModal_{{ $valor->id }}"><i class="fas fa-trash-alt"></i></a></td>
                                                </tr>

                                                    {{-- CON Paginación [DESC] --}}
                                                    @php
                                                        $contador--;
                                                    @endphp

                                                @empty

                                                <tr>
                                                    <td colspan="7">:: No existen registros en este momento ::<td>
                                                </tr>

                                                @endforelse
                                            </tbody>
                                        </table>

                                        {{--PAGINACIÓN::Enlaces--}}
                                        {{ $valores->links() }}
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </section>

                        {{-- Siendo listado o detalle --}}
                        @else

                            <section class="col-lg-12">

                                <form action="{{ route('users_editar') }}" method="post" class="needs-validation" novalidate>
                                    @csrf

                                    <fieldset>
                                        <legend>Usuario :: Datos personales</legend>

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Nombre</label>
                                                <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Nombre" value="{{ $valor->name }}" required>
                                                <div class="valid-feedback">
                                                    ¡OK!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor, teclea un NOMBRE.
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">Email</label>
                                                <input type="text" class="form-control" name="email" id="validationCustom02" placeholder="Email" value="{{ $valor->email }}" required>
                                                <div class="valid-feedback">
                                                    ¡OK!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor, teclea un EMAIL.
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Nick</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    </div>
                                                    <input type="text" class="form-control borde_redondeo_lateral_dcho" name="username" id="validationCustomUsername" placeholder="Nick" value="{{ $valor->username }}" aria-describedby="inputGroupPrepend" required>
                                                    <div class="valid-feedback">
                                                        ¡OK!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Por favor, teclea un NICK.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom03">Dirección</label>
                                                <input type="text" class="form-control" name="direction" id="validationCustom03" placeholder="Dirección" value="{{ $valor->direction }}" required>
                                                <div class="valid-feedback">
                                                    ¡OK!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor, teclea una DIRECCIÓN.
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom04">País</label>
                                                <input type="text" class="form-control" name="country" id="validationCustom04" placeholder="País" value="{{ $valor->country }}" required>
                                                <div class="valid-feedback">
                                                    ¡OK!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor, teclea un PAÍS.
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom05">Teléfono</label>
                                                <input type="text" class="form-control" name="phone" id="validationCustom05" placeholder="Teléfono" value="{{ $valor->phone }}" required>
                                                <div class="valid-feedback">
                                                    ¡OK!
                                                </div>
                                                <div class="invalid-feedback">
                                                    Por favor, teclea un TElÉFONO.
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="activo">Activo</label>
                                                <select name="activo" id="activo" class="custom-select" required>
                                                    <option value="">Seleccionar una opción</option>
                                                    <option value="1"{{ $valor->activo == 1 ? ' selected' : '' }}>Si</option>
                                                    <option value="0"{{ $valor->activo == 0 ? ' selected' : '' }}>No</option>
                                                </select>
                                                <div class="valid-feedback">¡OK!</div>
                                                <div class="invalid-feedback">Elegir una de las opciones</div>
                                            </div>
                                        </div>
                                        {{--
                                            Otros tipos de campos que aceptan esta validación de Bootstrap:
                                                >> https://getbootstrap.com/docs/4.2/components/forms/?#supported-elements
                                                >> y las de alrededor
                                        --}}
                                        {{--
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
                                                <label class="form-check-label" for="invalidCheck">
                                                    Agree to terms and conditions
                                                </label>
                                                <div class="invalid-feedback">
                                                    You must agree before submitting.
                                                </div>
                                            </div>
                                        </div>
                                        --}}
                                        <div class="form-group text-right">
                                            <a href="{{ route('users_lista') }}" title="Volver al listado" class="mr-3">Volver al listado</a>
                                            <input type="hidden" name="id" value="{{ $valor->id }}">
                                            <button class="btn btn-primary" type="submit" title="Editar registro">Editar</button>
                                            <button class="btn btn-danger" type="button" title="Borrar registro" data-toggle="modal" data-target="#confirmModal">Borrar</button>

                                            @include('inc.modal_confirm_del', [
                                                'modal_id' => 'confirmModal',
                                                'ruta_nom' => 'users_borrar',
                                            ])
                                        </div>

                                        <div class="col-xs|sm|md|lg|xl-1-12">
                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </div>

                                        <hr>

                                    {{-- Viendo si hay posts relacionados con el usuario --}}
                                    @if (count($valor->posts) > 0)
                                        <div class="container">
                                            <ul>
                                                <li>Este usuario es autor de [ <strong>{{ count($valor->posts) }}</strong> ] post(s):
                                                    <ul>
                                                        @foreach ($valor->posts as $post)
                                                            <li><a href="{{ route('posts_detalle', ['id' => $post->id]) }}" title="Ir al detalle">{{ $post->titulo }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    @else
                                        <div class="container">
                                            <ul>
                                                <li>Este usuario <strong>NO</strong> ha realizado ningún post.</li>
                                            </ul>
                                        </div>
                                    @endif

                                    </fieldset>
                                </form>

                            </section>

                        {{-- Siendo listado o detalle --}}
                        @endif
                        </div>
                        <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>

        </div>

        {{-- jQuery, Bootstrap --}}
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Validación de Formulario --}}
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>

        @isset($accion)
        <!--Mostrando MODAL de acción en la carga de la página si es que existe dicho parámetro-->
        <script type="text/javascript">
            $(window).on('load', function(){
                $('#accion-modal').modal('show');
            });
        </script>
        @endisset

        {{-- Mostrando Modal de Insertar-Registro si hubiera errores --}}
        @if (count($errors) > 0)
            {{-- $errors --}}
        <script type="text/javascript">
            $("#{{ old('modalIns') }}").modal('show');
        </script>
        @endif
    </body>
</html>
