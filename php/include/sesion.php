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
			<h1>TW Investigación</h1>
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
			<h1>TW Investigación</h1>
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
		if($_POST["usuario"]!=""&& $_POST["pass"]!=""){
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
		$consulta = $table[0];
		if( $consulta["password"] === $pass ){
			$privilegios = $consulta["privilegios"] ;
			return true;
		}
		else{
			return false;
		}		
	}
	return false;
}

function BD_conexion(){
	$db = mysqli_connect('192.168.0.5', 'root', 'root','proyectoinvestigacion');
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
}
/*METODOS PROYECTOS*/

function BD_getProyectos($db) {
	$res = mysqli_query($db, "SELECT codigo,titulo,descripcion,DATE_FORMAT(comienzo, '%d/%m/%Y'),DATE_FORMAT(fin, '%d/%m/%Y'),entidades,cuantia,inv_principal,inv_secundarios,url FROM proyectos");
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

function BD_getProyecto($db,$codigo) {
	$res = mysqli_query($db, "SELECT titulo,descripcion,comienzo, fin, entidades,cuantia,inv_principal,inv_secundarios,url FROM proyectos
	WHERE codigo = '$codigo' ");
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

function BD_borrarProyecto($db,$codigo){
	$res = mysqli_query($db, "DELETE FROM proyectos WHERE codigo = '$codigo'");
	if ($res) { // Si no hay error
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		echo $res;
		return false;
	}
}

function BD_updateProyecto($db,$codigo,$titulo,$descripcion,$comienzo,$fin,$entidades,$cuantia,$inv_principal,$inv_secundarios,$url){
	$res = mysqli_query($db, "UPDATE proyectos SET titulo = '$titulo', descripcion = '$descripcion', comienzo = DATE_FORMAT('$comienzo', '%Y/%m/%d'), fin = DATE_FORMAT('$fin', '%Y/%m/%d'), entidades = '$entidades',cuantia = '$cuantia',inv_principal = '$inv_principal',inv_secundarios = '$inv_secundarios',url = '$url' WHERE codigo = '$codigo' ");
	if ($res) { // Si no hay error
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		echo $res;
		return false;
	}
}

function BD_insertarProyecto($db,$codigo,$titulo,$descripcion,$comienzo,$fin,$entidades,$cuantia,$inv_principal,$inv_secundarios,$url){
	$res = mysqli_query($db, "INSERT INTO proyectos(codigo ,titulo,descripcion,comienzo,fin,entidades,cuantia,inv_principal,inv_secundarios,url) VALUES('$codigo','$titulo','$descripcion','$comienzo','$fin','$entidades','$cuantia','$inv_principal','$inv_secundarios','$url')");

	if ($res) { // Si no hay error
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		echo $res;
		return false;
	}
}

/*METODO PUBLICACION*/
function BD_getPublicaciones($db){

  $res = mysqli_query($db, "SELECT doi,titulo,autores,DATE_FORMAT(fechapub, '%d/%m/%Y'),resumen,palabras_clave,url,proyecto_vin FROM publicacion");
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

function BD_getPublicacion($db, $doi) {
	$res = mysqli_query($db, "SELECT titulo,autores,fechapub,resumen,palabras_clave,url,proyecto_vin FROM publicacion
	WHERE doi = '$doi' ");
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

function BD_borrarPublicacion($db,$doi){
	$res = mysqli_query($db, "DELETE FROM publicacion WHERE doi = '$doi'");
	if ($res) { // Si no hay error
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		echo $res;
		return false;
	}
}

function BD_updatePublicacion($db,$doi,$titulo,$autores,$fechapub,$resumen,$palabras_clave,$url,$proyecto_vin){
	$res = mysqli_query($db, "UPDATE publicacion SET titulo = '$titulo', autores = '$autores', fechapub = DATE_FORMAT('$fechapub', '%Y/%m/%d'), resumen = '$resumen',palabras_clave = '$palabras_clave',url = '$url',proyecto_vin = '$proyecto_vin' WHERE doi = '$doi' ");
	if ($res) { // Si no hay error
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		echo $res;
		return false;
	}
}

function BD_insertPublicacion($db,$doi,$titulo,$autores,$fechapub,$resumen,$palabras_clave,$url,$proyecto_vin){
	$res = mysqli_query($db, "INSERT INTO publicacion(doi ,titulo,autores,fechapub,resumen,palabras_clave,url,proyecto_vin) VALUES('$doi','$titulo','$autores','$fechapub','$resumen','$palabras_clave','$url','$proyecto_vin')");

	if ($res) { // Si no hay error
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		echo $res;
		return false;
	}
}

function BD_getPublicacionConProye($db,$codigoProyecto){
  $res = mysqli_query($db, "SELECT titulo FROM publicacion WHERE proyecto_vin = '$codigoProyecto' ");
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

/*METODOS MIEMBROS*/
function BD_insertUsuario($db, $user, $pass , $nombre, $tipo, $direccion, $telefono, $email,$privilegios){
	$res = mysqli_query($db, "INSERT INTO miembros(usuario,password	,nombre	,categoria,	direccion,	tel	,email, privilegios) VALUES('$user', '$pass', '$nombre', '$tipo', '$direccion', '$telefono', '$email', '$privilegios')");
	if ($res) { // Si no hay error
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		echo $res;
		return false;
	}
}

function BD_getUsuario($db, $user) {
	$res = mysqli_query($db, "SELECT usuario,password,privilegios FROM miembros
	WHERE usuario = '$user' ");
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

function BD_getMiembros($db) {
	$res = mysqli_query($db, "SELECT nombre,categoria,direccion,tel,email FROM miembros");
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