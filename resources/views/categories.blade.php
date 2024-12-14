@extends('layouts.app')

@section('title', 'Категории форума')

@section('content')
    <div class="py-10">
        <div class="max-w-full sm:max-w-xl md:max-w-2xl lg:max-w-4xl mx-auto px-4 sm:px-6 lg:px-4">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-4 sm:mb-0">Категории форума</h1>
                
                @if(Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator']))
                    <a href="{{ route('category.create') }}" 
                    class="flex items-center justify-center w-full sm:w-auto px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Создать категорию
                    </a>
                @endif
            </div>
            
            <div class="space-y-4 sm:space-y-6">
                @forelse($categories as $category)
                    <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl">
                        <div class="flex flex-col sm:flex-row items-center p-4 sm:p-6">
                            <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-6 flex justify-center w-full sm:w-auto">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center" 
                                    style="background-color: {{ $category->bg_color }}">
                                    <i class="fas {{ $category->icon ?? '' }} text-2xl sm:text-3xl text-blue-300"></i>
                                </div>
                            </div>
                            
                            <div class="flex-grow text-center sm:text-left w-full">
                                <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start mb-2">
                                    <h2 class="text-lg sm:text-xl font-semibold text-white sm:mr-3 mb-2 sm:mb-0">{{ $category->name ?? 'Имя' }}</h2>
                                    
                                    <a href="{{ route('category.settings', $category->slug) }}" 
                                    class="text-gray-400 hover:text-white transition-colors hidden sm:block">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </div>
                                
                                <p class="text-gray-400 mb-3 text-sm">
                                    <x-username :user="$category->creator"/>
                                </p>
                                
                                <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start space-y-2 sm:space-y-0 sm:space-x-4 text-xs sm:text-sm text-gray-500">
                                    <span class="mr-4 sm:mr-0">
                                        <i class="fas fa-comment mr-1"></i>
                                        {{ $category->topics_count ?? '0' }} тем
                                    </span>
                                    <span class="mr-4 sm:mr-0">
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
                            
                            <div class="flex-shrink-0 mt-4 sm:mt-0 sm:ml-6 w-full sm:w-auto">
                                <a href="{{ route('category.topics', $category->slug) }}" 
                                class="w-full sm:w-auto block text-center px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                                    Перейти
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 sm:py-12 bg-gray-800 rounded-lg">
                        <p class="text-gray-400 mb-4">В этой категории пока нет тем</p>
                        @if (Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator']))
                            <a href="{{ route('category.create') }}" 
                            class="inline-block px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">
                                Создать первую категорию
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection