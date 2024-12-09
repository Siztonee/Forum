@extends('layouts.app')

@section('title') {{ $category->name .' '. $topic->name }} @endsection

@section('content')
    <div class="bg-gray-900 min-h-screen py-10">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-gray-800 rounded-lg shadow-xl mb-4 p-6">
                 <h1 class="text-white text-xl font-bold">
                    <a href="{{ route('category.topics', $category->slug) }}" class="text-blue-500 focus:ring-blue-500">
                        {{ $category->name }}
                    </a> | {{ $topic->name }}
                </h1>
            </div>
            <!-- Заголовок и мета-информация топика -->
            <div class="bg-gray-800 rounded-lg shadow-xl mb-8 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="{{ asset($topic->creator->profile_image) }}" 
                            alt="{{ $topic->creator->username }}" 
                            class="w-12 h-12 rounded-full mr-4 object-cover">
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $topic->title }}</h1>
                            <div class="text-gray-400 text-sm">
                                {{ $topic->creator->username }} 
                                · {{ $topic->created_at->diffForHumans() }}
                                · {{ $topic->views_count ?? 0 }} просмотров
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Основной контент топика -->
                <div class="prose prose-invert max-w-none text-gray-300">
                    {!! $authorMessage->message !!}
                </div>
                
            </div>
            
            <div class="space-y-6">
                <h2 class="text-xl font-bold text-white mb-4">
                    Ответы ({{ $topic->messages()->count() - 1 ?? 0 }})
                </h2>
                
                @forelse($messages as $message)
                <div id="message-{{ $message->id }}" 
                    class="bg-gray-800 rounded-lg shadow-md p-6 {{ $message->is_author_post ? 'border-l-4 border-blue-500' : '' }}">
                    <div class="flex items-start">
                        <img src="{{ asset($message->sender->profile_image) }}" 
                            alt="{{ $message->sender->username }}" 
                            class="w-10 h-10 rounded-full mr-4 object-cover">
                        
                        <div class="flex-grow">
                            <div class="flex items-center mb-2">
                                <span class="font-semibold text-white mr-2">
                                    {{ $message->sender->username }}
                                </span>
                                <span class="text-gray-400 text-sm ml-2">
                                    {{ $message->created_at->diffForHumans() }}
                                </span>
                            </div>
                            
                            <div class="prose prose-invert max-w-none text-gray-300">
                                {!! $message->message !!}
                            </div>
                            
                            <!-- Действия с комментарием -->
                            <div class="mt-4 flex items-center space-x-4 text-gray-400">
                                <button class="hover:text-white" onclick="replyToMessage({{ $message->id }})">
                                    <i class="fas fa-reply mr-1"></i> Ответить
                                </button>
                                
                                <button class="hover:text-white" onclick="reportMessage({{ $message->id }})">
                                    <i class="fas fa-flag mr-1"></i> Жалоба
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center bg-gray-800 rounded-lg p-8">
                    <p class="text-gray-400">Пока нет комментариев. Будьте первым!</p>
                </div>
                @endforelse
            </div>
            
            <div class="mt-12 bg-gray-800 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Ответить в теме</h3>

                <form action="{{ route('message.send') }}" method="POST" id="message-form">
                    @csrf

                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                    <input type="hidden" name="topic_slug" value="{{ $topic->slug }}">
                    <input type="hidden" name="category_slug" value="{{ $category->slug }}">
                    
                    <div class="mb-6">
                        <label for="message" class="block text-white mb-2">Сообщение</label>
                        <input type="hidden" name="message" id="hidden-message">
                        <div id="editor" class="w-full bg-gray-700 border-2 border-gray-600 rounded-lg px-4 py-2 text-white" style="height: 300px;"></div>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <label class="flex items-center text-white">
                            <a href="/" class="mr-2 text-blue-500 focus:ring-blue-500">
                                Правила сообщений
                            </a>
                        </label>
                        
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Отправить
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/quill.js'])

    <script>
        function replyToMessage(messageId) {
            const commentTextarea = document.querySelector('textarea[name="content"]');
            const comment = document.getElementById(`comment-${messageId}`);
            const authorName = comment.querySelector('.font-semibold').textContent.trim();
            
            commentTextarea.value = `@${authorName} `;
            commentTextarea.focus();
        }
    
        function reportMessage(commentId) {
            // Логика открытия модального окна для жалобы
            alert(`Репорт комментария ${commentId}`);
        }
        </script>
@endpush