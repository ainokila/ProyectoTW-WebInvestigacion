<?php
		include './include/sesion.php';
		validaUsuario();
		include '../plantillas/head-login.html';
		generaCabecera();
		generaMenu();
		

?>
	<div class="principal-der">
			<div class="login">
								<form class="form-horizontal" action="./registro.php" method="post">



					<div class="form-group">
				      <label class="control-label col-sm-2" for="email">Usuario:</label>
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
				      <div class="col-sm-offset-2 col-sm-10">
				        <button type="submit" name="login" value="Login" class="btn btn-default">Login</button>
				      </div>
				    </div>

				</form>
			</div>
		</div>
	</div>

	<div class="clear"></div>


<?php
	include "../plantillas/footer.html";

?>