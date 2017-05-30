<?php

		session_start();
		include './include/sesion.php';

		include '../plantillas/head-log.html';
		//include "../plantillas/cabecera-menu.html";
		
		generaCabecera();
		generaMenu();


?>


				<div class="principal-der">
			<p>Mostrar log del sistema</p>
		</div>
	</div>

<?php

		include "../plantillas/footer.html";

?>