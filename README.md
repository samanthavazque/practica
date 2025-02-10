CRUD de Usuarios con Laravel y AngularJS

Descripción
Este proyecto es una aplicación CRUD para el registro y gestión de usuarios. Se desarrolló utilizando Laravel para el backend y AngularJS para el frontend, con MySQL como base de datos. Además, se implementó Bootstrap y DataTables para mejorar la interfaz de usuario y la paginación.

Características
- Registro y login de usuarios** con autenticación.
- CRUD de usuarios** con las operaciones de crear, leer, actualizar y eliminar.
- Paginación con DataTables.
- Consumo de la API de Pokémon** para seleccionar un Pokémon favorito.
- Cálculo de la edad a partir del CURP (sin almacenarla en la base de datos).
- Subida de archivos** (foto de usuario).
- Envío de correo electrónico** al completar el registro.

Tecnologías Utilizadas
- Backend: Laravel
- Frontend: AngularJS, Bootstrap
- Base de Datos: MySQL
- Librerías Adicionales**: DataTables, Laravel Mail

Instalación y Configuración
Requisitos Previos
- PHP 8+
- Composer
- MySQL
- Node.js y npm

Pasos de Instalación
1. Clonar el repositorio:
   ```sh
   git clone https://github.com/tu-usuario/tu-repositorio.git
   cd tu-repositorio
   ```
2. Instalar dependencias:
   ```sh
   composer install
   npm install
   ```
3. Configurar el entorno:
   - Copiar el archivo `.env.example` y renombrarlo a `.env`.
   - Configurar la conexión a la base de datos en `.env`:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=root
     DB_USERNAME=usuario
     DB_PASSWORD=
     ```
4. Generar clave de aplicación:
   ```sh
   php artisan key:generate
   ```
5. Ejecutar migraciones y seeders:
   ```sh
   php artisan migrate --seed
   ```
6. **Levantar el servidor:**
   ```sh
   php artisan serve
   ```

 Configuración del Frontend
1. Acceder al directorio del frontend
   ```sh
   cd frontend
   ```
2. Ejecutar la aplicación:
   ```sh
   npm start
   ```

Uso de la Aplicación
1. Acceder a `http://localhost:8000` para el backend.
2. Acceder a `http://localhost:4200` para la interfaz de usuario.
3. Registrar un usuario y recibir un correo de confirmación.
4. Gestionar los usuarios con las opciones CRUD disponibles.


 GET|HEAD  login ............................................................... login › AuthController@showLoginForm
  POST      login ................................................................ login.submit › AuthController@login
  POST      logout .................................................................... logout › AuthController@logout
  GET|HEAD  register ...................................................... register › AuthController@showRegisterForm
  POST      register ....................................................... register.submit › AuthController@register
  GET|HEAD  storage/{path} ............................................................................. storage.local
  GET|HEAD  up .......................................................................................................
  GET|HEAD  usuarios ........................................................ usuarios.index › UsuarioController@index
  POST      usuarios ........................................................ usuarios.store › UsuarioController@store
  GET|HEAD  usuarios/create ............................................... usuarios.create › UsuarioController@create
  PUT       usuarios/{id} ................................................. usuarios.update › UsuarioController@update
  DELETE    usuarios/{id} ............................................... usuarios.destroy › UsuarioController@destroy
  GET|HEAD  usuarios/{id}/edit ................................................ usuarios.edit › UsuarioController@edit

Contribución
Si deseas contribuir, por favor envía un pull request o abre un issue en GitHub.



