@extends('layouts.app')

@section('content')
<!-- Estilos personalizados -->
<style>
    body {
        background: url('https://source.unsplash.com/1920x1080/?technology') no-repeat center center fixed;
        background-size: cover;
    }

    .register-container {
        margin-top: 50px;
    }

    .card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.3);
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        border-radius: 15px;
        padding: 20px;
    }

    .btn-primary {
        background: linear-gradient(45deg, #007bff, #007bff);
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        transform: scale(1.05);
    }

    .text-link {
        color: #007bff !important;
        font-weight: bold;
    }
</style>

<div class="container register-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center text-dark">
                    <h3 class="mb-0"><i class="fas fa-user-plus"></i> {{ __('Registro') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.submit') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="form-group mb-3">
                            <label for="name">{{ __('Nombre') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="name" type="text" class="form-control" name="name" required autofocus placeholder="Ingresa tu nombre">
                            </div>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="form-group mb-3">
                            <label for="email">{{ __('Correo Electrónico') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control" name="email" required placeholder="Ingresa tu correo">
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Ingresa tu contraseña">
                                <button type="button" class="btn btn-outline-secondary toggle-password" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirmación de Contraseña -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation">{{ __('Confirmar Contraseña') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Confirma tu contraseña">
                                <button type="button" class="btn btn-outline-secondary toggle-password" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-user-plus"></i> {{ __('Registrarse') }}
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p>¿Ya tienes cuenta? 
                            <a href="{{ route('login') }}" class="text-link">Inicia sesión aquí</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
    function togglePassword(fieldId) {
        let passwordInput = document.getElementById(fieldId);
        let icon = passwordInput.nextElementSibling.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<!-- FontAwesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@endsection
