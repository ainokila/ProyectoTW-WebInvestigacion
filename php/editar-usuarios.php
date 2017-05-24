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

						<form action="../php/aniadeMiembro.php" method="get">
							<table border="0">
				              <tr>
				                <td>Nombre</td>
				                <td><input type="text" name="nombre"></td>
				              </tr>
				             <tr>
				                <td>Categoría</td>
				                <td>
				                	<select>
				                		<option value="catedratico">Catedratico</option>
				                		<option value="titular">Titular</option>
				                		<option value="investigador">Investigador</option>
				                		<option value="invitado">Invitado</option>
				                	</select>
				                </td>
				              </tr>
				              
				              <tr>
				                <td>Dirección</td>
				                <td><input type="text" name="direccion"></td>
				              </tr>
				             <tr>
				                <td>Telefono</td>
				                <td><input type="tel" name="telefono"></td>
				              </tr>

				              <tr>
				                <td>Email</td>
				                <td><input type="email" name="email"></td>
				              </tr>

				              <div class="opcion">
				              		<input type="submit" value="Añadir">
				              </div>

	            			</table>
            			</form>
					</div>

				</div>
				<div class="clear"></div>

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

			              	<form action="../php/procesa-usuario.php" method="get">
            					<div class="opcion">
				              		<input type="submit" name="actualizar" value="Actualizar">
				              		<input type="submit" name="eliminar" value="Eliminar">
				              	</div>
            				</form>

            			</table>



					</div>

				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
<?php
	include "../plantillas/footer.html";

?>