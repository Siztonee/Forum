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
                    reader.onload = () => resolve(reader.result); // Base64 изображение
                    reader.onerror = (error) => reject(error);
                    reader.readAsDataURL(file);
                });
            }
        }
    }
});

// При отправке формы передаём данные редактора
document.querySelector('#message-form').onsubmit = function (e) {
    e.preventDefault();

    const messageContent = quill.root.innerHTML; // Содержимое редактора
    document.querySelector('#hidden-message').value = messageContent;

    this.submit(); // Отправляем форму
};
