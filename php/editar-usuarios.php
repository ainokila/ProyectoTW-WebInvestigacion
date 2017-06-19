<?php
		session_start();
		include './include/sesion.php';
		include '../plantillas/head-miembros.html';
	
		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();
		

?>

<?php
	if(isset($_POST["alta"])){
		$usuario = $_POST["usuario"];
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
	}
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
									<input type="submit" name="alta" value = "Alta">
				              </div>

	            			</table>
            			</form>
					</div>

				</div>
				<div class="clear"></div>
<?php

	$db = BD_conexion();
	$tabla = BD_getMiembros($db);
	BD_desconexion($db);
	
	foreach ($tabla as $valor) {
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

HTML;

	}


?>				
			</div>
		</div>
	</div>
	
<?php
	include "../plantillas/footer.html";

?>