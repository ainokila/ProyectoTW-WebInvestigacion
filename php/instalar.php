<?php
		include './include/sesion.php';
		validaUsuario();
		include '../plantillas/head-login.html';
		generaCabecera();
		generaMenu();
		

?>
	<div class="principal-der">
			<div class="login">
				<form class="form-horizontal" action="./instalar.php" method="post">



					<div class="form-group">
				      <label class="control-label col-sm-2" for="email">Adminitrador:</label>
				      <div class="col-sm-10">
				        <input type="text" class="form-control" id="usuario" placeholder="Introduza usuario" name="usuario">
				      </div>
				    </div>

				    <div class="form-group">
				      <label class="control-label col-sm-2" for="pwd">Password:</label>
				      <div class="col-sm-10">          
				        <input type="password" class="form-control" id="pwd" placeholder="Introduza contraseña" name="pass">
				      </div>
				    </div>

				    <div class="form-group">
				      <label class="control-label col-sm-2" for="pwd">Password:</label>
				      <div class="col-sm-10">          
				        <input type="password" class="form-control" id="pwd" placeholder="Introduza contraseña" name="pass2">
				      </div>
				    </div>

				    <div class="form-group">
				      <label class="control-label col-sm-2" for="pwd">Nombre:</label>
				      <div class="col-sm-10">          
				        <input type="text" class="form-control" id="nombre" placeholder="Introduzca nombre" name="nombre">
				      </div>
				    </div>


				    <div class="form-group">
				      <label class="control-label col-sm-2" for="pwd">Dirección:</label>
				      <div class="col-sm-10">          
				        <input type="text" class="form-control" id="direccion" placeholder="Introduzca dirección" name="direccion">
				      </div>
				    </div>

					<div class="form-group">
				      <label class="control-label col-sm-2" for="pwd">Telefono:</label>
				      <div class="col-sm-10">          
				        <input type="tel" class="form-control" id="telefono" placeholder="Introduzca telefono" name="telefono">
				      </div>
				    </div>

					<div class="form-group">
				      <label class="control-label col-sm-2" for="pwd">Email:</label>
				      <div class="col-sm-10">          
				        <input type="email" class="form-control" id="email" placeholder="Introduzca email" name="email">
				      </div>
				    </div>


				    <div class="form-group">        
				      <div class="col-sm-offset-2 col-sm-10">
				        <button type="submit" name="alta" value="Alta" class="btn btn-default">Alta</button>
				      </div>
				    </div>

				</form>
			</div>
		</div>
	</div>

	<div class="clear"></div>

</body>
</html>

<?php
	//include "../plantillas/footer.html";

?>

<?php
	if(isset($_POST["alta"]) && !$GLOBALS['instalado']){

		$usuario = $_POST["usuario"];
		$pass = $_POST["pass"];
		$nombre = $_POST["nombre"];
		$direccion = $_POST["direccion"];
		$telefono = $_POST["telefono"];
		$email = $_POST["email"];

		if($usuario != null && $pass != null && $nombre != null && $direccion != null && $telefono != null && $email != null){
			$db = BD_conexion();
			if(BD_creaBaseDatos($db)){
				BD_insertUsuario($db, $usuario, $pass , $nombre, "Administrador", $direccion, $telefono, $email,"0");
				$GLOBALS['instalado'] = true;
				header("Location: ./iniciar-sesion.php");
			}
			BD_desconexion($db);
		}
	}
?>