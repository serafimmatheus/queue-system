<x-layouts.auth-layout>
  <div>
    <h1>Home</h1>

    <a href="{{ route('logout') }}" class="btn w-full">Sair</a>

    <h4 class="text-lg font-medium text-zinc-600">bem vindo: {{ auth()->user()->email }}</h4>
  </div>
</x-layouts.auth-layout>