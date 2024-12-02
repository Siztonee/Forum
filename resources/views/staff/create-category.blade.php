@extends('layouts.app')

@section('title', 'Создание новой категории')

@section('content')
    <div class="bg-gray-900 min-h-screen py-10">
        <div class="max-w-xl mx-auto bg-gray-800 rounded-lg shadow-xl p-8">
            <h1 class="text-2xl font-bold text-white mb-6 text-center">Создание новой категории</h1>
            
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-6">
                    <label for="name" class="block text-white mb-2">Название категории</label>
                    <input type="text" 
                        name="name" 
                        id="name" 
                        required
                        class="w-full bg-gray-700 border-2 border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="mb-6">
                    <label for="icon" class="block text-white mb-2">Иконка (Font Awesome)</label>
                    <div class="flex items-center">
                        <input type="text" 
                            name="icon" 
                            id="icon" 
                            placeholder="fa-comments"
                            class="flex-grow bg-gray-700 border-2 border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500 mr-4">
                        <div id="icon-preview" class="text-3xl text-blue-400">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                    <small class="text-gray-400 mt-1 block">Используйте код иконки из Font Awesome</small>
                </div>
                
                <div class="mb-6">
                    <label for="color" class="block text-white mb-2">Цвет категории</label>
                    <input type="color" 
                        name="bg_color" 
                        id="color"
                        value="#3B82F6"
                        class="w-full h-12 bg-gray-700 rounded-lg">
                </div>
                
                <div class="mb-6">
                    <label class="block text-white mb-2">Настройки доступа</label>
                    <div class="space-y-2">
                        <label class="flex items-center text-white">
                            <input type="checkbox" 
                                name="access" 
                                value="moderator"
                                class="mr-2 bg-gray-700 text-blue-500 focus:ring-blue-500">
                            Модератор и выше
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Создать категорию
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const iconInput = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        
        iconInput.addEventListener('input', function() {
            const iconClass = this.value.trim();
            iconPreview.innerHTML = `<i class="fas ${iconClass}"></i>`;
        });
    });
    </script>
@endsection