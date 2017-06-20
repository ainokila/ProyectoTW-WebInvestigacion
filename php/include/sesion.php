<?php

require_once('credenciales.php');

function updateLog($cadena){

	$nombre_archivo = "../log/log.txt";
	if($archivo = fopen($nombre_archivo, "a"))
    {
        if(fwrite($archivo, "[".date("Y-m-d H:i:s.u")."]  Accion: ".$cadena."\n"))
        {
            echo "Ok log";
        }
        else
        {
            echo "Corrupt log";
        }
 
        fclose($archivo);
    }

}


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
				<p><a href="../php/iniciar-sesion.php">Iniciar Sesión</a>/<a href="../php/registro.php">Registrar</a></p>
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
				echo sha1($password);
			if(compruebaUsuarioPass($user, $password, $privilegios)){
				$_SESSION["usuario"] = $user;
				$_SESSION["privilegios"] = $privilegios;
				updateLog("$user inicia sesion");
				header("Location: ./principal.php");
			}else{
				updateLog("$user falla inicia sesion");
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
		if( $consulta["password"] === sha1($pass) ){
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

	$db = mysqli_connect(constant("IP"),  constant("USER_BD"), constant("PASS_BD"),constant("NAME_BD"));
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
		updateLog("Erase proyect $codigo");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error erase proyect $codigo");
		echo $res;
		return false;
	}
}

function BD_updateProyecto($db,$codigo,$titulo,$descripcion,$comienzo,$fin,$entidades,$cuantia,$inv_principal,$inv_secundarios,$url){

	$codigo = strip_tags($codigo);
	$titulo  = strip_tags($titulo);
	$descripcion = strip_tags($descripcion);
	$comienzo = strip_tags($comienzo);
	$fin = strip_tags($fin);
	$entidades = strip_tags($entidades);
	$cuantia = strip_tags($cuantia);
	$inv_principal = strip_tags($inv_principal);
	$inv_secundarios= strip_tags($inv_secundarios);
	$url= strip_tags($url);

	$res = mysqli_query($db, "UPDATE proyectos SET titulo = '$titulo', descripcion = '$descripcion', comienzo = DATE_FORMAT('$comienzo', '%Y/%m/%d'), fin = DATE_FORMAT('$fin', '%Y/%m/%d'), entidades = '$entidades',cuantia = '$cuantia',inv_principal = '$inv_principal',inv_secundarios = '$inv_secundarios',url = '$url' WHERE codigo = '$codigo' ");
	if ($res) { // Si no hay error
		updateLog("Update proyect $codigo");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error update proyect $codigo");
		echo $res;
		return false;
	}
}

function BD_insertarProyecto($db,$codigo,$titulo,$descripcion,$comienzo,$fin,$entidades,$cuantia,$inv_principal,$inv_secundarios,$url){

	$codigo = strip_tags($codigo);
	$titulo  = strip_tags($titulo);
	$descripcion = strip_tags($descripcion);
	$comienzo = strip_tags($comienzo);
	$fin = strip_tags($fin);
	$entidades = strip_tags($entidades);
	$cuantia = strip_tags($cuantia);
	$inv_principal = strip_tags($inv_principal);
	$inv_secundarios= strip_tags($inv_secundarios);
	$url= strip_tags($url);


	$res = mysqli_query($db, "INSERT INTO proyectos(codigo ,titulo,descripcion,comienzo,fin,entidades,cuantia,inv_principal,inv_secundarios,url) VALUES('$codigo','$titulo','$descripcion','$comienzo','$fin','$entidades','$cuantia','$inv_principal','$inv_secundarios','$url')");

	if ($res) { // Si no hay error
		updateLog("Insert proyect $codigo");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error nsert proyect $codigo");
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
		updateLog("Erase publication $doi");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error erase publication $doi");
		echo $res;
		return false;
	}
}

function BD_updatePublicacion($db,$doi,$titulo,$autores,$fechapub,$resumen,$palabras_clave,$url,$proyecto_vin){
	$doi = strip_tags($doi);
	$titulo  = strip_tags($titulo);
	$autores = strip_tags($autores);
	$fechapub = strip_tags($fechapub);
	$resumen = strip_tags($resumen);
	$palabras_clave = strip_tags($palabras_clave);
	$url = strip_tags($url);
	$proyecto_vin = strip_tags($proyecto_vin);

	$res = mysqli_query($db, "UPDATE publicacion SET titulo = '$titulo', autores = '$autores', fechapub = DATE_FORMAT('$fechapub', '%Y/%m/%d'), resumen = '$resumen',palabras_clave = '$palabras_clave',url = '$url',proyecto_vin = '$proyecto_vin' WHERE doi = '$doi' ");
	if ($res) { // Si no hay error
		updateLog("Update publication $doi");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error update publication $doi");
		echo $res;
		return false;
	}
}

