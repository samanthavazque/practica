@extends('layouts.app')

@section('content')
<!-- Estilos personalizados -->
<style>
    body {
        background: url('https://source.unsplash.com/1920x1080/?technology') no-repeat center center fixed;
        background-size: cover;
    }

    .login-container {
        margin-top: 100px;
    }

    .card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.3);
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
        border-radius: 15px;
    }

    .btn-primary {
        background: linear-gradient(45deg, #007bff, #007bff);
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        transform: scale(1.05);
    }

    /* Mejorar visibilidad del enlace */
    .text-link {
        color: rgb(0, 123, 255) !important;
        font-weight: bold;
    }
</style>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <div class="card-header text-center text-dark">
                    <h3 class="mb-0"><i class="fas fa-user-lock"></i> {{ __('Iniciar Sesión') }}</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        <!-- Correo Electrónico -->
                        <div class="form-group mb-3">
                            <label for="email">{{ __('Correo Electrónico') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Ingresa tu correo">
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group mb-3">
                            <label for="password">{{ __('Contraseña') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Ingresa tu contraseña">
                                <button type="button" class="btn btn-outline-secondary toggle-password" onclick="togglePassword()">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Botón de Iniciar Sesión -->
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-sign-in-alt"></i> {{ __('Iniciar sesión') }}
                            </button>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-0">¿No tienes cuenta? 
                            <a href="{{ route('register') }}" class="text-link">Regístrate aquí</a>
                        </p>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
    function togglePassword() {
        let passwordInput = document.getElementById('password');
        let icon = document.querySelector('.toggle-password i');

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
