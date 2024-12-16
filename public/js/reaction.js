document.addEventListener('DOMContentLoaded', function() {
    function initializeMessageReactions() {
        const messageReactionsBlocks = document.querySelectorAll('.message-reactions');
        
        messageReactionsBlocks.forEach(block => {
            const emojiPickerToggle = block.querySelector('.emoji-picker-toggle');
            const emojiPicker = block.querySelector('.emoji-picker');
            
            emojiPickerToggle.removeEventListener('click', toggleEmojiPicker);
            
            let isEmojiPickerOpen = false;
            
            function toggleEmojiPicker(event) {
                event.stopPropagation();
                isEmojiPickerOpen = !isEmojiPickerOpen;
                emojiPicker.classList.toggle('hidden', !isEmojiPickerOpen);
            }
            
            emojiPickerToggle.addEventListener('click', toggleEmojiPicker);
            
            function closeEmojiPicker(event) {
                if (isEmojiPickerOpen && 
                    !block.contains(event.target)) {
                    isEmojiPickerOpen = false;
                    emojiPicker.classList.add('hidden');
                }
            }
            
            emojiPicker.addEventListener('click', function(event) {
                event.stopPropagation();
            });
            
            document.addEventListener('click', closeEmojiPicker);
            
            const emojiButtons = block.querySelectorAll('.emoji-select');
            emojiButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const emoji = this.textContent;
                    
                    const wireSubmit = button.closest('[wire\\:submit]');
                    if (wireSubmit) {
                        const wireTarget = wireSubmit.getAttribute('wire:submit');
                        Livewire.dispatch(wireTarget, {reaction: emoji});
                    }
                    
                    isEmojiPickerOpen = false;
                    emojiPicker.classList.add('hidden');
                });
            });
        });
    }
    
    initializeMessageReactions();
    
    document.addEventListener('livewire:load', initializeMessageReactions);
    Livewire.on('content-updated', initializeMessageReactions);
});