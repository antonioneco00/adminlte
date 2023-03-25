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
                            <label for="background_color">Color de fondo</label>
                            <input type="color" name="background_color" class="form-control" id="background_color">
                        </div>

                        <div class="form-group">
                            <label for="text_color">Color de texto</label>
                            <input type="color" name="text_color" class="form-control" id="text_color">
                        </div>

                        <div class="form-group">
                            <label for="border_color">Color de borde</label>
                            <input type="color" name="border_color" class="form-control" id="border_color">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save-event-type">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="edit-nombre">
                        </div>

                        <div class="form-group">
                            <label for="background_color">Color de fondo</label>
                            <input type="color" name="background_color" class="form-control" id="edit-background_color">
                        </div>

                        <div class="form-group">
                            <label for="text_color">Color de texto</label>
                            <input type="color" name="text_color" class="form-control" id="edit-text_color">
                        </div>

                        <div class="form-group">
                            <label for="border_color">Color de borde</label>
                            <input type="color" name="border_color" class="form-control" id="edit-border_color">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="editBtn btn btn-primary" data-dismiss="modal"
                            id="update-event-type">Save
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
                    <button type="button" class="deleteBtn btn btn-danger" data-dismiss="modal">Delete
                        eventType</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped table-bordered" id="eventTypesTable">
        <thead class="bg-primary">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Color de fondo</th>
                <th>Color de texto</th>
                <th>Borde</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventTypes as $eventType)
                <tr id="eventType--{{ $eventType->id }}">
                    <td>{{ $eventType->id }}</td>
                    <td id="name--{{ $eventType->id }}">{{ $eventType->name }}</td>
                    <td id="background_color--{{ $eventType->id }}"><i class="fa fa-fw fa-square"
                            style="color: {{ $eventType->background_color }}"></i><span>{{ $eventType->background_color }}</span>
                    </td>
                    <td id="text_color--{{ $eventType->id }}"><i class="fa fa-fw fa-square"
                            style="color: {{ $eventType->text_color }}"></i><span>{{ $eventType->text_color }}</span></td>
                    <td id="border_color--{{ $eventType->id }}"><i class="fa fa-fw fa-square"
                        style="color: {{ $eventType->border_color }}"></i><span>{{ $eventType->border_color }}</span></td>
                    <td><button data-toggle="modal" data-target="#editModal" class="showEditModal"
                            data-id="{{ $eventType->id }}"><i class="fas fa-fw fa-solid fa-edit"></i></button><button
                            data-toggle="modal" data-target="#deleteModal" class="showDeleteModal"
                            data-id="{{ $eventType->id }}"><i class="fas fa-fw fa-solid fa-trash"></i></button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script type="module" src={{ asset('js/eventType.js') }}></script>
@stop
