<?php
		session_start();
		include './include/sesion.php';
		include '../plantillas/head-editar-proyectos.html';
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
		<div class="principal-der">
			<div id="proyectos">
				<p>Contenido</p>
				<p>Listado de mienbros del grupo</p>

				<div class="proyecto">
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