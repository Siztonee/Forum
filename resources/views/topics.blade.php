@extends('layouts.app')

@section('title') {{ $category->name }} @endsection
 
@section('content')
    <div class="py-6 sm:py-10">
        <div class="max-w-full sm:max-w-xl md:max-w-2xl lg:max-w-4xl mx-auto px-4 sm:px-6 lg:px-4">
            <div class="bg-gray-900 rounded-lg shadow-xl mb-6 sm:mb-8">
                <div class="p-4 sm:p-6 flex flex-col sm:flex-row items-center justify-between">
                    <div class="flex flex-col sm:flex-row items-center mb-4 sm:mb-0">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center sm:mr-6 mb-3 sm:mb-0" 
                            style="background-color: {{ $category->bg_color }}">
                            <i class="fas {{ $category->icon }} text-2xl sm:text-3xl text-blue-300"></i>
                        </div>
                        <div class="text-center sm:text-left">
                            <h1 class="text-xl sm:text-2xl font-bold text-white mb-1">{{ $category->name }}</h1>
                            <p class="text-sm sm:text-base text-gray-400">{{ $category->description }}</p>
                        </div>
                    </div>
                    
                    @if (Auth::check())
                        <a href="{{ route('category.topics.create', $category->slug) }}" 
                            class="w-full sm:w-auto text-center px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors mt-3 sm:mt-0">
                            <i class="fas fa-plus mr-2"></i>Создать тему
                        </a>
                    @endif
                </div>
            </div>

            <div class="space-y-4 sm:space-y-6">
                @forelse($topics as $topic)
                <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:scale-[1.02]">
                    <div class="p-4 sm:p-6 flex flex-col sm:flex-row items-center">
                        <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-6 flex justify-center w-full sm:w-auto">
                            <img src="{{ asset($topic->creator->profile_image) }}" 
                                alt="{{ $topic->creator->username }}" 
                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover">
                        </div>
                        
                        <div class="flex-grow text-center sm:text-left w-full">
                            <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start mb-2">
                                <a href="{{ route('category.topic', [$category->slug, $topic->slug]) }}" 
                                class="text-lg sm:text-xl font-semibold text-white hover:text-blue-400 transition-colors mb-2 sm:mb-0 sm:mr-3">
                                    {{ $topic->name }}
                                </a>
                                @if($topic->is_pinned)
                                    <span class="px-2 py-1 bg-yellow-600 text-white text-xs rounded">Закреплено</span>
                                @endif
                            </div>
                            
                            <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-start text-xs sm:text-sm text-gray-400 space-y-2 sm:space-y-0 sm:space-x-4">
                                <span class="mr-4 sm:mr-0">
                                    <i class="fas fa-user mr-1"></i>
                                    <x-username :user="$topic->creator"/>
                                </span>
                                <span class="mr-4 sm:mr-0">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $topic->created_at->diffForHumans() }}
                                </span>
                                <span>
                                    <i class="fas fa-comment mr-1"></i>
                                    {{ $topic->messages_count - 1 }} ответов
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex-shrink-0 mt-4 sm:mt-0 sm:ml-6 flex items-center justify-center w-full sm:w-auto">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset($topic->lastMessage->sender->profile_image) }}" 
                                    alt="{{ $topic->lastMessage->sender->username }}" 
                                    class="w-6 h-6 sm:w-8 sm:h-8 rounded-full object-cover">
                                <div class="text-xs sm:text-sm text-gray-400">
                                    {{ $topic->lastMessage->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 sm:py-12 bg-gray-800 rounded-lg">
                    <p class="text-gray-400 mb-4">В этой категории пока нет тем</p>
                    @if (Auth::check())
                        <a href="{{ route('category.topics.create', $category->slug) }}" 
                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">
                            Создать первую тему
                        </a>
                    @endif
                </div>
                @endforelse
            </div>

            <!-- Пагинация -->
            {{-- <div class="mt-8">
                {{ $topics->links('vendor.pagination.tailwind') }}
            </div> --}}
        </div>
    </div>
@endsection