<div class="flex h-16 items-center justify-between">
    <div class="flex items-center">
        <div class="ml-10 flex items-baseline space-x-4">

            @php
                $currentRoute = request()->path();
            @endphp

            <nav class="flex space-x-4">
                <a href="/"
                    class="{{ $currentRoute === '/' ? 'text-orange-300 font-semibold' : ' hover:text-orange-300' }}">
                    Inicio
                </a>
            </nav>

        </div>
    </div>

    <!-- Enlaces para login/register -->
    <div class="ml-4 mr-10 flex items-center md:ml-6">
        <!-- Visible para invitados -->
        @guest
            <nav class="flex space-x-4">
                <a href="/login"
                    class="{{ $currentRoute === 'login' ? 'text-orange-300 font-semibold' : ' hover:text-orange-300' }}">
                    Log In
                </a>
                <a href="/register"
                    class="{{ $currentRoute === 'register' ? 'text-orange-300 font-semibold' : ' hover:text-orange-300' }}">
                    Registro
                </a>
            </nav>
        @endguest

        <!-- Visible para usuarios autenticados -->
        @auth
            <div class="flex space-x-4">
                @can('is-admin')
                    <a href="/users"
                        class="{{ $currentRoute === 'usuarios' ? 'text-orange-300 font-semibold' : 'hover:text-orange-300' }}">
                        Usuarios
                    </a>
                @endcan

                @can('is-user')
                    <a href="/users/2"
                        class="{{ $currentRoute === 'usuarios' ? 'text-orange-300 font-semibold' : 'hover:text-orange-300' }}">
                        Ver perfil
                    </a>
                @endcan

                <form method="POST" action="/logout">
                    @csrf
                    <button class-name="text-gray-300 hover:text-white bg-transparent hover:bg-transparent">Cerrar
                        sesión</button>
                </form>
            </div>
        @endauth
    </div>
</div>
