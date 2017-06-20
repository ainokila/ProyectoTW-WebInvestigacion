
function validarFormulario(e) {
	var err = "";
	if (!validarContrasenias(e.target.pwd2.value))
		err += "Las contraseñas no coinciden.\n";
	if (!validarTelefono(e.target.telefono.value))
		err += "El teléfono es incorrecto\n";
	if (!validarEmail(e.target.email.value))
		err += "El email es incorrecto\n";
	if (err!='') {
		alert(err);
		e.preventDefault(); // IMPORTANTE
		return false;
	} else
		return true;
}

function validarEmail(email) {
	return email.match(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,3}$/);
}

function validarTelefono(tel) {
	return tel.match(/^(\(\+[0-9]{2}\))?\s*[0-9]{3}\s*[0-9]{6}$/);
}

function changeEmail(e) {
	if (!validarEmail(e.target.value))
		alert("Email incorrecto");
}

function changeTelefono(e) {
// this es el target del evento
	if (!validarTelefono(this.value))
		alert("Número de teléfono no válido");
}