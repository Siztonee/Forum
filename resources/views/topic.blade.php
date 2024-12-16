@extends('layouts.app')

@section('title') {{ $category->name .' '. $topic->name }} @endsection

@section('content')
    <div class="py-10">
        <div class="w-full mx-auto">
            <div class="bg-gray-900 rounded-lg shadow-xl mb-4 p-6">
                 <h1 class="text-white text-xl font-bold">
                    <a href="{{ route('category.topics', $category->slug) }}" class="text-blue-500 focus:ring-blue-500">
                        {{ $category->name }}
                    </a> | {{ $topic->name }}
                </h1>
            </div>
            <!-- Заголовок и мета-информация топика -->
            <div class="bg-gray-900 rounded-lg shadow-xl mb-8 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="{{ asset($topic->creator->profile_image) }}" 
                            alt="{{ $topic->creator->username }}" 
                            class="w-12 h-12 rounded-full mr-4 object-cover">
                        <div>
                            <x-username :user="$topic->creator"/>
                            <div class="text-gray-400 text-sm">
                                {{ $topic->created_at->diffForHumans() }}
                                · {{ $topic->views }} просмотров
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Основной контент топика -->
                <div class="prose prose-invert max-w-none text-gray-300 break-words">
                    {!! $authorMessage->message !!}
                    <livewire:message-reactions :message="$authorMessage"/>
                </div>
                
            </div>
            
            <div class="space-y-2">
                <h2 class="text-xl font-bold text-white mb-4">
                    Ответы ({{ $topic->messagesCount($topic->id) }})
                </h2>
                
                @forelse($messages as $message)
                <div id="message-{{ $message->id }}" 
                    class="bg-gray-900 rounded-lg shadow-md p-6">
                    <div class="flex items-start">
                        <img src="{{ asset($message->sender->profile_image) }}" 
                            alt="{{ $message->sender->username }}" 
                            class="w-10 h-10 rounded-full mr-4 object-cover">
                        
                        <div class="flex-grow">
                            <div class="flex items-center mb-2">
                                <x-username :user="$message->sender"/>
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

                            <livewire:message-reactions :message="$message" />

                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center bg-gray-900 rounded-lg p-8">
                    <p class="text-gray-400">Ответов пока нет. Будьте первым!</p>
                </div>
                @endforelse
            </div>
            
            <div class="mt-12 bg-gray-900 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-white mb-4">Ответить в теме</h3>

                @if (Auth::check())
                    <form action="{{ route('message.send') }}" method="POST" id="message-form">
                        @csrf

                        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                        <input type="hidden" name="topic_slug" value="{{ $topic->slug }}">
                        <input type="hidden" name="category_slug" value="{{ $category->slug }}">
                        
                        <div class="mb-6">
                            <label for="message" class="block text-white mb-2">Сообщение</label>
                            <input type="hidden" name="message" id="hidden-message">
                            <div id="editor" class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-2 text-white" style="height: 300px;"></div>
                        </div>

                        <div class="flex justify-between items-center mt-4">
                            <label class="flex items-center text-white">
                                <a href="#" class="mr-2 text-blue-500 focus:ring-blue-500">
                                    Правила сообщений
                                </a>
                            </label>
                            
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Отправить
                            </button>
                        </div>
                    </form>

                    @push('scripts')
                        @vite(['resources/js/quill.js'])

                        <script>
                            function replyToMessage(messageId) {
                                const commentTextarea = document.querySelector('#editor');
                                const message = document.getElementById(`message-${messageId}`);
                                const authorName = message.querySelector('.font-semibold').textContent.trim();
                                
                                commentTextarea.value = `@${authorName} `;
                                commentTextarea.focus();
                            }
                        
                            function reportMessage(commentId) {
                                // Логика открытия модального окна для жалобы
                                alert(`Репорт комментария ${commentId}`);
                            }
                            </script>

                    @endpush

                @else
                    <p class="text-white"><a href="{{ route('auth')}}" class="text-blue-500">Войдите</a> чтобы отправить сообщение.</p>
                @endif
                

            </div>
        </div>
    </div>
@endsection

