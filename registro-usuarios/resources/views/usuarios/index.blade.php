@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Lista de Usuarios</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Botón de Registro de Usuario -->
        <div class="d-flex justify-content-between mb-3">
            <!-- <h5>Total de Usuarios: {{ $usuarios->total() }}</h5> -->
            <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Registrar Usuario
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
                                    <img src="{{ asset('/storage/fotos/' . basename($usuario->foto)) }}" alt="Foto" class="rounded-circle" width="60" height="60">                               
                                @endif
                            </td>
                            <td>
                                @if ($usuario->pokemon_favorito)
                                    @php
                                        $pokemonName = strtolower($usuario->pokemon_favorito);
                                        $page = file_get_contents('https://pokeapi.co/api/v2/pokemon/'.$pokemonName);
                                        $json = json_decode($page,true);
                                        $urlImg = $json['sprites']['front_default'];
                                    @endphp
                                    <img src="{{ $urlImg }}"
                                         alt="{{ ucfirst($usuario->pokemon_favorito) }}" class="img-fluid" width="50">
                                    <br>
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

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-3">
            {{ $usuarios->links() }}
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#usuariosTable').DataTable().destroy(); // Destruye la instancia anterior
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
