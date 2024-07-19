// Recorrer los elementos y hacer que onchange ejecute una funcion para comprobar el valor de ese input
(function() {

	let formulario = document.formulario_registro,
			elementos = formulario.elements;

	// Funciones
	// Función que se ejecuta cuando el evento click es activado
	let validarInputs = function() {
		for (let i = 0; i < elementos.length; i++) {
			// Identificamos si el elemento es de tipo texto, email, password, radio o checkbox
			if (elementos[i].type == 'text' || elementos[i].type == 'email' || elementos[i].type == 'password') {
				// Si es tipo texto, email o password vamos a comprobar que esten completados los input
				if (elementos[i].value == 0) {
					console.log('El campo ' + elementos[i].name + ' esta incompleto');
					elementos[i].className = elementos[i].className + ' error';
					return false;
				} else {
						elementos[i].className = elementos[i].className.replace(' error', '');
					}
			}
		}

		// Comprobando que las contraseñas coincidan
		if (elementos.pass.value !== elementos.pass2.value) {
			elementos.pass.value = '';
			elementos.pass2.value = '';
			elementos.pass.className = elementos.pass.className + ' error';
			elementos.pass2.className = elementos.pass2.className + ' error';
		} else {
				elementos.pass.className = elementos.pass.className.replace(' error', '');
				elementos.pass2.className = elementos.pass2.className.replace(' error', '');
			}

    return true;
	};

	let validarRadios = function() {
		let opciones = document.getElementsByName('sexo'),
				resultado = false;

		for (let i = 0; i < elementos.length; i++) {
			if (elementos[i].type == 'radio' && elementos[i].name == 'sexo') {
				// Recorremos los radio button
				for (let o = 0; o < opciones.length; o++) {
					if (opciones[o].checked) {
						resultado = true;
						break;
					}
				}

				if (resultado == false) {
					elementos[i].parentNode.className = elementos[i].parentNode.className + ' error';
					console.log('El campo sexo esta incorrecto');
					return false;
				} else {
						// Eliminamos la clase error del radio button
						elementos[i].parentNode.className = elementos[i].parentNode.className.replace(' error', '');
						return true;
					}

			}
		}

	};

	let validarCheckbox = function() {
		let opciones = document.getElementsByName('terminos'),
				resultado = false;

		for (let i = 0; i < elementos.length; i++) {
			if (elementos[i].type == 'checkbox') {
				for (let o = 0; o < opciones.length; o++) {
					if (opciones[o].checked) {
						resultado = true;
						break;
					}
				}

				if (resultado == false) {
					elementos[i].parentNode.className = elementos[i].parentNode.className + ' error';
					console.log('Por favor compruebe los terminos');
					return false;
				} else {
						// Eliminamos la clase error de los checkbox
						elementos[i].parentNode.className = elementos[i].parentNode.className.replace(' error', '');
						return true;
					}

			}
		}
	};

	let enviar = function(e) {
		if (!validarInputs()) {
			console.log('Falto validar los inputs');
			e.preventDefault();
		}
		else if (!validarRadios()) {
			console.log('Falto validar los radios');
			e.preventDefault();
		}
		else if (!validarCheckbox()) {
			console.log('Falto validar los checkbox');
			e.preventDefault();
		}
		else {
			console.log('Envia los datos correctamente');
		}
	};

	// Funciones blur y focus
	let focusInput = function () {
		this.parentElement.children[1].className = 'label active';
		this.parentElement.children[0].className = this.parentElement.children[0].className.replace('error', '') ;
	};

	let blurInput = function () {
		if (this.value <= 0) {
			this.parentElement.children[1].className = 'label';
			this.parentElement.children[0].className = this.parentElement.children[0].className + ' error';
		}
	};

	// Eventos
	formulario.addEventListener('submit', enviar);

	for (let i = 0; i < elementos.length; i++) {
		if (elementos[i].type == 'text' || elementos[i].type == 'email' || elementos[i].type == 'password') {
			elementos[i].addEventListener('focus', focusInput);
			elementos[i].addEventListener('blur', blurInput);
		}
	}


}());