@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="my-4 text-center">Editar Usuario</h1>

                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
                    </div>

                    <!-- CURP -->
                    <div class="form-group">
                        <label for="curp">CURP</label>
                        <input type="text" id="curp" name="curp" class="form-control" value="{{ $usuario->curp }}" required>
                    </div>

                    <!-- correo -->
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
                    </div>

                    <!-- Contraseña -->
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <!-- Foto -->
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                        @if($usuario->foto)
                            <br>
                            <img src="{{ asset('storage/fotos/' . basename($usuario->foto)) }}" alt="Foto" class="rounded-circle" width="60" height="60">
                            @endif
                    </div>

                    <!-- Pokémon Favorito -->
                    <div class="form-group">
                        <label for="pokemon_favorito">Pokémon Favorito</label>
                        <select id="pokemon_favorito" name="pokemon_favorito" class="form-control" required>
                            <option value="">Selecciona tu Pokémon</option>
                        </select>
                        <br>
                        <img id="pokemon_img" src="" alt="Imagen del Pokémon" width="120" class="d-none">
                    </div>

                    <button type="submit" class="btn btn-success mt-3 w-100">Actualizar</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
       $(document).ready(function() {
        let selectPokemon = $('#pokemon_favorito');
        let pokemonImg = $('#pokemon_img');
        let usuarioPokemon = "{{ $usuario->pokemon_favorito ?? '' }}"; // Pokémon actual del usuario

        // Cargar lista de Pokémon desde la API
        $.get('https://pokeapi.co/api/v2/pokemon?limit=100', function(data) {
            data.results.forEach(pokemon => {
                let option = new Option(pokemon.name, pokemon.name); // Guardar solo el nombre
                selectPokemon.append(option);
            });

            // Seleccionar el Pokémon del usuario si tiene uno
            if (usuarioPokemon) {
                selectPokemon.val(usuarioPokemon);
                loadPokemonImage(usuarioPokemon); // Llamar la función después de seleccionar
            }
        });

        // Función para cargar la imagen del Pokémon seleccionado
        function loadPokemonImage(name) {
            if (!name) {
                pokemonImg.addClass('d-none').attr('src', '');
                return;
            }
            $.get(`https://pokeapi.co/api/v2/pokemon/${name.toLowerCase()}`, function(pokemonData) {
                pokemonImg.attr('src', pokemonData.sprites.front_default).removeClass('d-none');
            }).fail(function() {
                pokemonImg.addClass('d-none').attr('src', '');
            });
        }

        // Cambiar la imagen al seleccionar otro Pokémon
        selectPokemon.change(function() {
            let selectedName = $(this).val();
            loadPokemonImage(selectedName);
        });
    });

    </script>
    @endpush
@endsection
