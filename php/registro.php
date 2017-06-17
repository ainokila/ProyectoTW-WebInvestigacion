<?php
		include './include/sesion.php';
		validaUsuario();
		include '../plantillas/head-login.html';
		generaCabecera();
		generaMenu();
		

?>
	<div class="principal-der">
			<div class="login">
				<form action="./registro.php" method="post">
					<label>Usuario: </label>
					<input type="text" name="usuario"> <br>
					<label>Contraseña: </label>
					<input type="password" name="pass"> <br>
					<label>Repetir Contraseña: </label>
					<input type="password" name="pass"> <br>
					<label>Nombre: </label>
					<input type="text" name="nombre"> <br>
					<label>Categoría: </label>
					<select>
	            		<option selected value="invitado">Invitado</option>
                		<option value="catedratico">Catedratico</option>
                		<option value="titular">Titular</option>
                		<option value="investigador">Investigador</option>
                	</select></br>
					<label>Dirección: </label>
					<input type="text" name="direccion"> <br>
					<label>Teléfono: </label>
					<input type="tel" name="telefono"> <br>
					<label>Email: </label>
					<input type="email" name="email"> <br>
					<input type="submit" name="alta" value = "Alta">
				</form>
			</div>
		</div>
	</div>

	<div class="clear"></div>


<?php
	include "../plantillas/footer.html";

?>