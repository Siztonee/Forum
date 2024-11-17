<header class="bg-gray-800 shadow-md">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold text-gray-100">
                    {{ config('app.name') }}
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="#" class="text-gray-300 hover:text-gray-100">Форумы</a>
                <a href="#" class="text-gray-300 hover:text-gray-100">Пользователи</a>
                @auth
                    <a href="{{ route('profile', auth()->user()->username) }}" class="text-gray-300 hover:text-gray-100">Профиль</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-gray-100">Выход</button>
                    </form>
                @else
                    <a href="{{ route('auth') }}" class="text-gray-300 hover:text-gray-100">Вход</a>
                    <a href="{{ route('register') }}" class="text-gray-300 hover:text-gray-100">Регистрация</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="sm:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-100 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Открыть меню</span>
                    <!-- Heroicon name: menu -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-menu hidden sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 rounded-md text-gray-300 hover:text-gray-100 hover:bg-gray-700">Форумы</a>
                <a href="#" class="block px-3 py-2 rounded-md text-gray-300 hover:text-gray-100 hover:bg-gray-700">Пользователи</a>
                @auth
                    <a href="{{ route('profile', auth()->user()->username) }}" class="block px-3 py-2 rounded-md text-gray-300 hover:text-gray-100 hover:bg-gray-700">Профиль</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-gray-300 hover:text-gray-100 hover:bg-gray-700">Выход</button>
                    </form>
                @else
                    <a href="{{ route('auth') }}" class="block px-3 py-2 rounded-md text-gray-300 hover:text-gray-100 hover:bg-gray-700">Вход</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-gray-300 hover:text-gray-100 hover:bg-gray-700">Регистрация</a>
                @endauth
            </div>
        </div>
    </nav>
</header>