@extends('layouts.app')

@section('title', 'Главная')

@section('content')
<div class="space-y-6">
    <!-- Приветственный баннер -->
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Добро пожаловать на форум</h1>
        <p class="text-gray-600">Присоединяйтесь к нашему сообществу для обсуждения интересных тем</p>
    </div>

    <!-- Статистика -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="text-xl font-semibold text-gray-900">0</div>
            <div class="text-gray-600">Тем</div>
        </div>
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="text-xl font-semibold text-gray-900">0</div>
            <div class="text-gray-600">Сообщений</div>
        </div>
        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="text-xl font-semibold text-gray-900">0</div>
            <div class="text-gray-600">Пользователей</div>
        </div>
    </div>

    <!-- Категории форума -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="border-b border-gray-200 p-4">
            <h2 class="text-lg font-semibold text-gray-900">Категории форума</h2>
        </div>
        <div class="divide-y divide-gray-200">
            {{-- @forelse($categories ?? [] as $category) --}}
            <div class="p-4 hover:bg-gray-50 transition">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <!-- Иконка категории -->
                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="#" class="text-lg font-medium text-blue-600 hover:text-blue-800">
                            Имя категории
                        </a>
                        <p class="mt-1 text-sm text-gray-600">description</p>
                        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                            <div>0 тем</div>
                            <div>0 сообщений</div>
                        </div>
                    </div>
                    {{-- @if($category->latest_post) --}}
                    <div class="hidden sm:block flex-shrink-0 text-sm text-gray-500">
                        <div>Последнее сообщение</div>
                        <div class="mt-1">от <span class="text-blue-600">name</span></div>
                        <div>00:00</div>
                    </div>
                    {{-- @endif --}}
                </div>
            </div>
            {{-- @empty
            <div class="p-4 text-center text-gray-500">
                Категории пока не созданы
            </div>
            @endforelse --}}
        </div>
    </div>

    <!-- Последние обсуждения -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="border-b border-gray-200 p-4">
            <h2 class="text-lg font-semibold text-gray-900">Последние обсуждения</h2>
        </div>
        <div class="divide-y divide-gray-200">
            {{-- @forelse($latestTopics ?? [] as $topic) --}}
            <div class="p-4 hover:bg-gray-50 transition">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="https://placehold.co/4x3" alt="">
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="#" class="text-base font-medium text-blue-600 hover:text-blue-800">
                            title
                        </a>
                        <div class="mt-1 flex items-center space-x-2 text-sm text-gray-500">
                            <span>name</span>
                            <span>•</span>
                            <span>00:00</span>
                            <span>•</span>
                            <span>0 ответов</span>
                        </div>
                    </div>
                    <div class="hidden sm:block flex-shrink-0 text-sm text-gray-500">
                        <div>Последний ответ</div>
                        <div>00:00</div>
                    </div>
                </div>
            </div>
            {{-- @empty
            <div class="p-4 text-center text-gray-500">
                Обсуждения пока не созданы
            </div>
            @endforelse --}}
        </div>
        {{-- @if($latestTopics && $latestTopics->count() > 0) --}}
        <div class="border-t border-gray-200 p-4">
            <a href="#" class="text-blue-600 hover:text-blue-800">Смотреть все обсуждения →</a>
        </div>
        {{-- @endif --}}
    </div>

    <!-- Онлайн пользователи -->
    <div class="bg-white shadow-sm rounded-lg p-4">
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Сейчас онлайн</h2>
        <div class="flex flex-wrap gap-2">
            {{-- @forelse($onlineUsers ?? [] as $user) --}}
            <a href="#" class="inline-flex items-center space-x-2">
                <img class="h-6 w-6 rounded-full" src="https://via.placeholder.com/24" alt="">
                <span class="text-sm text-blue-600 hover:text-blue-800">name</span>
            </a>
            {{-- @empty
            <div class="text-gray-500">Нет пользователей онлайн</div>
            @endforelse --}}
        </div>
    </div>
</div>
@endsection