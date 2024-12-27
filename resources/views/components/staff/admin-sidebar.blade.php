@if(in_array(Auth::user()->role, ['admin', 'moderator']))
<aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full bg-gray-900 border-r border-gray-700">
    <div class="flex flex-col h-full">
        <div class="p-4 border-b border-gray-700">
            <h2 class="text-xl font-semibold text-center">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400">
                    Админ панель
                </span>
            </h2>
        </div>
        
        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('panel') }}" class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 group transition-all duration-200 hover:shadow-[0_0_1px_#fff,0_0_2px_#0088ff]">
                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="ml-3">Админ панель</span>
            </a>

        </nav>
    </div>
</aside>

<!-- Затемнение фона -->
<div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>
@endif