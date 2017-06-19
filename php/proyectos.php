<?php
		session_start();
		include './include/sesion.php';
		include '../plantillas/head-proyecto.html';
		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();
		

?>


	<div class="principal-der">
			<div class="proyecto">
				<ul>


<?php

	$db = BD_conexion();
	$tabla = BD_getProyectos($db);
	BD_desconexion($db);
	
	foreach ((array) $tabla as $valor) {
  
    	$codigo = $valor["codigo"];
    	$titulo = $valor["titulo"];
    	$descripcion = $valor["descripcion"];

    	$db = BD_conexion();
		$publicaciones = BD_getPublicacionConProye($db,$codigo);
		BD_desconexion($db);


echo<<<HTML
    				<li>Código: $codigo</li>
					<li>Título: $titulo</li>
					<li>Descripción: $descripcion</li>
					<li>
						<table border="1">
							<tr>
								<th>Publicaciones</th>
							</tr>
HTML;
		foreach ((array) $publicaciones as $line) {
			$titulo = $line["titulo"];
echo<<<HTML
			<tr>
				<td>$titulo</td>
			</tr>
HTML;

		}

echo<<<HTML
						</table>
					</li>

HTML;

    }


?>

				</ul>
				<p></p>
			</div>
		</div>
	</div>
	

<?php
	include "../plantillas/footer.html";

?>