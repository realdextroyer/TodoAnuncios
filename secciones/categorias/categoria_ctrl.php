<?php session_start();
include '../../model/ccategorias.php';
$pagina="categorias_view.php";
$msg="";
try
{
	if (isset($_GET["op"]))
	{
		$obj = new CCategorias();
		switch ($_GET["op"])
		{
			case 1: //Insertar nueva categoria
				$id=$obj->Añadir_Cat($_POST["categoria"]);
				if ($id<=0)
				{
					$msg="No se ha podido insertar la categoria";
				}
			break;
			case 2: //Editar categoria
				$total = $obj->Editar_Cat($_POST["id_categoria"],$_POST["nombre_categoria"]);
				if ($total<=0)
				{
					$msg="No se ha podido actualizar la película";
				}
			break;
			case 3: //Eliminar película
				$total = $obj->Eliminar_Cat($_GET["id"]);
				if ($total<=0)
				{
					$msg="No se ha podido eliminar la película";
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
    $msg="No se ha podido relizar la operacion";
}
header("Location:$pagina?msg=$msg");
?>