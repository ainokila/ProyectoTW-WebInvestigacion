<?php
		session_start();
		include './include/sesion.php';
		include '../plantillas/head-editar-publicacion.html';

		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();


		if(isset($_SESSION["usuario"])){
			$privilegiosActuales = $_SESSION["privilegios"];
			if($privilegiosActuales==2){
				header('Location: ../php/principal.php');
			}
		}else{
			header('Location: ../php/principal.php');
		}
		

?>
<?php
	if (isset($_POST['accion']) && isset($_POST['id'])) {
		switch ($_POST['accion']) {
			case 'Eliminar': // Presentar formulario y pedir confirmación
				$accion = 'Eliminar';							
				$db = BD_conexion();
				BD_borrarPublicacion($db,$_POST['id']);
				BD_desconexion($db);
				header('Location: ../php/editar-publicacion.php');
				break;
			case 'Actualizar':													
				$db = BD_conexion();
				$tabla = BD_getPublicacion($db,$_POST['id']);
				$consulta = $tabla[0];
		    	$doi = $_POST['id'];
		    	$titulo = $consulta["titulo"];
		    	$fechapub = $consulta["fechapub"];
		    	$autores = $consulta["autores"];
		    	$resumen = $consulta["resumen"];
		    	$palabras_clave = $consulta["palabras_clave"];
		    	$url = $consulta["url"];
		    	$proyecto_vin = $consulta["proyecto_vin"];
				echo<<<HTML
				
				<div class="principal-der">
					<div id="publicaciones">
						<p>Contenido</p>
						<p>Listado de publicaciones del grupo</p>

					<div class="publicacion">
 					<p>Publicación NºXXXX</p>
 					
 					<div class="informacion">
 
 						<form action="../php/editar-publicacion.php" method="post">
 							<table border="0">
 				              <tr>
 				                <td>DOI</td>
 				                <td><input type="text" name="doi" value="$doi"></td>
 				              </tr>
 
 				              <tr>
 				                <td>Título del trabajo</td>
 				                <td><input type="text" name="titulo" value="$titulo"></td>
 				              </tr>
 
 				              <tr>
 				                <td>Lista de autores</td>
 				                <td><input type="large-text" name="autores" value="$autores"></td>
 				              </tr>
 
 				              <tr>
 				                <td>Fecha de publicación</td>
 				                <td><input type="date" name="fechapub" value="$fechapub"></td>
 				              </tr>
 
 				              <tr>
 				                <td>Resumen del Artículo</td>
 				                <td><input type="large-text" name="resumen" value="$resumen"></td>
 				              </tr>		
 
 				              <tr>
 				                <td>Palabras clave</td>
 				                <td><input type="text" name="palabras_clave" value="$palabras_clave"></td>
 				              </tr>
 
 				              <tr>
 				                <td>URL de Descargar</td>
 				                <td><input type="URL" name="url" value="$url"></td>
 				              </tr>
 
 
 				              <tr>
 				                <td>Proyecto al que esta vinculado</td>
 				                <td><input type="text" name="proyecto_vin" value="$proyecto_vin"></td>
 				              </tr> 
				              	<form action="../php/editar-publicacion.php" method="post">
	            					<div class="opcion">
	            						<input type='hidden' name='id' value="$doi">
					              		<input type="submit" name="accion" value="Sobreescribir">
					              		<input type="submit" name="accion" value="Cancelar">
					              	</div>
					              	</div>
	            				</form>
 	            			</table>
             			</form>
 					</div>
 
 				</div>
 				<div class="clear"></div>
HTML;
				break;

			case 'Sobreescribir':
				$db = BD_conexion();
				$doi = $_POST['id'];
		    	$titulo = $_POST['titulo'];
		    	$autores = $_POST['autores'];
		    	echo "hola";
		    	echo $_POST['fechapub'];
		    	$fechapub = date('Y-m-d', strtotime($_POST['fechapub']));
		    	$resumen = $_POST['resumen'];
		    	$palabras_clave = $_POST['palabras_clave'];
		    	$url = $_POST['url'];
		    	$proyecto_vin = $_POST['proyecto_vin'];
				BD_updatePublicacion($db,$doi,$titulo,$autores,$fechapub,$resumen,$palabras_clave,$url,$proyecto_vin);
				BD_desconexion($db);
				header('Location: ../php/editar-publicacion.php');
				break;

			case 'Cancelar':
				header('Location: ../php/editar-publicacion.php');
				break;
			
			case 'Crear':
				$db = BD_conexion();
				$doi = $_POST['doi'];
		    	$titulo = $_POST['titulo'];
		    	$autores = $_POST['autores'];
		    	$fechapub = $_POST['fechapub'];
		    	$resumen = $_POST['resumen'];
		    	$palabras_clave = $_POST['palabras_clave'];
		    	$url = $_POST['url'];
		    	$proyecto_vin = $_POST['proyecto_vin'];
				BD_insertPublicacion($db,$doi,$titulo,$autores,$fechapub,$resumen,$palabras_clave,$url,$proyecto_vin);
				BD_desconexion($db);
				header('Location: ../php/editar-publicacion.php');
				break;
		}
	}else{
		echo<<<HTML
		<div class="principal-der">
			<div id="publicaciones">
				<p>Contenido</p>
				<p>Listado de publicaciones del grupo</p>

					<div class="publicacion">
 					<p>Publicación NºXXXX</p>
 					
 					<div class="informacion">
 
 						<form action="../php/editar-publicacion.php" method="post">
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
 				                <td><input type="date" name="fechapub"></td>
 				              </tr>
 
 				              <tr>
 				                <td>Resumen del Artículo</td>
 				                <td><input type="large-text" name="resumen"></td>
 				              </tr>		
 
 				              <tr>
 				                <td>Palabras clave</td>
 				                <td><input type="text" name="palabras_clave"></td>
 				              </tr>
 
 				              <tr>
 				                <td>URL de Descargar</td>
 				                <td><input type="URL" name="url"></td>
 				              </tr>
 
 
 				              <tr>
 				                <td>Proyecto al que esta vinculado</td>
 				                <td><input type="text" name="proyecto_vin"></td>
 				              </tr>
				              	<form action="../php/editar-publicacion.php" method="post">
	            					<div class="opcion">
	            						<input type='hidden' name='id' value="default">
					              		<input type="submit" name="accion" value="Crear">
					              	</div>
					              	</div>
	            				</form>
 
 	            			</table>
             			</form>
 					</div>
 
 				</div>
 				<div class="clear"></div>
HTML;
	}
?>	
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

				              	<form action="../php/editar-publicacion.php" method="post">
	            					<div class="opcion">
	            						<input type='hidden' name='id' value="$doi">
					              		<input type="submit" name="accion" value="Actualizar">
					              		<input type="submit" name="accion" value="Eliminar">
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