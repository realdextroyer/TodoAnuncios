<?php session_start();
include '../../model/cusuarios.php';
$pagina="login_view.php";
$msg="";
try
{
	if (isset($_GET["op"]))
	{
		$obj = new CUsuarios();
		switch ($_GET["op"])
		{
			case 1: //Login de usuario
			$id=$obj->Validar($_POST["mail"],$_POST["pass"]);
				//Si el $id>0, login es válido, creamos una sesión:
			if ($id>0) {
					//Cargo los datos del usuario (la función validar
					//ya ha cargado los atributos ID y Nombre:
				$_SESSION["us_id"] = $id;
				$_SESSION["us_nombre"] = $obj->getNombre();
					//Redirigimos a la intranet
				$pagina = "../intranet/intranet_view.php";
			} else {
				$msg="Login incorrecto";
			}
			break;
			case 2: //Insertar usuario

			$id=$obj->Insertar($_POST["nombre"],$_POST["mail"],$_POST["pass"]);
				if ($id>0)
				{
					$msg="Se ha registrado correctamente, logueese";
				}
				else
				{
					$msg="No ha podido registrarse, intentelo de nuevo";
				}
			break;

			case 3: //Cambiar password
			$id_usuario=$_SESSION["us_id"];
			$id=$obj->Cambiar_Pass($id_usuario,$_POST["pass_old"],$_POST["pass_new"]);
			if ($id>0)
			{
				$pagina="perfil_view.php";
				$msg="Se ha modificado la contraseña correctamente";
			}
			else
			{
				$pagina="perfil_view.php";
				$msg="No se ha podido cambiar la contraseña, intentelo de nuevo";

			}
			break;
		}
	}
}
catch (Exception $e)
{
	$msg=$e->getMessage();
	//Meto un log:
    $log_file_data = '../../logs/log_' . date('d-M-Y') . '.log';
    $fecha = date("Y-m-d H:i:s");
    file_put_contents($log_file_data, "ERROR ($fecha):".$msg . "\n", FILE_APPEND);
    $msg="No se ha podido realizar la operacion";
}
header("Location:$pagina?msg=$msg");
?>