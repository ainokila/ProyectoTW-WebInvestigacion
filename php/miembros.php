<?php


		include '../plantillas/head-miembros.html';
		include "../plantillas/cabecera-menu.html";


?>


<div class="principal-der">
			<div id="miembros">
				<p>Contenido</p>
				<p>Listado de mienbros del grupo</p>

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
			                <td>$telefono</td>
			              </tr>

			              <tr>
			                <td>Email</td>
			                <td>$email</td>
			              </tr>

            			</table>

					</div>

				</div>






<?php



		include "../plantillas/footer.html";

?>