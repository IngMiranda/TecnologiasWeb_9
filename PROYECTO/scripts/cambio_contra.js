function showNotification(message, type) {
    var notification = document.getElementById('notification');
    var title = type === 'success' ? 'Notificación' : 'Error';
    var backgroundColor = type === 'success' ? '#070546' : '#8b0c0c';
    var buttonColor = type === 'success' ? '#8b0c0c' : '#070546';
    
    document.getElementById('notification-message').textContent = message;
    notification.style.backgroundColor = backgroundColor;
    notification.querySelector('.title').textContent = title;
    notification.querySelector('.button').style.backgroundColor = buttonColor;
    notification.style.display = 'block';
}

function hideNotification() {
    document.getElementById('notification').style.display = 'none';
}

function validateForm() {
    var nuevaPassword = document.getElementById('nueva-password').value;
    var confirmarPassword = document.getElementById('confirmar-password').value;
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    if (!nuevaPassword || !confirmarPassword) {
        showNotification('No pueden quedar campos vacíos.', 'error');
        return false; // Previene el envío del formulario
    }

    if (nuevaPassword !== confirmarPassword) {
        showNotification('Las contraseñas no coinciden.', 'error');
        return false; // Previene el envío del formulario
    }

    if (!passwordPattern.test(nuevaPassword)) {
        showNotification('Formato inválido.', 'error');
        return false; // Previene el envío del formulario
    }

    showNotification('Se ha cambiado con exito la contraseña.', 'success');
    setTimeout(function() {
        window.location.href = 'index.html'; // Redirige a la página de inicio después de 3 segundos
    }, 4000); // Ajusta el tiempo si es necesario
    return false; // Previene el envío del formulario
}