<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsuarioRegistrado;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    // Muestra la lista de usuarios con paginación
    public function index()
    {
        $usuarios = Usuario::latest()->paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    // Muestra el formulario para crear un usuario
    public function create()
    {
        return view('usuarios.create');
    }

    // Guarda un nuevo usuario
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'curp' => 'required|string|size:18|unique:usuarios',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|string|min:8',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pokemon_favorito' => 'required|string',
        ]);

        // Calcular la fecha de nacimiento y la edad desde el CURP
        $fechaNacimiento = $this->getFechaNacimientoFromCURP($request->curp);
        $edad = $this->calcularEdad($fechaNacimiento);

        // Subir la foto si existe
        $path = $request->hasFile('foto') ? $request->file('foto')->store('storage/fotos') : null;

        // Crear el usuario (sin guardar la edad en la base de datos)
        Usuario::create([
            'curp' => $request->curp,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pokemon_favorito' => $request->pokemon_favorito,
            'foto' => $path,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado exitosamente.');
    }

    // Función para obtener la fecha de nacimiento desde el CURP
    private function getFechaNacimientoFromCURP($curp)
    {
        if (strlen($curp) < 10) {
            return null; // Evita errores si el CURP no es válido
        }

        $anio = substr($curp, 4, 2);
        $mes = substr($curp, 6, 2);
        $dia = substr($curp, 8, 2);

        // Determinar el siglo correctamente
        $anio_completo = ($anio >= '00' && $anio <= date('y')) ? "20$anio" : "19$anio";

        return "$anio_completo-$mes-$dia"; // Formato YYYY-MM-DD
    }

    // Función para calcular la edad
    private function calcularEdad($fechaNacimiento)
    {
        return Carbon::parse($fechaNacimiento)->age;
    }

    // Muestra el formulario para editar un usuario
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualiza un usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'curp' => 'required|string|size:18|unique:usuarios,curp,' . $usuario->id,
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pokemon_favorito' => 'required|string',
        ]);

        // Subir nueva foto si existe
        if ($request->hasFile('foto')) {
            if ($usuario->foto && Storage::exists($usuario->foto)) {
                Storage::delete($usuario->foto);
            }
            $path = $request->file('foto')->store('storage/fotos');
        } else {
            $path = $usuario->foto;
        }

        // Actualizar usuario
        $usuario->update([
            'nombre' => $request->nombre,
            'curp' => $request->curp,
            'email' => $request->email,
            'pokemon_favorito' => $request->pokemon_favorito,
            'foto' => $path,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // Elimina un usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        // Eliminar la foto si existe
        if ($usuario->foto && Storage::exists($usuario->foto)) {
            Storage::delete($usuario->foto);
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
