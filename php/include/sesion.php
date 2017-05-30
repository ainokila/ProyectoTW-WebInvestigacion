<?php

function generaCabecera(){
	if(isset($_SESSION["usuario"])){
		$usuarioActual = $_SESSION["usuario"];
		$privilegiosActuales = $_SESSION["privilegios"];

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

function compruebaUsuarioPass($user, $pass,&$privilegios){


	if(strcmp($user,$pass) === 0){
		$privilegios = rand(0,2);
		return true;
	}
	else{
		return false;
	}
}
?>