@extends('layouts.app')
@section('title', 'Уведомления')
@section('content')
    <div class="w-max mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-gray-900 rounded-2xl shadow-xl p-8 sm:p-6 border border-gray-800">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl sm:text-3xl font-bold text-white">
                    Уведомления
                </h1>
                <span class="text-sm text-gray-400">
                    {{ auth()->user()->notifications->count() }} 
                    {{ trans_choice('уведомление|уведомления|уведомлений', auth()->user()->notifications->count()) }}
                </span>
            </div>

            <!-- Notifications List -->
            <div class="space-y-3 sm:space-y-4">
                @forelse(auth()->user()->notifications as $notification)
                    <div class="group relative bg-gray-800/50 hover:bg-gray-700/50 rounded-xl p-3 sm:p-4 transition-all duration-300 flex items-start sm:items-center gap-3 sm:gap-4">
                        <!-- Unread Indicator -->
                        @if (!$notification->read_at)
                            <div class="absolute top-4 right-4">
                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                            </div>
                        @endif

                        <!-- User Avatar -->
                        <div class="flex-shrink-0">
                            <img 
                                class="h-10 w-10 sm:h-12 sm:w-12 rounded-full object-cover ring-2 ring-gray-700/50" 
                                src="{{ asset($notification->sender->profile_image) }}" 
                                alt="{{ $notification->sender->username }}"
                            >
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="flex items-center gap-2 mb-1 sm:mb-0">
                                    <x-username :user="$notification->sender"/>
                                    <span class="text-xs text-gray-400 px-2 py-1 rounded-full bg-gray-700/50">
                                        {{ $notification['type'] }}
                                    </span>
                                </div>
                                <time class="text-xs text-gray-400">
                                    {{ $notification->created_at->diffForHumans() }}
                                </time>
                            </div>
                            <p class="text-sm text-gray-300 line-clamp-2 sm:line-clamp-1">
                                {{ $notification->message }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-center">
                        <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-lg font-medium text-gray-400">
                            Уведомлений пока нет
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Здесь будут появляться ваши уведомления
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection