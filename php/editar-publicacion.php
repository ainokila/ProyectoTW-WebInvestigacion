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
					<p>Proyecto NºXXXX</p>
					
					<div class="informacion">
  
  						<form action="../php/aniadeproyecto.php" method="get">
  							<table border="0">
  				              <tr>
  				                <td>Código</td>
  				                <td><input type="text" name="codigo"></td>
  				              </tr>
  
  				              <tr>
  				                <td>Título</td>
  				                <td><input type="text" name="titulo"></td>
  				              </tr>
  
  				              <tr>
  				                <td>Descripción</td>
  				                <td><input type="large-text" name="descripción"></td>
  				              </tr>
  
  				              <tr>
  				                <td>Comienzo</td>
  				                <td><input type="date" name="comienzo"></td>
  				              </tr>
  
  				              <tr>
  				                <td>Finalización</td>
  				                <td><input type="date" name="finalizacion"></td>
  				              </tr>		
  
  				              <tr>
  				                <td>Entidades Colaboradoras</td>
  				                <td><input type="text" name="entidades"></td>
  				              </tr>
  
  				              <tr>
  				                <td>Cuantía Concedida</td>
  				                <td><input type="number" name="cuantia"></td>
  				              </tr>
  
  
  				              <tr>
  				                <td>Investigador Principal</td>
  				                <td><input type="text" name="investigador"></td>
  				              </tr>
  
  				              <tr>
  				                <td>Investigadores Colaboradores</td>
  				                <td><input type="text" name="investigador-col"></td>
  				              </tr>
  
  				              <tr>
  				                <td>URL</td>
  				                <td><input type="URL" name="url"></td>
  				              </tr>


	            			</table>
            			</form>
					</div>

				</div>
				<div class="clear"></div>	
<?php

	$db = BD_conexion();
	$tabla = BD_getPublicaciones($db);
	BD_desconexion($db);
	
	foreach ((array) $tabla as $valor) {
  
    	$doi = $valor["doi"];
    	$titulo = $valor["titulo"];
    	$autores = $valor["autores"];
    	$fechapub = $valor["DATE_FORMAT(fechapub, '%d/%m/%Y')"];
    	$resumen = $valor["resumen"];
    	$palabras_clave = $valor["palabras_clave"];
    	$url = $valor["url"];
    	$proyecto_vin = $valor["proyecto_vin"];

echo <<< HTML

    		<div class="publicacion">
					<p>Publicación Nº$doi</p>

					<div class="informacion">

							<table border="0">
				              <tr>
				                <td>Título del trabajo</td>
				                <td>$titulo</td>
				              </tr>

				              <tr>
				                <td>Lista de autores</td>
				                <td>$autores</td>
				              </tr>

				              <tr>
				                <td>Fecha de publicación</td>
				                <td>$fechapub</td>
				              </tr>

				              <tr>
				                <td>Resumen del Artículo</td>
				                <td>$resumen</td>
				              </tr>		

				              <tr>
				                <td>Palabras clave</td>
				                <td>$palabras_clave</td>
				              </tr>

				              <tr>
				                <td>URL de Descargar</td>
				                <td>$url</td>
				              </tr>


				              <tr>
				                <td>Proyecto al que esta vinculado</td>
				                <td>$proyecto_vin</td>
				              </tr>

				              	<form action="../php/procesa-publicacion.php" method="get">
	            					<div class="opcion">
					              		<input type="submit" name="actualizar" value="Actualizar">
					              		<input type="submit" name="eliminar" value="Eliminar">
					              	</div>
					              	</div>
	            				</form>

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