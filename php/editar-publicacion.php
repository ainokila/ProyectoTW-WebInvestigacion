<?php
		session_start();
		include './include/sesion.php';
		include '../plantillas/head-editar-publicacion.html';

		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();
		

?>

		<div class="principal-der">
			<div id="publicaciones">
				<p>Contenido</p>
				<p>Listado de publicaciones del grupo</p>

				<div class="publicacion">
					<p>Publicación NºXXXX</p>
					
					<div class="informacion">

						<form action="../php/aniadepublicacion.php" method="get">
							<table border="0">
				              <tr>
				                <td>DOI</td>
				                <td><input type="text" name="doi"></td>
				              </tr>

				              <tr>
				                <td>Título del trabajo</td>
				                <td><input type="text" name="titulo"></td>
				              </tr>

				              <tr>
				                <td>Lista de autores</td>
				                <td><input type="large-text" name="autores"></td>
				              </tr>

				              <tr>
				                <td>Fecha de publicación</td>
				                <td><input type="date" name="fecha-publicacion"></td>
				              </tr>

				              <tr>
				                <td>Resumen del Artículo</td>
				                <td><input type="large-text" name="resumen"></td>
				              </tr>		

				              <tr>
				                <td>Palabras clave</td>
				                <td><input type="text" name="palabras"></td>
				              </tr>

				              <tr>
				                <td>URL de Descargar</td>
				                <td><input type="URL" name="url"></td>
				              </tr>


				              <tr>
				                <td>Proyecto al que esta vinculado</td>
				                <td><input type="text" name="proyecto-vinculado"></td>
				              </tr>

	            			</table>
            			</form>
					</div>

				</div>
				<div class="clear"></div>

				<div class="publicacion">
					<p>Publicación NºXXXX</p>

					<div class="informacion">

							<table border="0">
				              <tr>
				                <td>DOI</td>
				                <td>$DOI</td>
				              </tr>

				              <tr>
				                <td>Título del trabajo</td>
				                <td>$Titulo</td>
				              </tr>

				              <tr>
				                <td>Lista de autores</td>
				                <td>$Autores</td>
				              </tr>

				              <tr>
				                <td>Fecha de publicación</td>
				                <td>$Fecha-Publicacion</td>
				              </tr>

				              <tr>
				                <td>Resumen del Artículo</td>
				                <td>$Resumen</td>
				              </tr>		

				              <tr>
				                <td>Palabras clave</td>
				                <td>$PalabrasClave</td>
				              </tr>

				              <tr>
				                <td>URL de Descargar</td>
				                <td>$URL</td>
				              </tr>


				              <tr>
				                <td>Proyecto al que esta vinculado</td>
				                <td>$Proyecto-vinculado</td>
				              </tr>

				              	<form action="../php/procesa-publicacion.php" method="get">
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