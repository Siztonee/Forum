<div class="p-4 hover:bg-gray-800 transition border-t border-gray-800">
    <div class="flex items-start space-x-4">
        <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full object-cover" 
                 src="{{ $topic->creator->profile_image }}" 
                 alt="{{ $topic->creator->username }}">
        </div>
        <div class="flex-1 min-w-0">
            <a href="{{ route('category.topic', [$topic->category->slug, $topic->slug]) }}" 
               class="text-base font-medium text-indigo-300 hover:text-indigo-300">
                {{ $topic->name }}
            </a>
            <div class="mt-1 flex items-center space-x-2 text-sm text-gray-500">
                <span>
                    <a href="{{ route('profile', $topic->creator->username) }}" 
                       class="text-indigo-400 hover:text-indigo-300">
                        <x-username :user="$topic->creator"/>
                    </a>
                </span>
                <span>•</span>
                <span>{{ $topic->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span>{{ $topic->messagesCount($topic->id) }} ответов</span>
            </div>
        </div>
    </div>
</div>