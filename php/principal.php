<?php
		session_start();
		include './include/sesion.php';


		include '../plantillas/head-principal.html';
		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();
		include "../plantillas/principal.html";
		include "../plantillas/footer.html";

?>