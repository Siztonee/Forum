<div class="p-3 sm:p-4 hover:bg-gray-800 transition border-t border-gray-800">
    <div class="flex flex-col sm:flex-row items-start space-y-2 sm:space-y-0 sm:space-x-4">
        <div class="flex items-center w-full sm:w-auto">
            <img class="h-8 w-8 sm:h-10 sm:w-10 rounded-full object-cover mr-3 sm:mr-0" 
                 src="{{ $topic->creator->profile_image }}"
                 alt="{{ $topic->creator->username }}">
            <div class="sm:hidden flex-1 min-w-0">
                <a href="{{ route('category.topic', [$topic->category->slug, $topic->slug]) }}"
                   class="text-sm font-medium text-indigo-300 hover:text-indigo-300 truncate block">
                    {{ $topic->name }}
                </a>
            </div>
        </div>
        
        <div class="flex-1 min-w-0 w-full">
            <div class="hidden sm:block">
                <a href="{{ route('category.topic', [$topic->category->slug, $topic->slug]) }}"
                   class="text-base font-medium text-indigo-300 hover:text-indigo-300">
                    {{ $topic->name }}
                </a>
            </div>
            
            <div class="mt-1 flex flex-wrap items-center space-x-1 sm:space-x-2 text-xs sm:text-sm text-gray-500">
                <x-username :user="$topic->creator"/>
                <span class="text-gray-600">•</span>
                <span class="truncate">{{ $topic->created_at->diffForHumans() }}</span>
                <span class="text-gray-600">•</span>
                <span class="truncate">{{ $topic->messagesCount($topic->id) }} ответов</span>
            </div>
        </div>
    </div>
</div>