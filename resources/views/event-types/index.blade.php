@extends('adminlte::page')

@section('title', 'Tipos de eventos')

@section('content_header')
    <h1>Todos los tipos de eventos</h1>
@stop

@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#createModal">
        Añadir tipo de evento
    </button>

    <!-- Modal Crear -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Tipo de Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="nombre">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save-eventType">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres eliminar el tipo de evento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="deleteBtn btn btn-danger" data-dismiss="modal">Delete eventType</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table" id="eventTypesTable">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Color de fondo</th>
            <th>Color de texto</th>
            <th>Borde</th>
            <th>Acciones</th>
        </tr>
        @foreach ($eventTypes as $eventType)
            <tr>
                <td>{{ $eventType->id }}</td>
                <td>{{ $eventType->name }}</td>
                <td>{{ $eventType->background_color }}</td>
                <td>{{ $eventType->text_color }}</td>
                <td>{{ $eventType->border_color }}</td>
                <td><button data-toggle="modal" data-target="#deleteModal" class="showDeleteModal"
                        data-id="{{ $eventType->id }}"><i class="fas fa-fw fa-solid fa-trash"></i></button></td>
            </tr>
        @endforeach
    </table>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script type="module" src={{ asset('js/eventType.js') }}></script>
@stop
