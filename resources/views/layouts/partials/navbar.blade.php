<nav class="bg-white shadow-md">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-800">Coworking</a>

      <!-- Menú de navegación -->
      <div class="space-x-4 flex items-center">
          <a href="{{ url('/espacios.index') }}" class="text-gray-600 hover:text-blue-500">Espacios</a>
          <a href="{{ url('/reservas.index') }}" class="text-gray-600 hover:text-blue-500">Reservas</a>

          @guest
              <a href="{{ url('/login') }}" class="text-gray-600 hover:text-blue-500">Login</a>
              <a href="{{ url('/register') }}" class="text-gray-600 hover:text-blue-500">Registro</a>
          @else
              <form action="{{ url('/logout') }}" method="GET" class="inline">
                  @csrf
                  <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
              </form>
          @endguest
      </div>
  </div>
</nav>
