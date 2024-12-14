@extends('layouts.app')

@section('title', 'Настройки категории')

@section('content')
    <div class="py-10">
        <div class="max-w-xl mx-auto bg-gray-900 rounded-lg shadow-xl p-8">
            <h1 class="text-2xl font-bold text-white mb-6 text-center">Настройки категории</h1>
            <form action="{{ route('category.settings.store', $category->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="name" class="block text-white mb-2">Название категории</label>
                    <input type="text"
                        name="name"
                        id="name"
                        value="{{ $category->name }}"
                        required
                        class="w-full bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="mb-6">
                    <label for="icon" class="block text-white mb-2">Иконка (Font Awesome)</label>
                    <div class="flex items-center">
                        <input type="text"
                            name="icon"
                            id="icon"
                            value="{{ $category->icon }}"
                            placeholder="fa-comments"
                            class="flex-grow bg-gray-800 border-2 border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500 mr-4">
                        <div id="icon-preview" class="text-3xl text-blue-400">
                            <i class="fas {{ $category->icon }}"></i>
                        </div>
                    </div>
                    <small class="text-gray-400 mt-1 block">Используйте код иконки из Font Awesome</small>
                </div>
                
                <div class="mb-6">
                    <label for="color" class="block text-white mb-2">Цвет категории</label>
                    <input type="color"
                        name="bg_color"
                        id="color"
                        value="{{ $category->bg_color }}"
                        class="w-full h-12 bg-gray-800 rounded-lg">
                </div>
                
                <div class="mb-6">
                    <label class="block text-white mb-2">Настройки доступа</label>
                    <div class="space-y-2">
                        <label class="flex items-center text-white">
                            <input type="radio"
                                name="access"
                                id="access"
                                value="user"
                                {{ $category->access == 'user' ? 'checked' : '' }}
                                class="mr-2 bg-gray-800 text-blue-500 focus:ring-blue-500">
                            Открытый
                        </label>
                        <label class="flex items-center text-white">
                            <input type="radio"
                                name="access"
                                id="access"
                                value="moderator"
                                {{ $category->access == 'moderator' ? 'checked' : '' }}
                                class="mr-2 bg-gray-800 text-blue-500 focus:ring-blue-500">
                            Модератор и выше
                        </label>
                        <label class="flex items-center text-white">
                            <input type="radio"
                                name="access"
                                id="access"
                                value="admin"
                                {{ $category->access == 'admin' ? 'checked' : '' }}
                                class="mr-2 bg-gray-800 text-blue-500 focus:ring-blue-500">
                            Только администраторство
                        </label>
                    </div>
                </div>
                
                <div class="flex flex-col space-y-4 ">
                    <div class="flex flex-col space-y-2">
                        <button type="button" 
                                onclick="openDeleteThemesModal()"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors w-full sm:w-auto">
                            Удалить все темы
                        </button>
                        <button type="button" 
                                onclick="openDeleteCategoryModal()"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-900 transition-colors w-full sm:w-auto">
                            Удалить категорию
                        </button>
                    </div>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors w-full sm:w-auto">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Модальное окно подтверждения удаления тем -->
    <div id="deleteThemesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 max-w-sm w-full">
            <h2 class="text-xl text-white mb-4">Подтвердите удаление</h2>
            <p class="text-gray-300 mb-6">Вы уверены, что хотите удалить все темы в этой категории?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteThemesModal()" 
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Отмена
                </button>
                <form action="{{ route('category.clear', $category->slug) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Модальное окно подтверждения удаления категории -->
    <div id="deleteCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 max-w-sm w-full">
            <h2 class="text-xl text-white mb-4">Подтвердите удаление</h2>
            <p class="text-gray-300 mb-6">Вы уверены, что хотите удалить эту категорию?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeDeleteCategoryModal()" 
                        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Отмена
                </button>
                <form action="{{ route('category.delete', $category->slug) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iconInput = document.getElementById('icon');
            const iconPreview = document.getElementById('icon-preview');
            
            iconInput.addEventListener('input', function() {
                const iconClass = this.value.trim();
                iconPreview.innerHTML = `<i class="fas ${iconClass}"></i>`;
            });
        });

        function openDeleteThemesModal() {
            document.getElementById('deleteThemesModal').classList.remove('hidden');
            document.getElementById('deleteThemesModal').classList.add('flex');
        }

        function closeDeleteThemesModal() {
            document.getElementById('deleteThemesModal').classList.add('hidden');
            document.getElementById('deleteThemesModal').classList.remove('flex');
        }

        function openDeleteCategoryModal() {
            document.getElementById('deleteCategoryModal').classList.remove('hidden');
            document.getElementById('deleteCategoryModal').classList.add('flex');
        }

        function closeDeleteCategoryModal() {
            document.getElementById('deleteCategoryModal').classList.add('hidden');
            document.getElementById('deleteCategoryModal').classList.remove('flex');
        }
    </script>
@endpush