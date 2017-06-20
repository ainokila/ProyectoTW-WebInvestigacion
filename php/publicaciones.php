<?php
		session_start();
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
					<form action="../php/buscar-publicacion.php" method="post">
					<p>Formulario de Búsqueda</p>
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


<?php

	$db = BD_conexion();
	$tabla = BD_getPublicaciones($db);
	BD_desconexion($db);
	
	foreach ((array) $tabla as $valor) {
  
    	$doi = $valor["doi"];
    	$titulo = $valor["titulo"];
    	$autores = $valor["autores"];
    	$fechapub = $valor["DATE_FORMAT(fechapub, '%d/%m/%Y')"];

echo<<<HTML
				<ul>
    				<li>DOI: $doi</li>
					<li>Título: $titulo</li>
					<li>Autor/Autores: $autores</li>
					<li>Fecha Publicación: $fechapub</li>
					<li>
				</ul>

HTML;
		/*foreach ((array) $publicaciones as $line) {
			$titulo = $line["titulo"];
echo<<<HTML
			<tr>
				<td>$titulo</td>
			</tr>
HTML;

		}*/

echo<<<HTML
					</li>


HTML;

    }


?>

				</ul>
			</div>
		</div>
	</div>
	

<?php
	include "../plantillas/footer.html";

?>