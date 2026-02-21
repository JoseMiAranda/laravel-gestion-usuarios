# Gestión de Usuarios

Este proyecto es una aplicación web desarrollada en **Laravel** para la gestión integral de usuarios. Incluye un sistema de autenticación completo y un panel de administración para el control de los usuarios con acceso basado en roles y políticas de seguridad.

## Características Principales

- **Autenticación Clásica**: Registro, inicio de sesión (Login) y cierre de sesión (Logout).
- **CRUD de Usuarios**: Creación, listado, actualización y eliminación de usuarios.
- **Control de Acceso (Autorización)**: Distinción de acciones permitidas entre usuarios estándar y administradores.

---

## Validaciones de Rutas y Middleware

En el proyecto, la protección de las rutas web (`routes/web.php`) se lleva a cabo mediante el uso de **Middleware** y del sistema de autorización de Laravel (**Gates / Policies**). Esto asegura que solo las personas adecuadas interactúen con partes específicas de la aplicación.

Las validaciones principales son:

### 1. Validación de Autenticación (`auth`)
Impide el acceso a usuarios visitantes que no hayan iniciado sesión.
- **Uso:** `->middleware('auth')`
- **Comportamiento:** Si un usuario no autenticado intenta entrar a una ruta protegida (como el listado de usuarios), será redirigido automáticamente a la página de `/login`.

### 2. Validación de Rol de Administrador (`can:is-admin`)
Comprueba mediante un `Gate` definido en la aplicación si el usuario autenticado tiene un perfil o rol de administrador.
- **Uso:** `->middleware('can:is-admin')`
- **Rutas protegidas:** Listado general de usuarios (`/users`), formulario de creación (`/users/create`) y el procesamiento para guardar nuevos usuarios (`/users/store`).
- **Comportamiento:** Retorna un error de prohibición (403 Forbidden) si un usuario normal intenta acceder.

### 3. Validación de Políticas de Modelo (`can:update,user` y `can:delete,user`)
Verifica una "Policy" específica que evalúa si el usuario autenticado tiene los derechos para realizar una acción sobre el modelo `User` en cuestión. Generalmente permite a un usuario editar su propio perfil o a un administrador gestionar cualquier perfil.
- **Protección de Edición:** `->middleware('can:update,user')` aplicada a `/users/{user}/edit` y al método `update`.
- **Protección de Eliminación:** `->middleware('can:delete,user')` aplicada a la ruta de `destroy`.
- **Comportamiento:** Si el usuario no tiene permisos sobre el usuario que intenta modificar o eliminar, accederá a una página de error 403.

---

## Requisitos

- PHP >= 8.1
- Composer
- Laravel Herd o entorno local similar para el servidor web y base de datos (XAMPP, Docker, Valet, etc.)
- Node.js & NPM (para compilar los assets con Vite)

## Instalación y Configuración

1. Instala las dependencias del backend con Composer:
   ```bash
   composer install
   ```
2. Instala y compila las dependencias del frontend con NPM:
   ```bash
   npm install
   npm run build
   ```
3. Copia el archivo `.env.example` a un nuevo archivo `.env` y configura el acceso a tu base de datos:
   ```bash
   cp .env.example .env
   ```
4. Genera la clave de encriptación de Laravel:
   ```bash
   php artisan key:generate
   ```
5. Ejecuta las migraciones para crear la estructura de la base de datos (y los seeders si has configurado usuarios por defecto):
   ```bash
   php artisan migrate --seed
   ```
