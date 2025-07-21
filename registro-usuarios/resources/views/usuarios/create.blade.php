@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="my-4 text-center">Registrar Usuario</h1>

                <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>

                    <!-- CURP -->
                    <div class="form-group">
                        <label for="curp">CURP</label>
                        <input type="text" id="curp" name="curp" class="form-control" value="{{ old('curp') }}" required>
                    </div>

                    <!-- Correo -->
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <!-- Contraseña -->
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <!-- Foto -->
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>

                    <!-- Pokémon Favorito -->
                    <div class="form-group">
                        <label for="pokemon_favorito">Pokémon Favorito</label>
                        <select id="pokemon_favorito" name="pokemon_favorito" class="form-control" required>
                            <option value="">Selecciona un Pokémon</option>
                        </select>
                        <br>
                        <img id="pokemon_img" src="" alt="Imagen del Pokémon" width="120" class="d-none">
                    </div>

                    <button type="submit" class="btn btn-success mt-3 w-100">Registro</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            let selectPokemon = $('#pokemon_favorito');
            let pokemonImg = $('#pokemon_img');
            let usuarioPokemon = "{{ old('pokemon_favorito') ?? '' }}"; // Intentar recuperar la selección anterior

            // Cargar lista de Pokémon desde la API
            $.get('https://pokeapi.co/api/v2/pokemon?limit=100', function(data) {
                data.results.forEach(pokemon => {
                    let option = new Option(pokemon.name, pokemon.name);
                    selectPokemon.append(option);
                });

                if (usuarioPokemon) {
                    selectPokemon.val(usuarioPokemon);
                    loadPokemonImage(usuarioPokemon);
                }
            });

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

            selectPokemon.change(function() {
                let selectedName = $(this).val();
                loadPokemonImage(selectedName);
            });
        });
    </script>
    @endpush
@endsection
