<div class="bg-gray-900 shadow-md rounded-lg p-4">
    <h2 class="text-lg font-semibold text-gray-100 mb-3">Сейчас онлайн</h2>
    <div class="flex flex-wrap gap-2">
        @forelse ($onlineUsers as $user)
            <a href="{{ route('profile', $user->username) }}" class="inline-flex items-center space-x-2">
                <img class="h-6 w-6 rounded-full" src="{{ $user->profile_image }}" alt="">
                <span class="text-sm text-indigo-400 hover:text-indigo-300">{{ $user->username }}</span>
            </a>
        @empty
            <p>0</p>
        @endforelse
    </div>
</div>