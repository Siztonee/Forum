@extends('layouts.app')

@section('title', 'Создание новой темы')

@section('content')
    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-gray-900 rounded-lg shadow-xl p-8">
            <h1 class="text-2xl font-bold text-white mb-6 text-center">Создание новой темы</h1>
            
            <form id="message-form" method="POST" action="{{ route('category.topics.store') }}">
                @csrf

                <input type="hidden" name="category_id" value="{{ $category->id }}">
                <input type="hidden" name="category_slug" value="{{ $category->slug }}">

                <div class="mb-4">
                    <label for="topic" class="block text-white mb-2">Заголовок</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="topic" 
                        required 
                        class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500"
                    />
                </div>
                
                <div class="mb-6">
                    <label for="message" class="block text-white mb-2">Сообщение</label>
                    <input type="hidden" name="message" id="hidden-message">
                    <div id="editor" class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-2 text-white" style="height: 300px;"></div>
                </div>
            
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Отправить</button>
            </form>
            

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/quill.js'])
@endpush