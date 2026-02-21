<form action="/login" method="post">
    @csrf
    <label for="email">Correo electrónico: </label>
    <input type="email" id="email" name="email" placeholder="jhon@email.com" value="{{ old('email') }}">
    @error('email')
        <p>{{ $message }}</p>
    @enderror
    <br>

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password">
    <br>
    <button>Iniciar Sesión</button>
</form>
