<?php

function generaCabecera(){
	if(isset($_SESSION["usuario"])){
		$usuarioActual = $_SESSION["usuario"];
		$privilegiosActuales = $_SESSION["privilegios"];

		switch ($privilegiosActuales) {
			case 0:
				$privilegiosActuales = "Admin";
				break;
			case 1:
				$privilegiosActuales = "User";
				break;		
			default:
				$privilegiosActuales = "No registrado";
				break;
		}
		echo <<<HTML

		<header>
		<div class="izquierda">
			<img src="../img/logo_UGR.png">			
		</div>
		<div class="derecha">
			<div id="login">
				<p>$usuarioActual - Rol: $privilegiosActuales</p>
				<p><a href="../php/cerrar-sesion.php">Cerrar Sesión</a></p>
			</div>
		</div>
		<div id="title" class="centro">
			<h1>Titulo Proyecto</h1>
		</div>
		</header>
		<div class="clear"></div>
HTML;
	}
	else{
		echo <<<HTML

			<header>
		<div class="izquierda">
			<img src="../img/logo_UGR.png">			
		</div>
		<div class="derecha">
			<div id="login">
				<p>No registrado</p>
				<p><a href="../php/iniciar-sesion.php">Iniciar Sesión</a></p>
			</div>
		</div>
		<div id="title" class="centro">
			<h1>Titulo Proyecto</h1>
		</div>
		</header>
		<div class="clear"></div>
HTML;
	}
}


function generaMenu(){
	if(isset($_SESSION["usuario"]) && isset($_SESSION["privilegios"]) ){
		$privilegiosActuales = $_SESSION["privilegios"];

		if($privilegiosActuales == 0){
			echo <<<HTML
				<div class="principal">
				<div class="principal-izq">
					<div id="menu">
						<ul>
							<li><a href="../php/principal.php">Principal</a></li>
							<li><a href="../php/miembros.php">Miembros</a></li>
							<li><a href="../php/publicaciones.php">Publicaciones</a></li>
							<li><a href="../php/proyectos.php">Proyectos</a></li>
						</ul>

						<ul>
							<li><a href="../php/editar-publicacion.php">Añadir publicación</a></li>
							<li><a href="../php/editar-proyectos.php">Añadir proyecto</a></li>
						</ul>

						<ul>
							<li><a href="../php/editar-usuarios.php">Editar usuarios</a></li>
							<li><a href="../php/log.php">Ver log</a></li>
						</ul>
					</div>
				</div>
HTML;
		}
		elseif($privilegiosActuales == 1){
			echo <<<HTML
				<div class="principal">
				<div class="principal-izq">
					<div id="menu">
						<ul>
							<li><a href="../php/principal.php">Principal</a></li>
							<li><a href="../php/miembros.php">Miembros</a></li>
							<li><a href="../php/publicaciones.php">Publicaciones</a></li>
							<li><a href="../php/proyectos.php">Proyectos</a></li>
						</ul>

						<ul>
							<li><a href="../php/editar-publicacion.php">Añadir publicación</a></li>
							<li><a href="../php/editar-proyectos.php">Añadir proyecto</a></li>
						</ul>
					</div>
				</div>
HTML;
		}
		elseif($privilegiosActuales == 2){
			echo <<<HTML
				<div class="principal">
				<div class="principal-izq">
					<div id="menu">
						<ul>
							<li><a href="../php/principal.php">Principal</a></li>
							<li><a href="../php/miembros.php">Miembros</a></li>
							<li><a href="../php/publicaciones.php">Publicaciones</a></li>
							<li><a href="../php/proyectos.php">Proyectos</a></li>
						</ul>
					</div>
				</div>
HTML;
		}

	}else{
			echo <<<HTML
				<div class="principal">
				<div class="principal-izq">
					<div id="menu">
						<ul>
							<li><a href="../php/principal.php">Principal</a></li>
							<li><a href="../php/miembros.php">Miembros</a></li>
							<li><a href="../php/publicaciones.php">Publicaciones</a></li>
							<li><a href="../php/proyectos.php">Proyectos</a></li>
						</ul>
					</div>
				</div>
HTML;
	}

}

function validaUsuario(){
	session_start();
	if(!empty($_POST)){
		if($_POST["usuario"]!=""&&$_POST["pass"]!=""){
				$user = $_POST["usuario"];
				$password = $_POST["pass"];
			if(compruebaUsuarioPass($user, $password, $privilegios)){
				$_SESSION["usuario"] = $user;
				$_SESSION["privilegios"] = $privilegios;
				header("Location: ./principal.php");
			}

			else{
				if(session_status()==PHP_SESSION_NONE){
					session_start();
				}
				session_destroy();
			}
		}
	}
}

function compruebaUsuarioPass($user, $pass, &$privilegios){
	$bd = BD_conexion();
	$table = BD_getUsuario($bd,$user);
	if($table != false && $table!=null){
		$password = $table[0];
		if( $password["PASSWORD"] === $pass ){
			$privilegios = 0;
			return true;
		}
		else{
			return false;
		}		
	}
	return false;
}

function BD_conexion(){
	$db = mysqli_connect('127.0.0.1', 'root', 'root','proyectoinvestigacion');
	if (!$db) {
		echo "<p>Error de conexión</p>";
		echo "<p>Código: ".mysqli_connect_errno()."</p>";
		echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
	return false; 
	}
	// Establecer la codificación de los datos almacenados ("collation")
	mysqli_set_charset($db,"utf8");
	return $db;
}

// Desconexión de la BBDD
function BD_desconexion($db) {
	mysqli_close($db);
}// Consulta para obtener listado de ciudades

function BD_getUsuario($db, $user) {
	$res = mysqli_query($db, "SELECT USUARIO,Nombre,PASSWORD FROM USUARIOS
	WHERE USUARIO= '$user' ");
	if ($res) { // Si no hay error
		if (mysqli_num_rows($res)>0) { // Si hay alguna tupla de respuesta
			$tabla = mysqli_fetch_all($res,MYSQLI_ASSOC);
		} else { // No hay resultados para la consulta
			$tabla = [];
		}
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		$tabla = false;
	}
return $tabla;
}
?>