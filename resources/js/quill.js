import Quill from 'quill';
import ImageUploader from 'quill-image-uploader';

Quill.register('modules/imageUploader', ImageUploader);

const quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['link', 'image']
        ],
        imageUploader: {
            upload: (file) => {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = () => resolve(reader.result); 
                    reader.onerror = (error) => reject(error);
                    reader.readAsDataURL(file);
                });
            }
        }
    }
});

window.replyToMessage = function(messageId) {
    const message = document.getElementById(`message-${messageId}`);
    
    const usernameSelectors = [
        'x-username',
        '.font-semibold',
        '[data-username]',
        '.username'
    ];
    
    let authorName = null;
    let authorId = null;

    for (let selector of usernameSelectors) {
        const element = message.querySelector(selector);
        if (element) {
            authorName = element.textContent.trim();
            authorId = element.getAttribute('data-user-id');
            break;
        }
    }

    if (authorName) {
        const oldReceiverInput = document.querySelector('input[name="receiver_username"]');
        if (oldReceiverInput) {
            oldReceiverInput.remove();
        }

        const receiverInput = document.createElement('input');
        receiverInput.type = 'hidden';
        receiverInput.name = 'receiver_username';
        receiverInput.value = authorName;
        
        if (authorId) {
            const receiverIdInput = document.createElement('input');
            receiverIdInput.type = 'hidden';
            receiverIdInput.name = 'receiver_id';
            receiverIdInput.value = authorId;
            document.getElementById('message-form').appendChild(receiverIdInput);
        }

        document.getElementById('message-form').appendChild(receiverInput);

        quill.setText('');
        quill.insertText(0, `@${authorName}, `);
        
        const length = quill.getLength();
        quill.setSelection(length - 1, 0);
        
        quill.focus();
    } else {
        console.error('Не удалось найти имя автора. Проверьте разметку.');
    }
};

document.querySelector('#message-form').onsubmit = function (e) {
    e.preventDefault();
    const messageContent = quill.root.innerHTML; 
    document.querySelector('#hidden-message').value = messageContent;
    this.submit(); 
};