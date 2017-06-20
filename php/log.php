<?php

		session_start();
		include './include/sesion.php';

		include '../plantillas/head-log.html';
		//include "../plantillas/cabecera-menu.html";
		
		generaCabecera();
		generaMenu();


		if(isset($_SESSION["usuario"])){
			$privilegiosActuales = $_SESSION["privilegios"];
			if($privilegiosActuales==2 || $privilegiosActuales==1){
				header('Location: ../php/principal.php');
			}
		}else{
			header('Location: ../php/principal.php');
		}


?>


				<div class="principal-der">
					<?php 
						 
						    $nombre_archivo = "../log/log.txt"; 
						    if(file_exists($nombre_archivo)) 
						    {
						        echo  nl2br(file_get_contents($nombre_archivo));
						    }
						    else
						    {
						        $mensaje = "El archivo no existe";
						    }
						 
						 
					?>
				</div>
	</div>

<?php

		include "../plantillas/footer.html";

?>