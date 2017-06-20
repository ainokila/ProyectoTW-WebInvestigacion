<?php
		session_start();
		include './include/sesion.php';
		include '../plantillas/head-miembros.html';
	
		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();

		if(isset($_SESSION["usuario"])){
			$privilegiosActuales = $_SESSION["privilegios"];
			if($privilegiosActuales==2 || $privilegiosActuales==1){
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
				BD_borrarMiembro($db,$_POST['id']);
				BD_desconexion($db);
				header('Location: ../php/editar-usuarios.php');
				break;
			case 'Actualizar':													
				$db = BD_conexion();
				$tabla = BD_getUsuario($db,$_POST['id']);
				$consulta = $tabla[0];
		    	$usuario = $_POST['id'];
		    	$nombre = $consulta["nombre"];
		    	$categoria = $consulta["categoria"];
		    	$direccion = $consulta["direccion"];
		    	$tel = $consulta["tel"];
		    	$email = $consulta["email"];
	
				echo<<<HTML
<div class="principal-der">
			<div id="miembros">
				<p>Contenido</p>
				<p>Listado de miembros del grupo</p>

				<div class="miembro">
					<div class="foto">
						<img src="../img/perfil.jpg">
					</div>

					<div class="informacion">

						<form action="./editar-usuarios.php" method="post">
							<table border="0">
				              <tr>
				                <td>Usuario</td>
				                <td><input type="text" name="usuario" value="$usuario"></td>
				              </tr>

				              <tr>
				                <td>Nombre:</td>
				                <td><input type="text" name="nombre" value="$nombre"></td>
				              </tr>

				             <tr>
				                <td>Categoría</td>
				                <td>
				                	<select name="categoria" value="$categoria">
				                		<option selected value="Invitado">Invitado</option>
                						<option value="Catedratico">Catedratico</option>
                						<option value="Titular">Titular</option>
                						<option value="Investigador">Investigador</option>
                						<option value="Administrador">Administrador</option>
				                	</select>
				                </td>
				              </tr>
				              
				              <tr>
				                <td>Dirección:</td>
				                <td><input type="text" name="direccion" value="$direccion"></td>
				              </tr>
				             <tr>
				                <td>Telefono</td>
				                <td><input type="tel" name="tel" value="$tel"></td>
				              </tr>

				              <tr>
				                <td>Email</td>
				                <td><input type="email" name="email" value="$email"></td>
				              </tr>

				              	<form action="../php/editar-usuarios.php" method="post">
	            					<div class="opcion">
	            						<input type='hidden' name='id' value="$usuario">
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
		    	$usuario = $_POST['usuario'];
		    	$nombre = $_POST["nombre"];
		    	$categoria = $_POST["categoria"];
		    	$direccion = $_POST["direccion"];
		    	$tel = $_POST["tel"];
		    	$email = $_POST["email"];
				BD_updateMiembro($db,$usuario,$nombre,$categoria,$direccion,$tel,$email);
				BD_desconexion($db);
				header('Location: ../php/editar-usuarios.php');
				break;

			case 'Cancelar':
				header('Location: ../php/editar-usuarios.php');
				break;
			
			case 'Crear':
		    	$usuario = $_POST['usuario'];
				$pass = $_POST["pass"];
		    	$nombre = $_POST["nombre"];
		    	$tipo = $_POST["tipo"];
		    	$direccion = $_POST["direccion"];
		    	$telefono = $_POST["telefono"];
		    	$email = $_POST["email"];
				if($usuario != null && $pass != null && $nombre != null && $tipo != null && $direccion != null && $telefono != null && $email != null){
					$permisos = 1;
					$db = BD_conexion();
					if($tipo == "Administrador"){
						$permisos = 0;
					}
					BD_insertUsuario($db, $usuario, $pass , $nombre, $tipo, $direccion, $telefono, $email,$permisos);
					BD_desconexion($db);
				}
				header('Location: ../php/editar-usuarios.php');
				break;
		}
	}else{
		echo<<<HTML


<div class="principal-der">
			<div id="miembros">
				<p>Contenido</p>
				<p>Listado de mienbros del grupo</p>

				<div class="miembro">
					<div class="foto">
						<img src="../img/perfil.jpg">
					</div>

					<div class="informacion">

						<form action="./editar-usuarios.php" method="post">
							<table border="0">
				              <tr>
				                <td>Usuario</td>
				                <td><input type="text" name="usuario"></td>
				              </tr>

				              <tr>
				                <td>Contraseña:</td>
				                <td><input type="password" name="pass"></td>
				              </tr>

				              <tr>
				                <td>Nombre:</td>
				                <td><input type="text" name="nombre"></td>
				              </tr>

				             <tr>
				                <td>Categoría</td>
				                <td>
				                	<select name="tipo">
				                		<option selected value="Invitado">Invitado</option>
                						<option value="Catedratico">Catedratico</option>
                						<option value="Titular">Titular</option>
                						<option value="Investigador">Investigador</option>
                						<option value="Administrador">Administrador</option>
				                	</select>
				                </td>
				              </tr>
				              
				              <tr>
				                <td>Dirección:</td>
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
	            					<input type='hidden' name='id' value="default">
									<input type="submit" name="accion" value = "Crear">
				              </div>

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
	$tabla = BD_getMiembros($db);
	BD_desconexion($db);
	
	foreach ($tabla as $valor) {
    	$usuario = $valor["usuario"];
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
			                <td>Usuario</td>
			                <td>$usuario</td>
			              </tr
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

			              	<form action="../php/editar-usuarios.php" method="post">
            					<div class="opcion">
	            					<input type='hidden' name='id' value="$usuario">
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