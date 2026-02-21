<form action="/register" method="post">
    @csrf
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" placeholder="Jhon Doe" value="{{ old('name') }}">
    @error('name')
        <p>{{ $message }}</p>
    @enderror
    <br>

    <label for="email">Correo electrónico: </label>
    <input type="email" id="email" name="email" placeholder="jhon@email.com" value="{{ old('email') }}">
    @error('email')
        <p>{{ $message }}</p>
    @enderror
    <br>

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password">
    @error('password')
        <p>{{ $message }}</p>
    @enderror
    <br>

    <label for="password_confirmation">Confirmar Contraseña</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
    <br>

    <label for="role">Rol</label>
    <select id="role" name="role">
        @foreach ($roles as $role)
            <option value="{{ $role->value }}" @selected(old('role') === $role->value)>{{ $role->name }}</option>
        @endforeach
    </select>
    <br>

    <button>Registrarse</button>
</form>
