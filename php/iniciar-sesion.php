<?php
		include './include/sesion.php';
		validaUsuario();
		include '../plantillas/head-login.html';
		generaCabecera();
		generaMenu();
		

?>
	<div class="principal-der">
			<div class="login">
				<form action="./iniciar-sesion.php" method="post">
					<label>Usuario: </label>
					<input type="text" name="usuario"> <br>
					<label>Contraseña: </label>
					<input type="password" name="pass"> <br>
					<input type="submit" name="login" value = "Login">
				</form>
			</div>
		</div>
	</div>

	<div class="clear"></div>


<?php
	include "../plantillas/footer.html";

?>