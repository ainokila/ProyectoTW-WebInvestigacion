<?php
		include './include/sesion.php';
		include '../plantillas/head-publicaciones.html';

		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();
		

?>
		<div class="principal-der">
			<div class="publicaciones">
				<p>Listado de Publicaciones</p>
				<ul>
					<form action="../php/buscar-publicacion.php" method="get">
					<p>Formulario de Búsqueda</p>
						<li>Por tipo:				                
		                	<select>
		                		<option selected value="vacia"></option>
		                		<option value="publicacion1">Publicación 1</option>
		                		<option value="publicacion2">Publicación 2</option>
		                		<option value="publicacion3">Publicación 3</option>
		                		<option value="publicacion4">Publicación 4</option>
		                	</select>
					    </li>
						<li>Por autor
							<input type="text" name="autor">
						<li>
						<li>Por fecha
							<input type="date" name="fecha">
						</li>
						<li>Por palabras clave
							<input type="text" name="autor">
						</li>
						<li>
							<input type="submit" name="buscar">
						</li>
					</form>
				</ul>
				<table border="1">
					<tr>
						<th>Publicaciones</th>
					</tr>
					<tr>
						<td>-<a href="../php/log.php">Referencia a Publicación 1</a></td>
					</tr>
					<tr>
						<td>-<a href="../php/log.php">Referencia a Publicación 2</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
	<div class="clear"></div>	
<?php
	include "../plantillas/footer.html";

?>