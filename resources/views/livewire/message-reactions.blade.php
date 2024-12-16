<div class="message-reactions mt-2 flex items-center space-x-2">
    @php
        $emojis = ['❤️', '👍', '😂', '😮', '😢', '🔥'];
    @endphp

    @foreach($emojis as $emoji)
    <button 
        wire:click="addReaction('{{ $emoji }}')"
        class="flex items-center text-gray-400 hover:text-white">
        {{ $emoji }} 
        @if(isset($reactions[$emoji]))
            <span class="ml-1 text-sm">
                {{ $reactions[$emoji] }}
            </span>
        @endif
    </button>
    @endforeach
</div>