@extends('layouts.app')

@section('title', 'Главная')

@section('content')
<div class="space-y-6 bg-gray-900 text-gray-300">
    <!-- Приветственный баннер -->
    <div class="bg-gray-800 shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-100 mb-2">Добро пожаловать на форум</h1>
        <p class="text-gray-400">Присоединяйтесь к нашему сообществу для обсуждения интересных тем</p>
    </div>

    <!-- Статистика -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gray-800 shadow-md rounded-lg p-4">
            <div class="text-xl font-semibold text-gray-100">{{ $topicsCount }}</div>
            <div class="text-gray-400">Тем</div>
        </div>
        <div class="bg-gray-800 shadow-md rounded-lg p-4">
            <div class="text-xl font-semibold text-gray-100">{{ $messagesCount }}</div>
            <div class="text-gray-400">Сообщений</div>
        </div>
        <div class="bg-gray-800 shadow-md rounded-lg p-4">
            <div class="text-xl font-semibold text-gray-100">{{ $usersTotal }}</div>
            <div class="text-gray-400">Пользователей</div>
        </div>
    </div>

    <!-- Категории форума -->
    <div class="bg-gray-800 shadow-md rounded-lg">
        <div class="border-b border-gray-700 p-4">
            <h2 class="text-lg font-semibold text-gray-100">
                <a href="{{ route('categories') }}">Категории форума</a>
            </h2>
        </div>
        <div class="divide-y divide-gray-700">
            <div class="p-4 hover:bg-gray-700 transition">
                @if ($lastCategory) 
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center" 
                            style="background-color: {{ $lastCategory->bg_color }}">

                            <i class="fas {{ $lastCategory->icon ?? '' }} text-3xl text-blue-300"></i>

                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('category.topics', $lastCategory->slug) }}" class="text-lg font-medium text-indigo-400 hover:text-indigo-300">
                            {{ $lastCategory->name }}
                        </a>
                        <p class="mt-1 text-sm text-gray-400">
                            <a href="{{ route('profile', $lastCategory->creator->username) }}" class="text-indigo-400">
                                {{ $lastCategory->creator->username }}
                            </a>
                        </p>
                        <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                            <div>{{ $lastCategory->topics_count }} тем</div>
                            <div>{{ $lastCategory->messages_count }} сообщений</div>
                        </div>
                    </div>
                    <div class="hidden sm:block flex-shrink-0 text-sm text-gray-500">
                        <div>Последнее сообщение</div>
                        <div class="mt-1">от 
                            <span class="text-indigo-400">
                                <a href="{{ route('profile', $lastCategory->creator->username) }}">
                                    {{ $lastMessage->sender->username }}
                                </a>
                            </span>
                        </div>
                        <div>{{ $lastMessage->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Последние обсуждения -->
    <div class="bg-gray-800 shadow-md rounded-lg">
        <div class="border-b border-gray-700 p-4">
            <h2 class="text-lg font-semibold text-gray-100">Последние обсуждения</h2>
        </div>
        <div class="divide-y divide-gray-700">
            <div class="p-4 hover:bg-gray-700 transition">
                @if ($lastTopic)
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="{{ $lastTopic->creator->profile_image }}" 
                            alt="{{ $lastTopic->creator->username }}">
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('category.topic', [$lastTopic->category->slug, $lastTopic->slug]) }}" class="text-base font-medium text-indigo-400 hover:text-indigo-300">
                            {{ $lastTopic->name }}
                        </a>
                        <div class="mt-1 flex items-center space-x-2 text-sm text-gray-500">
                            <span>
                                <a href="{{ route('profile', $lastTopic->creator->username) }}" class="text-indigo-400">
                                    {{ $lastTopic->creator->username }}
                                </a>
                            </span>
                            <span>•</span>
                            <span>{{ $lastTopic->created_at->diffForHumans() }}</span>
                            <span>•</span>
                            <span>{{ $lastTopic->messages_count }} ответов</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Онлайн пользователи -->
    <livewire:online-users />


</div>
@endsection