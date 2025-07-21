@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Lista de Usuarios</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('usuarios.create') }}" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </a>
    </div>

    <div class="table-responsive">
        <table id="usuariosTable" class="table table-hover" width="100%">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>CURP</th>
                    <th>Edad</th>
                    <th>Fecha de Registro</th>
                    <th>Foto</th>
                    <th>Pokémon Favorito</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr class="text-center align-middle">
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->curp }}</td>
                        <td>{{ $usuario->edad }}</td>
                        <td>{{ \Carbon\Carbon::parse($usuario->fecha_registro)->format('d/m/Y') }}</td>
                       <td>
    @if ($usuario->foto)
        @php
            $extension = strtolower(pathinfo($usuario->foto, PATHINFO_EXTENSION));
            $urlFoto = asset('storage/fotos/' . basename($usuario->foto));
        @endphp

        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
            <img src="{{ $urlFoto }}" alt="Foto" class="rounded-circle" width="60" height="60">
        @elseif ($extension === 'pdf')
            <a href="{{ $urlFoto }}" target="_blank" class="text-danger fw-bold">
                <i class="fas fa-file-pdf fa-2x"></i><br>Ver PDF
            </a>
        @else
            <a href="{{ $urlFoto }}" target="_blank">
                <i class="fas fa-file-alt fa-2x"></i><br>Ver Archivo
            </a>
        @endif
    @else
        <span class="text-muted">No disponible</span>
    @endif
</td>

                        <td>
                            @if ($usuario->pokemon_imagen)
                                <img src="{{ $usuario->pokemon_imagen }}" alt="{{ ucfirst($usuario->pokemon_favorito) }}" class="img-fluid" width="50"><br>
                                {{ ucfirst($usuario->pokemon_favorito) }}
                            @else
                                <span class="text-muted">No seleccionado</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $usuarios->links() }}
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#usuariosTable').DataTable().destroy();
        $('#usuariosTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>
@endpush
@endsection
