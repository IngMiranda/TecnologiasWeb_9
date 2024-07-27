function showNotification(message, type) {
    var notification = document.getElementById('notification');
    var notificationTitle = document.getElementById('notification-title');
    var notificationMessage = document.getElementById('notification-message');
    var notificationClose = document.getElementById('notification-close');
    var notificationAccept = document.getElementById('notification-accept');
    
    // Establece el mensaje
    notificationMessage.textContent = message;
    
    // Establece el título y el tipo de notificación
    if (type === 'error') {
        notificationTitle.textContent = 'Error'; // Título para errores
        notification.classList.add('error');
        notification.classList.remove('success');
        notificationClose.style.display = 'none'; // Oculta el botón de cierre
    } else if (type === 'success') {
        notificationTitle.textContent = 'Notificación'; // Título para éxito
        notification.classList.add('success');
        notification.classList.remove('error');
        notificationClose.style.display = 'none'; // Asegura que el botón de cierre esté oculto
    }

    notification.style.display = 'block';
}

function hideNotification() {
    document.getElementById('notification').style.display = 'none';
}

function checkForm() {
    var matricula = document.getElementById('matricula').value;
    var expectedMatricula = '221160024';
    var matriculaPattern = /^[0-9]+$/;

    if (!matricula) {
        showNotification('Campo vacío.', 'error'); // Mensaje para campo vacío
        return false; // Previene el envío del formulario
    }

    if (!matriculaPattern.test(matricula)) {
        showNotification('Formato inválido.', 'error'); // Mensaje para formato inválido
        return false; // Previene el envío del formulario
    }

    if (matricula !== expectedMatricula) {
        showNotification('Usuario no registrado.', 'error'); // Mensaje para usuario no registrado
        return false; // Previene el envío del formulario
    }

    showNotification('Se ha enviado el correo de recuperación.', 'success'); // Mensaje de éxito
    return false; // Previene el envío del formulario
}