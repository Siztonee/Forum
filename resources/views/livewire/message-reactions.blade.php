<div class="message-reactions mt-2">
    <div class="active-reactions flex items-center space-x-2">
        @foreach($reactions as $emoji => $count)
            @if($count > 0)
                <button 
                    class="flex items-center text-gray-400 hover:text-white reaction-item">
                    {{ $emoji }} 
                    <span class="ml-1 text-sm">{{ $count }}</span>
                </button>
            @endif
        @endforeach
        
        <button 
            class="emoji-picker-toggle text-gray-400 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>
    </div>

    <div class="emoji-picker w-full mt-2 hidden">
        <div class="grid grid-cols-12 gap-1">
            @foreach($emojis as $emoji)
                <button 
                    wire:click="addReaction('{{ $emoji }}')"
                    class="emoji-select text-2xl hover:bg-gray-600 rounded p-1 text-center">
                    {{ $emoji }}
                </button>
            @endforeach
        </div>
    </div>
</div>

<script src="{{ asset('js/reaction.js') }}"></script>