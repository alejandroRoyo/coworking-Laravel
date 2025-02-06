<nav style="background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div
        style="max-width: 1280px; margin: 0 auto; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
        <!-- Logo -->
        <a href="{{ url('/home') }}" style="font-size: 1.5rem; font-weight: 700; color: #4a5568;">Coworking</a>

        <!-- Menú de navegación -->
        <div style="display: flex; align-items: center; gap: 1rem;">
            @auth
                <a href="{{ url('/espacios') }}" style="color: #4a5568; text-decoration: none; transition: color 0.3s;"
                    onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#4a5568'">Espacios</a>
                <a href="{{ url('/reservas') }}" style="color: #4a5568; text-decoration: none; transition: color 0.3s;"
                    onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#4a5568'">Reservas</a>
            @endauth
            @guest
                <a href="{{ url('/login') }}" style="color: #4a5568; text-decoration: none; transition: color 0.3s;"
                    onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#4a5568'">Login</a>
                <a href="{{ url('/register') }}" style="color: #4a5568; text-decoration: none; transition: color 0.3s;"
                    onmouseover="this.style.color='#3b82f6'" onmouseout="this.style.color='#4a5568'">Registro</a>
            @else
                <form action="{{ url('/logout') }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit"
                        style="color: #ef4444; background: none; border: none; cursor: pointer; transition: color 0.3s;"
                        onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#ef4444'">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
