@extends('layouts.app')

@section('title', 'Категории форума')

@section('content')
    <div class="bg-gray-900 min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-white">Категории форума</h1>
                
                @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator']))
                    <a href="{{ route('category.create') }}" 
                    class="flex items-center px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Создать категорию
                    </a>
                @endif
            </div>
            
            <div class="space-y-6">
                @forelse($categories as $category)
                    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                        <div class="flex items-center p-6">
                            <div class="flex-shrink-0 mr-6">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center" 
                                    style="background-color: {{ $category->bg_color }}">

                                    <i class="fas {{ $category->icon ?? '' }} text-3xl text-blue-300"></i>

                                </div>
                            </div>
                            
                            <div class="flex-grow">
                                <div class="flex items-center">
                                    <h2 class="text-xl font-semibold text-white mr-3">{{ $category->name ?? 'Имя' }}</h2>
                                    
                                    <a href="#" 
                                    class="text-gray-400 hover:text-white transition-colors">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </div>
                                
                                <p class="text-gray-400 mb-3">{{ $category->creator->username ?? 'Описание' }}</p>
                                
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span>
                                        <i class="fas fa-comment mr-1"></i>
                                        {{ $category->topics_count ?? '0' }} тем
                                    </span>
                                    <span>
                                        <i class="fas fa-message mr-1"></i>
                                        {{ $category->messages_count ?? '0' }} сообщений
                                    </span>
                                    
                                    @if (Auth::check() && Auth::user()->role != 'user')
                                        <span>
                                            <i class="fas fa-key mr-1"></i>
                                            {{ $category->access }}
                                        </span>
                                    @endif

                                </div>
                            </div>
                            
                            <div class="flex-shrink-0 ml-6">
                                <a href="{{ route('category.topics', $category->slug) }}" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                                    Перейти
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-gray-800 rounded-lg">
                        <p class="text-gray-400">В этой категории пока нет тем</p>
                        @if (Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator']))
                            <a href="{{ route('category.create') }}" 
                            class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">
                                Создать первую категорию
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection