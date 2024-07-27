function showNotification(message) {
    var notification = document.getElementById('notification');
    document.getElementById('notification-message').textContent = message;
    notification.style.display = 'block';
}

function hideNotification() {
    document.getElementById('notification').style.display = 'none';
}

function checkForm() {
    var matricula = document.getElementById('matricula').value;
    var password = document.getElementById('password').value;
    var matriculaPattern = /^[0-9]+$/;
    var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!matricula && !password) {
        showNotification('Campo vacío.');
        return false;
    }

    if (!matricula) {
        showNotification('Campo vacío en matrícula.');
        return false;
    }

    if (!password) {
        showNotification('Campo vacío en contraseña.');
        return false;
    }

    if (!matriculaPattern.test(matricula)) {
        showNotification('Formato inválido en matrícula.');
        return false;
    }

    if (!passwordPattern.test(password)) {
        showNotification('Formato inválido en contraseña.');
        return false;
    }

    if (matricula !== '221160024' || password !== 'P@sw0rd1') {
        showNotification('Matrícula y/o Contraseña no coinciden.');
        return false;
    }

    window.location.href = 'alumnos.html';
    return true;
}