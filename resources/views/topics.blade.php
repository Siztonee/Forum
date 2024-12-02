 @extends('layouts.app')

 @section('title') {{ $category->name }} @endsection
 
 @section('content')
    <div class="bg-gray-900 min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-gray-800 rounded-lg shadow-xl mb-8">
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center mr-6" 
                            style="background-color: {{ $category->bg_color }}">
                            <i class="fas {{ $category->icon }} text-3xl text-blue-300"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $category->name }}</h1>
                            <p class="text-gray-400">{{ $category->description }}</p>
                        </div>
                    </div>
                    
                    {{-- @if (Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator'])) --}}
                        <a href="{{ route('category.topics.create', $category->slug) }}" 
                            class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Создать тему
                        </a>
                    {{-- @endif --}}
                </div>
            </div>

            <div class="space-y-6">
                @forelse($topics as $topic)
                <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:scale-[1.02]">
                    <div class="p-6 flex items-center">
                        <div class="flex-shrink-0 mr-6">
                            <img src="{{ asset($topic->creator->profile_image) }}" 
                                alt="{{ $topic->creator->username }}" 
                                class="w-12 h-12 rounded-full object-cover">
                        </div>
                        
                        <div class="flex-grow">
                            <div class="flex items-center mb-2">
                                <a href="{{ route('category.topic', [$category->slug, $topic->slug]) }}" 
                                class="text-xl font-semibold text-white hover:text-blue-400 transition-colors">
                                    {{ $topic->name }}
                                </a>
                                @if($topic->is_pinned)
                                <span class="ml-2 px-2 py-1 bg-yellow-600 text-white text-xs rounded">Закреплено</span>
                                @endif
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-400 space-x-4">
                                <span>
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $topic->creator->username }}
                                </span>
                                <span>
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $topic->created_at->diffForHumans() }}
                                </span>
                                <span>
                                    <i class="fas fa-comment mr-1"></i>
                                    {{ $topic->messages_count ?? 0 }} сообщений
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex-shrink-0 ml-6">
                            <div class="flex items-center space-x-2">
                                {{-- @if($topic->last_reply) --}}
                                <img src="{{ asset($topic->lastMessage->sender->profile_image) }}" 
                                    alt="{{ $topic->lastMessage->sender->username }}" 
                                    class="w-8 h-8 rounded-full object-cover">
                                <div class="text-sm text-gray-400">
                                    {{ $topic->lastMessage->created_at->diffForHumans() }}
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-gray-800 rounded-lg">
                    <p class="text-gray-400">В этой категории пока нет тем</p>
                    @if (Auth::check() && in_array(Auth::user()->role, ['admin', 'moderator']))
                        <a href="{{ route('category.topics.create', $category->slug) }}" 
                        class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">
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