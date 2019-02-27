<?php session_start();
include '../../model/cwebs.php';
$pagina="webs_view.php";
$msg="";
try {
	if (isset($_GET["op"])) {
		$obj = new CWebs();
		switch ($_GET["op"]) {
			case 1: //Insertar nueva categoria
				$id=$obj->Añadir_Web($_POST["web"]);
				if ($id<=0) {
					$msg="No se ha podido insertar la categoria";
				}
				break;
			case 2: //Editar categoria
				$total = $obj->Editar_Web($_POST["id_web"],$_POST["nombre_web"]);
				if ($total<=0) {
					$msg="No se ha podido actualizar la película";
				}
				break;
			case 3: //Eliminar película
				$total = $obj->Eliminar_Web($_GET["id"]);
				if ($total<=0) {
					$msg="No se ha podido eliminar la película";
				}
				break;
		}
	}
} catch (Exception $e) {
	$msg=$e->getMessage();
	//Meto un log:
    $log_file_data = '../../logs/log_' . date('d-M-Y') . '.log';
    $fecha = date("Y-m-d H:i:s");
    file_put_contents($log_file_data, "ERROR ($fecha):".$msg . "\n", FILE_APPEND);
    $msg="No se ha podido relizar la operacion";
}
header("Location:$pagina?msg=$msg");
?>