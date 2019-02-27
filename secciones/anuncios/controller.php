<?php session_start();
include '../../model/canuncios.php';
$pagina="anuncios_view.php";
$msg="";
try
{
	if (isset($_GET["op"]))
	{
		$obj = new CAnuncios();
		switch ($_GET["op"])
		{
			case 1: //Insertar nueva anuncio
				$id=$obj->Insertar($_SESSION["us_id"],$_POST["web"],$_POST["categoria"],$_POST["producto"],$_POST["URLfoto"],$_POST["URLanuncio"],$_POST["precio_anuncio"],$_POST["precio_correcto"],$_POST["precio_chollo"]);
				if ($id<=0)
				{
					echo "Que haces aqui";exit;
					$msg="No se ha podido insertar el anuncio";
				}
			break;
			case 2: //Actualizar anuncio
				$total = $obj->Actualizar($_POST["id_producto"],$_POST["web"],$_POST["categoria"],$_POST["producto"],$_POST["URLfoto"],$_POST["URLanuncio"],$_POST["precio_anuncio"],$_POST["precio_correcto"],$_POST["precio_chollo"]);
				if ($total<=0)
				{
					$msg="No se ha podido actualizar el anuncio";
				}
			break;
			case 3: //Eliminar anuncio
				$total = $obj->Eliminar($_GET["id"]);
				if ($total<=0)
				{
					$msg="No se ha podido eliminar el anuncio";
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