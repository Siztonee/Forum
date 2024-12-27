
<header class="bg-gray-900 shadow-md">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent">
                    {{ config('app.name') }}
                </a>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                    <a class="text-gray-300 hover:text-gray-100 px-2" href="{{ route('notifications') }}">Уведомления</a>
                    <div class="relative group">
                        <img 
                            src="{{ asset(auth()->user()->profile_image) }}" 
                            alt="Profile" 
                            class="w-10 h-10 rounded-full cursor-pointer transition-transform duration-300 group-hover:scale-110 ring-2 ring-indigo-500 ring-opacity-50"
                        >
                        

                        <div class="absolute right-0 top-full mt-2 w-48 bg-gray-800 rounded-lg shadow-lg border border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="py-1">
                                <a href="{{ route('profile', auth()->user()->username) }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
                                    Профиль
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">
                                        Выход
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if(in_array(Auth::user()->role, ['admin', 'moderator']))
                            <button id="mobile-menu-button" class="p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button> 
                        @endif
                @else
                    <a href="{{ route('auth') }}" class="text-gray-300   px-3 py-2 rounded-md transition-colors">Вход</a>
                @endauth
            </div>
        </div>
    </nav>
</header>
