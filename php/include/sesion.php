<?php

function generaCabecera(){
		echo <<<HTML

			<header>
		<div class="izquierda">
			<img src="../img/logo_UGR.png">			
		</div>
		<div class="derecha">
			<div id="login">
				<p>Usuario</p>
				<p><a href="../php/sesion.php">Iniciar/Cerrar Sesión</a></p>
			</div>
		</div>
		<div id="title" class="centro">
			<h1>Titulo Proyecto</h1>
		</div>
	</header>
	<div class="clear"></div>


HTML;
}


function generaMenu(){

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
					<li><a href="../php/publicar.php">Añadir publicación</a></li>
					<li><a href="../php/aniadir-pro.php">Añadir proyecto</a></li>
				</ul>

				<ul>
					<li><a href="../php/editar-usuarios.php">Editar usuarios</a></li>
					<li><a href="../php/log.php">Ver log</a></li>
				</ul>
			</div>
		</div>
HTML;

}

?>