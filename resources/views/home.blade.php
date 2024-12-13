@extends('layouts.app')

@section('title', 'Главная')

@section('content')
<div class="container mx-auto px-4 py-6 space-y-6 text-gray-300">
    <!-- Приветственный баннер с легким неоновым эффектом -->
    <div class="bg-gray-900 border border-indigo-500/30 rounded-lg p-6 shadow-lg shadow-indigo-500/20 
                transition hover:shadow-indigo-500/40">
        <h1 class="text-3xl font-bold text-indigo-300 mb-3 
                   drop-shadow-[0_0_5px_rgba(99,102,241,0.5)]">
            Добро пожаловать на форум
        </h1>
        <p class="text-gray-400 text-base">
            Присоединяйтесь к нашему сообществу для обсуждения интересных тем и знакомств
        </p>
    </div>

    <!-- Статистика с неоновыми карточками -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @foreach([
            ['count' => $stats['topicsCount'], 'label' => 'Тем', 'color' => 'blue'],
            ['count' => $stats['messagesCount'], 'label' => 'Сообщений', 'color' => 'green'],
            ['count' => $stats['usersTotal'], 'label' => 'Пользователей', 'color' => 'purple']
        ] as $stat)
            @include('components.stat-card', $stat)
        @endforeach
    </div>

    <!-- Секция категорий -->
    <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-800">
            <h2 class="text-xl font-semibold text-gray-100 
                       hover:text-indigo-300 transition">
                <a href="{{ route('categories') }}">Категории форума</a>
            </h2>
        </div>
        
        @forelse ($lastCategories as $category)
            <div class="border-t border-gray-800 hover:bg-gray-800/50 transition">
                <x-category-item :category="$category" />
            </div>
        @empty
            <div class="p-4 text-gray-500">Категории не найдены</div>
        @endforelse
    </div>

    <!-- Последние обсуждения -->
    <div class="bg-gray-900 rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-800">
            <h2 class="text-xl font-semibold text-gray-100">
                Последние обсуждения
            </h2>
        </div>
        
        @forelse ($lastTopics as $topic)
            <x-topic-item :topic="$topic" />
        @empty
            <div class="p-4 text-gray-500">Темы не найдены</div>
        @endforelse
    </div>

    <!-- Онлайн пользователи -->
    <livewire:online-users />
</div>
@endsection