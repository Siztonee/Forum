document.addEventListener('DOMContentLoaded', () => {
    let container = document.querySelector('.notification-container');
    if (!container) {
      container = document.createElement('div');
      container.className = 'notification-container';
      document.body.appendChild(container);
    }
  
    function showNotification(message) {
      const notification = document.createElement('div');
      notification.className = 'notification';
      
      const messageEl = document.createElement('div');
      messageEl.className = 'notification-message';
      messageEl.textContent = message;
      
      const closeButton = document.createElement('button');
      closeButton.className = 'notification-close';
      closeButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      `;
      
      notification.appendChild(messageEl);
      notification.appendChild(closeButton);
      container.appendChild(notification);
      
      requestAnimationFrame(() => {
        notification.classList.add('show');
      });
  
      const removeNotification = () => {
        notification.classList.remove('show');
        setTimeout(() => {
          notification.remove();
        }, 300); 
      };
  
      closeButton.addEventListener('click', removeNotification);
  
      // Auto remove after 5 seconds
      setTimeout(removeNotification, 5000);
    }
  
    const notificationElement = document.getElementById('notification');
    if (notificationElement) {
      const message = notificationElement.getAttribute('data-message');
      if (message) {
        showNotification(message);
      }
    }
  
    window.showNotification = showNotification;
  });