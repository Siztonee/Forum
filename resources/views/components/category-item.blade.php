<div class="p-4 flex items-center space-x-4">
    <div class="flex-shrink-0">
        <div class="w-16 h-16 rounded-full flex items-center justify-center" 
             style="background-color: {{ $category->bg_color }}">
            <i class="fas {{ $category->icon ?? '' }} text-3xl text-blue-300"></i>
        </div>
    </div>
    <div class="flex-1">
        <a href="{{ route('category.topics', $category->slug) }}" 
           class="text-lg font-medium text-indigo-300 hover:text-indigo-200">
            {{ $category->name }}
        </a>
        <div class="text-sm text-gray-400 mt-1">
            Тем: {{ $category->topicsCount($category->id) }}
        </div>
        <div class="text-sm text-gray-400 mt-1">
            Создатель: 
            <a href="{{ route('profile', $category->creator->username) }}" 
            class="text-indigo-400">
                {{ $category->creator->username }}
            </a>
        </div>
    </div>
</div>