function BD_insertPublicacion($db,$doi,$titulo,$autores,$fechapub,$resumen,$palabras_clave,$url,$proyecto_vin){

	$doi = strip_tags($doi);
	$titulo  = strip_tags($titulo);
	$autores = strip_tags($autores);
	$fechapub = strip_tags($fechapub);
	$resumen = strip_tags($resumen);
	$palabras_clave = strip_tags($palabras_clave);
	$url = strip_tags($url);
	$proyecto_vin = strip_tags($proyecto_vin);


	$res = mysqli_query($db, "INSERT INTO publicacion(doi ,titulo,autores,fechapub,resumen,palabras_clave,url,proyecto_vin) VALUES('$doi','$titulo','$autores','$fechapub','$resumen','$palabras_clave','$url','$proyecto_vin')");

	if ($res) { // Si no hay error
		updateLog("Insert publication $doi");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error insert publication $doi");
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

	$user = strip_tags($user);
	$pass  = strip_tags($pass);
	$nombre = strip_tags($nombre);
	$tipo = strip_tags($tipo);
	$telefono = strip_tags($telefono);
	$telefono = strip_tags($telefono);
	$privilegios = strip_tags($privilegios);

	$pass = sha1($pass);
	$res = mysqli_query($db, "INSERT INTO miembros(usuario,password	,nombre	,categoria,	direccion,	tel	,email, privilegios) VALUES('$user', '$pass', '$nombre', '$tipo', '$direccion', '$telefono', '$email', '$privilegios')");
	if ($res) { // Si no hay error
		updateLog("New user $user");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Failed New user $user");
		echo $res;
		return false;
	}
}

function BD_getUsuario($db, $user) {
	$res = mysqli_query($db, "SELECT usuario, password, nombre,categoria,direccion,tel,email,privilegios FROM miembros
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
	$res = mysqli_query($db, "SELECT usuario, nombre,categoria,direccion,tel,email FROM miembros");
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

function BD_borrarMiembro($db,$user){
	$res = mysqli_query($db, "DELETE FROM miembros WHERE usuario = '$user'");
	if ($res) { // Si no hay error
		updateLog("Erase user $user");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Failed erase user $user");
		echo $res;
		return false;
	}
}

function BD_updateMiembro($db,$usuario,$nombre,$categoria,$direccion,$tel,$email,$privilegios){

	$usuario = strip_tags($usuario);
	$nombre = strip_tags($nombre);
	$categoria = strip_tags($categoria);
	$direccion = strip_tags($direccion);
	$tel = strip_tags($tel);
	$email = strip_tags($email);
	$privilegios = strip_tags($privilegios);

	$res = mysqli_query($db, "UPDATE miembros SET nombre = '$nombre', categoria = '$categoria', direccion ='$direccion', tel = '$tel',email = '$email',privilegios = '$privilegios' WHERE usuario = '$usuario' ");
	if ($res) { // Si no hay error
		updateLog("Update user $user");
		return true;
		mysqli_free_result($res); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Failed update user $user");
		echo $res;
		return false;
	}
}


function BD_creaBaseDatos($db){
	
	updateLog("Create data base");

	$res1 = mysqli_query($db, "CREATE TABLE IF NOT EXISTS MIEMBROS(
    usuario varchar(30) not null PRIMARY KEY,
    password varchar(100) not null ,
    nombre varchar(30) not null,
    categoria varchar(30) not null,
    direccion varchar(30) not null,
    tel varchar(12) not null,
    email varchar(30) not null,
    privilegios int not null default 1)");
	if ($res1) { // Si no hay error
		mysqli_free_result($res1); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error create data base");
		return false;
	}


	$res2 = mysqli_query($db, "CREATE TABLE IF NOT EXISTS PROYECTOS(
    codigo varchar(30) not null PRIMARY KEY,
    titulo varchar(30) not null ,
    descripcion varchar(500) not null,
    comienzo date not null,
    fin date not null,
    entidades varchar(100),
    cuantia int not null,
    inv_principal varchar(200) not null,
    inv_secundarios varchar(400) not null,
    url varchar(100) not null)");
	if ($res2) { // Si no hay error
		mysqli_free_result($res2); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error create data base");
		return false;
	}


	$res3 = mysqli_query($db, "CREATE TABLE IF NOT EXISTS PUBLICACION(
    doi varchar(30) not null PRIMARY KEY,
    titulo varchar(30) not null ,
    autores varchar(200) not null,
    fechapub date not null,
    resumen varchar(500) not null,
    palabras_clave varchar(100),
    url varchar(100) not null,
    proyecto_vin varchar(30) not null,
    FOREIGN KEY (proyecto_vin) REFERENCES proyectos(codigo))");
	if ($res3) { // Si no hay error
		mysqli_free_result($res3); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error create data base");
		return false;
	}


	$res4 = mysqli_query($db, "CREATE TABLE IF NOT EXISTS realizapub(
    doi_pub varchar(30) not null,
    usuario_miembro varchar(30) not null,
    CONSTRAINT FK_DOI_ERROR FOREIGN KEY (doi_pub) REFERENCES publicacion(doi),
    CONSTRAINT FK_NOMBRE_ERROR FOREIGN KEY (usuario_miembro) REFERENCES miembros(usuario),
    PRIMARY KEY(doi_pub,usuario_miembro))");
	if ($res) { // Si no hay error
		mysqli_free_result($res4); // Liberar memoria de la consulta
	} else { // Error en la consulta
		updateLog("Error create data base");
		return false;
	}


	$res5 = mysqli_query($db, "CREATE TABLE IF NOT EXISTS compone(
    codigo_pro varchar(30) not null,
    usuario_miembro varchar(30) not null,
    CONSTRAINT FK_CODIGO_ERROR FOREIGN KEY (codigo_pro) REFERENCES proyectos(codigo),
    CONSTRAINT FK_USUARIO_ERROR FOREIGN KEY (usuario_miembro) REFERENCES miembros(usuario),
    PRIMARY KEY(codigo_pro,usuario_miembro))");
	if ($res5) { // Si no hay error
		mysqli_free_result($res5); // Liberar memoria de la consulta
		updateLog("Create data base sucesfull");
		return true;
	} else { // Error en la consulta
		updateLog("Create data base unsucesfull");
		return false;
	}



}
?>