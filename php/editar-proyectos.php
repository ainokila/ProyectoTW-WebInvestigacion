<?php
		session_start();
		include './include/sesion.php';
		include '../plantillas/head-editar-proyectos.html';
		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();
		
?>

<?php
	if (isset($_POST['accion']) && isset($_POST['id'])) {
		switch ($_POST['accion']) {
			case 'Eliminar': // Presentar formulario y pedir confirmación
				$accion = 'Eliminar';							
				$db = BD_conexion();
				BD_borrarProyecto($db,$_POST['id']);
				BD_desconexion($db);
				header('Location: ../php/editar-proyectos.php');
				break;
			case 'Actualizar':													
				$db = BD_conexion();
				$tabla = BD_getProyecto($db,$_POST['id']);
				$consulta = $tabla[0];
		    	$codigo = $_POST['id'];
		    	$titulo = $consulta["titulo"];
		    	$descripcion = $consulta["descripcion"];
		    	$comienzo = $consulta["comienzo"];
		    	$fin = $consulta["fin"];
		    	$entidades = $consulta["entidades"];
		    	$cuantia = $consulta["cuantia"];
		    	$inv_principal = $consulta["inv_principal"];
		    	$inv_secundarios = $consulta["inv_secundarios"];
		    	$url = $consulta["url"];
				echo<<<HTML
				<div class="principal-der">
					<div id="proyectos">
						<p>Contenido</p>
						<p>Listado de miembros del grupo</p>
						<div class="proyecto">
							<p>Proyecto NºXXXX</p>
							
							<div class="informacion">
								<form action="../php/editar-proyectos.php" method="post">
									<table border="0">
						              <tr>
						                <td>Código</td>
						                <td><input type="text" name="codigo" value="$codigo"></td>
						              </tr>
						              <tr>
						                <td>Título</td>
						                <td><input type="text" name="titulo" value="$titulo"></td>
						              </tr>
						              <tr>
						                <td>Descripción</td>
						                <td><input type="large-text" name="descripcion"  value="$descripcion"></td>
						              </tr>
						              <tr>
						                <td>Comienzo</td>
						                <td><input type="date" name="comienzo" value="$comienzo"></td>
						              </tr>
						              <tr>
						                <td>Finalización</td>
						                <td><input type="date" name="fin" value="$fin"></td>
						              </tr>		
						              <tr>
						                <td>Entidades Colaboradoras</td>
						                <td><input type="text" name="entidades" value="$entidades"></td>
						              </tr>
						              <tr>
						                <td>Cuantía Concedida</td>
						                <td><input type="number" name="cuantia" value="$cuantia"></td>
						              </tr>
						              <tr>
						                <td>Investigador Principal</td>
						                <td><input type="text" name="inv_principal" value="$inv_principal"></td>
						              </tr>
						              <tr>
						                <td>Investigadores Colaboradores</td>
						                <td><input type="text" name="inv_secundarios" value="$inv_secundarios"></td>
						              </tr>
						              <tr>
						                <td>URL</td>
						                <td><input type="URL" name="url" value="$url"></td>
						              </tr>
					              	<form action="../php/editar-proyectos.php" method="post">
		            					<div class="opcion">
		            						<input type='hidden' name='id' value="$codigo">
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
		    	$codigo = $_POST["codigo"];
		    	$titulo = $_POST["titulo"];
		    	$descripcion = $_POST["descripcion"];
		    	$comienzo = date('Y-m-d', strtotime($_POST['comienzo']));
		    	$fin = date('Y-m-d', strtotime($_POST['fin']));
		    	$entidades = $_POST["entidades"];
		    	$cuantia = $_POST["cuantia"];
		    	$inv_principal = $_POST["inv_principal"];
		    	$inv_secundarios = $_POST["inv_secundarios"];
		    	$url = $_POST["url"];
				BD_updateProyecto($db,$codigo,$titulo,$descripcion,$comienzo,$fin,$entidades,$cuantia,$inv_principal,$inv_secundarios,$url);
				BD_desconexion($db);
				header('Location: ../php/editar-proyectos.php');
				break;
			case 'Cancelar':
				header('Location: ../php/editar-proyectos.php');
				break;
			
			case 'Crear':
				$db = BD_conexion();
		    	$codigo = $_POST['codigo'];
		    	$titulo = $_POST["titulo"];
		    	$descripcion = $_POST["descripcion"];
		    	$comienzo = $_POST['comienzo'];
		    	$fin = $_POST['fin'];
		    	$entidades = $_POST["entidades"];
		    	$cuantia = $_POST["cuantia"];
		    	$inv_principal = $_POST["inv_principal"];
		    	$inv_secundarios = $_POST["inv_secundarios"];
		    	$url = $_POST["url"];
				BD_insertarProyecto($db,$codigo,$titulo,$descripcion,$comienzo,$fin,$entidades,$cuantia,$inv_principal,$inv_secundarios,$url);
				BD_desconexion($db);
				header('Location: ../php/editar-proyectos.php');
				break;
		}
	}else{
		echo<<<HTML
		<div class="principal-der">
			<div id="proyectos">
				<p>Contenido</p>
				<p>Listado de miembros del grupo</p>
				<div class="proyecto">
					<p>Proyecto NºXXXX</p>
					
					<div class="informacion">
						<form action="../php/editar-proyectos.php" method="post">
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
				                <td><input type="large-text" name="descripcion""></td>
				              </tr>
				              <tr>
				                <td>Comienzo</td>
				                <td><input type="date" name="comienzo"></td>
				              </tr>
				              <tr>
				                <td>Finalización</td>
				                <td><input type="date" name="fin"></td>
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
				                <td><input type="text" name="inv_principal"></td>
				              </tr>
				              <tr>
				                <td>Investigadores Colaboradores</td>
				                <td><input type="text" name="inv_secundarios"></td>
				              </tr>
				              <tr>
				                <td>URL</td>
				                <td><input type="URL" name="url"></td>
				              </tr>
				              	<form action="../php/editar-proyectos.php" method="post">
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
	$tabla = BD_getProyectos($db);
	BD_desconexion($db);
	
	foreach ((array) $tabla as $valor) {
    	$codigo = $valor["codigo"];
    	$titulo = $valor["titulo"];
    	$descripcion = $valor["descripcion"];
    	$comienzo = $valor["DATE_FORMAT(comienzo, '%d/%m/%Y')"];
    	$finalizacion = $valor["DATE_FORMAT(fin, '%d/%m/%Y')"];
    	$entidades = $valor["entidades"];
    	$cuantiaeuros = $valor["cuantia"];
    	$investigador = $valor["inv_principal"];
    	$investigadores = $valor["inv_secundarios"];
    	$url = $valor["url"];
echo <<< HTML
				<div class="proyecto">
					<p>Proyecto Nº$codigo</p>
					<div class="informacion">
							<table border="0">
				              <tr>
				                <td>Título</td>
				                <td>$titulo</td>
				              </tr>
				              <tr>
				                <td>Descripción</td>
				                <td>$descripcion</td>
				              </tr>
				              <tr>
				                <td>Comienzo</td>
				                <td>$comienzo</td>
				              </tr>
				              <tr>
				                <td>Finalización</td>
				                <td>$finalizacion</td>
				              </tr>		
				              <tr>
				                <td>Entidades Colaboradoras</td>
				                <td>$entidades</td>
				              </tr>
				              <tr>
				                <td>Cuantía Concedida</td>
				                <td>$cuantiaeuros</td>
				              </tr>
				              <tr>
				                <td>Investigador Principal</td>
				                <td>$investigador</td>
				              </tr>
				              <tr>
				                <td>Investigadores Colaboradores</td>
				                <td>$investigadores</td>
				              </tr>
				              <tr>
				                <td>URL</td>
				                <td>$url</td>
				              </tr>
				              	<form action="../php/editar-proyectos.php" method="post">
	            					<div class="opcion">
	            						<input type='hidden' name='id' value="$codigo">
					              		<input type="submit" name="accion" value="Actualizar">
					              		<input type="submit" name="accion" value="Eliminar">
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