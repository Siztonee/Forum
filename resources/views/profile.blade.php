@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="min-h-screen bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Профиль header -->
            <div class="bg-gray-800 rounded-lg shadow-xl p-6 mb-6">
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                    <!-- Аватар с бейджем онлайн статуса -->
                    <div class="relative">
                        <img src="{{ $user->profile_image }}" 
                             alt="Profile picture" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-blue-500">
                        <div class="absolute bottom-0 right-0 bg-green-500 w-6 h-6 rounded-full border-4 border-gray-800"></div>
                    </div>
                    
                    <div class="flex-1 text-center md:text-left">
                        <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                            <h1 class="text-2xl font-bold text-white">{{ $user->username }}</h1>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-900 text-blue-200">
                                {{ $user->role }}
                            </span>
                        </div>
                        <p class="text-gray-400 mt-1">Участник с {{ $user->created_at->format('F Y') }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 rounded-full text-sm bg-gray-700 text-gray-300">
                                <i class="fas fa-message mr-1"></i>
                                {{ $user->posts_count ?? 0 }} сообщений
                            </span>
                            <span class="px-3 py-1 rounded-full text-sm bg-gray-700 text-gray-300">
                                <i class="fas fa-trophy mr-1"></i>
                                {{ $user->reputation ?? 0 }} репутация
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Достижения -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-white mb-4">Достижения</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        {{-- @foreach($achievements as $achievement) --}}
                        <div class="flex flex-col items-center p-3 bg-gray-700 rounded-lg">
                            <div class="w-12 h-12 rounded-full bg-blue-900 flex items-center justify-center mb-2">
                                <i class="fas {{ $achievement->icon ?? '' }} text-xl text-blue-300"></i>
                            </div>
                            <span class="text-sm text-center text-gray-300">{{ $achievement->name ?? 'Name' }}</span>
                        </div>
                        {{-- @endforeach --}}
                    </div>
                </div>

                <!-- Статистика -->
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-white mb-4">Статистика активности</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Темы создано</span>
                            <span class="text-white font-medium">{{ $user->topics_count ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Лучших ответов</span>
                            <span class="text-white font-medium">{{ $user->best_answers_count ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-400">Дней на форуме</span>
                            <span class="text-white font-medium">
                                {{ $user->created_at->startOfDay()->diffInDays(now()->startOfDay()) }}
                            </span>                                                   
                        </div>
                    </div>
                </div>
            </div>

            <!-- Последние сообщения -->
            <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-white mb-4">Последние сообщения</h2>
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4 py-3">
                        <div class="flex items-center justify-between mb-2">
                            <a href="{#" 
                               class="text-blue-400 hover:text-blue-300">
                                {{ $post->topic->title ?? 'Title' }}
                            </a>
                            <span class="text-sm text-gray-500">
                                00:00
                            </span>
                        </div>
                        <p class="text-gray-400 line-clamp-2">{{ $post->content ?? 'Content' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection