<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/estilos.css">
	<title>Guardar Dueno</title>
</head>
<body>
<?php
			try{
			
	        	require('../../connect.php');
				$id_dueno=$_POST['id_dueno'];
				$nombre1=$_POST['filial'];
				$nombre2=$_POST['encargado'];
				$ape1=$_POST['ape1'];
				$ape2=$_POST['ape2'];
		
	
				
				$query=oci_parse($conexion,"SELECT ID_FILIAL FROM FILIALES WHERE NOMBRE = '$nombre1'");
				$stid=oci_execute($query);
				$p=oci_fetch_array($query,OCI_ASSOC);
				$p = (int)$p['ID_FILIAL'];

                $s = oci_parse($conexion,"CALL SP_UPD_DUENO ('" . $id_dueno . "','" . $p . "','" . $nombre2 . "','" . $ape1 . "','" . $ape2 . "')");

		        $r = oci_execute($s,OCI_COMMIT_ON_SUCCESS);

		
			if($s){
				echo '
					<div class="row">
						<div class="col-12 col-md-6 mb-3">
							<div class="alert alert-success d-flex align-items-center" role="alert">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
								<div>
									Actualizacion exitosa!
								</div>
							</div>
						</div>
					</div>    		
				';
			}else{
				throw new Exception();
			}
			
			} catch (Exception $e) {
				echo '
					<div class="row">
						<div class="col-12 col-md-6 mb-3">
							<div class="alert alert-danger d-flex align-items-center" role="alert">
								<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
								<div>
									Ocurrio un error!
									<script src="../../js/bootstrap.bundle.min.js"></script>
								</div>
							</div>
						</div>
					</div>
				';
			} finally {
				echo '
				<div class="row mt-3">
						<div class="col-6 d-flex justify-content-center">
							<div>
								<a href="../verDueno.php">
									<button type="submit" class="col-12 btn btn-primary">Atras</button>
								</a>
							</div>
						</div>
					</div>
				';
			}
		
	?>
		<script src="../../js/bootstrap.bundle.min.js"></script>
</body>
</html>