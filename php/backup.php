
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

						$db = BD_conexion();
						$tablas = array();
						$result = mysqli_query($db,'SHOW TABLES');
						while ($row = mysqli_fetch_row($result))
						$tablas[] = $row[0];
						// Salvar cada tabla
						$salida = '';
						foreach ($tablas as $tab) {
						$result = mysqli_query($db,'SELECT * FROM '.$tab);
						$num = mysqli_num_fields($result);
						$salida .= 'DROP TABLE '.$tab.';';
						$row2 = mysqli_fetch_row(mysqli_query($db,'SHOW CREATE TABLE '.$tab));
						$salida .= "\n\n".$row2[1].";\n\n"; // row2[0]=nombre de tabla
						while ($row = mysqli_fetch_row($result)) {
						$salida .= 'INSERT INTO '.$tab.' VALUES(';
						for ($j=0; $j<$num; $j++) {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = preg_replace("/\n/","\\n",$row[$j]);
						if (isset($row[$j]))
						$salida .= '"'.$row[$j].'"';
						else
						$salida .= '""';
						if ($j < ($num-1)) $salida .= ',';
						}
						$salida .= ");\n";
						}
						$salida .= "\n\n\n";
						}

						echo  nl2br("$salida");
						BD_desconexion($db);
					?>
				</div>
	</div>

<?php

		include "../plantillas/footer.html";

?>