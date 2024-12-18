@extends('layouts.app')

@section('content')
<div class="text-white p-4 md:p-8">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-gray-900 rounded-xl shadow-2xl p-6 mb-8 relative overflow-hidden">
            
            <h1 class="text-3xl font-bold mb-6 relative z-10 text-white">
                Уведомления
                <span class="text-sm text-gray-400 ml-4">3 новых</span>
            </h1>

            <div class="space-y-4">
                @foreach([
                    ['type' => 'message', 'user' => 'Иван Петров', 'text' => 'Прокомментировал вашу тему'],
                    ['type' => 'like', 'user' => 'Анна Смирнова', 'text' => 'Понравился ваш пост'],
                    ['type' => 'mention', 'user' => 'Администратор', 'text' => 'Упомянул вас в обсуждении']
                ] as $notification)
                    <div class="bg-gray-800 rounded-lg p-4 flex items-center space-x-4 hover:bg-gray-700 transition-all duration-300 relative group">                        
                        <div class="relative z-10">
                            <img class="h-8 w-8 sm:h-10 sm:w-10 rounded-full object-cover mr-3 sm:mr-0" 
                                src="{{ asset(auth()->user()->profile_image) }}" alt="{{ auth()->user()->username }}">
                        </div>

                        <div class="flex-1 relative z-10">
                            <p class="font-semibold text-white">{{ $notification['user'] }}</p>
                            <p class="text-gray-400 text-sm">{{ $notification['text'] }}</p>
                        </div>

                        <span class="text-xs text-gray-500 relative z-10">5 минут назад</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection