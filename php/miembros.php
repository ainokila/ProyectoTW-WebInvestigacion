<?php
		session_start();

		include './include/sesion.php';

		include '../plantillas/head-miembros.html';
		//include "../plantillas/cabecera-menu.html";
		
		generaCabecera();
		generaMenu();


?>

		<div class="principal-der">
			<div id="miembros">
				<p>Contenido</p>
				<p>Listado de miembros del grupo</p>

<?php

	$db = BD_conexion();
	$tabla = BD_getMiembros($db);
	BD_desconexion($db);
	
	foreach ($tabla as $valor) {
    	$nombre = $valor["nombre"];
    	$categoria = $valor["categoria"];
    	$direccion = $valor["direccion"];
    	$tel = $valor["tel"];
    	$email = $valor["email"];

echo <<< HTML
    					<div class="miembro">
					<div class="foto">
						<img src="../img/perfil.jpg">
					</div>

					<div class="informacion">

						<table border="0">
			              <tr>
			                <td>Nombre</td>
			                <td>$nombre</td>
			              </tr>
			             <tr>
			                <td>Categoría</td>
			                <td>$categoria</td>
			              </tr>
			              
			              <tr>
			                <td>Dirección</td>
			                <td>$direccion</td>
			              </tr>
			             <tr>
			                <td>Telefono</td>
			                <td>$tel</td>
			              </tr>

			              <tr>
			                <td>Email</td>
			                <td>$email</td>
			              </tr>

            			</table>

					</div>

				</div>
				<div class="clear"></div>

HTML;

	}


?>





				
			</div>
		</div>
	</div>






<?php



		include "../plantillas/footer.html";

?>