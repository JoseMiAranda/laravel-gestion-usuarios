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

---

## Guía de Despliegue (Entornos como Plesk o CPanel)

Al publicar la aplicación en un entorno de producción (por ejemplo, mediante Plesk), es indispensable preparar los *assets* estáticos (CSS/JS compilados) y realizar una limpieza de la caché del servidor. Sigue estos pasos clave:

### 1. Compilación de Assets (Vite / NPM)

En desarrollo utilizamos `npm run dev`, pero para producción es obligatorio construir los archivos minificados y optimizados. Dentro de la raíz del proyecto o desde el terminal de tu panel de control, ejecuta:

```bash
npm install
npm run build
```

> **Nota:** El comando `build` hace la magia de generar el directorio `public/build/` y su correspondiente archivo `manifest.json`. Sin estos archivos, las directivas `@vite` en las plantillas de Blade fallarán, ya que Laravel depende estrictamente del manifiesto para ubicar los archivos finales.

### 2. Sincronización de Base de Datos

Asegúrate de configurar correctamente tu nuevo archivo `.env` de producción con los datos de tu base de datos remota antes de ejecutar ningún comando. Posteriormente, ejecuta las migraciones:

```bash
php artisan migrate
```

### 3. Limpieza de Caché y Optimización (Artisan)

Una vez subidos tus archivos o finalizado el despliegue automático, es una **práctica obligatoria** purgar todas las cachés anteriores de Laravel. Esto fuerza al sistema a leer los nuevos archivos `.env`, así como las rutas y vistas actualizadas:

```bash
php artisan optimize:clear
```

Ese comando borrará:
- Caché de vistas (`view:clear`)
- Caché de caché de rutas (`route:clear`)
- Caché de configuración (`config:clear`)
- Caché general de la aplicación (`cache:clear`)

Opcionalmente, y solo si estás en producción, puedes regenerar la caché optimizada ejecutando `php artisan optimize` para mejorar los tiempos de carga de la web.
