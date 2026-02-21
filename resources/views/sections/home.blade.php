@extends('layout.app')
@section('content')
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">

      <div>
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Home</h2>
      </div>

        @auth
            <p class="text-center text-xl text-green-600">Bienvenido {{ auth()->user()->name }}!</p>
        @endauth

        @guest
            <p class="text-center text-xl text-orange-400">Hola invitado/a.</p>
            <p>Inicia sesión desde le menú superior o regístrate si todavía no tienes cuenta.</p>
        @endguest
    </div>
</div>
@endsection
