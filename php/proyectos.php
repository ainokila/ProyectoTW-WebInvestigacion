<?php
		include './include/sesion.php';
		include '../plantillas/head-proyecto.html';
		//include "../plantillas/cabecera-menu.html";
		generaCabecera();
		generaMenu();
		

?>

<div class="principal-der">
			<div class="proyecto">
				<ul>
					<li>Código</li>
					<li>Título</li>
					<li>Descripción</li>
					<li>
						<table border="1">
							<tr>
								<th>Publicaciones</th>
							</tr>
							<tr>
								<td>-<a href="../php/log.php">Referencia a Publicación 1</a></td>
							</tr>
							<tr>
								<td>-<a href="../php/log.php">Referencia a Publicación 2</a></td>
							</tr>
						</table>
					</li>
					<li>
						<table border="1">
							<tr>
								<th>Publicaciones</th>
							</tr>
							<tr>
								<td>-<a href="../php/log.php">Referencia a Publicación 1</a></td>
							</tr>
							<tr>
								<td>-<a href="../php/log.php">Referencia a Publicación 2</a></td>
							</tr>
						</table>
					</li>
					<li>
						<table border="1">
							<tr>
								<th>Publicaciones</th>
							</tr>
							<tr>
								<td>-<a href="../php/log.php">Referencia a Publicación 1</a></td>
							</tr>
							<tr>
								<td>-<a href="../php/log.php">Referencia a Publicación 2</a></td>
							</tr>
						</table>
					</li>
				</ul>
				<p></p>
			</div>
		</div>
	</div>
	

<?php
	include "../plantillas/footer.html";

?>