<?php session_start(); 
//Comprobar si existe una variable de session con us_id:
if (!isset($_SESSION["us_id"])) {
	header("Location:../usuarios/login_view.php?msg=Login necesario");
}
?>
<HTML>
<HEAD>
	<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="../../css/css_intranet.css">
</HEAD>
<BODY>
	<div class="intranet_header rounded border border-primary">
		<?php
		//Recogemos de la url, el nombre del usuario validado:
		$us_nombre = $_SESSION["us_nombre"];
		?>
		
		<div class="intranet_header_menu">

			<input class="btn btn-primary" onclick="location.href='../intranet/intranet_view.php'" type="button" value="Inicio">
			<input class="btn btn-primary" onclick="location.href='../anuncios/anuncios_view.php'" type="button" value="Mis Anuncios">
			<input class="btn btn-primary" onclick="location.href='../categorias/categorias_view.php'" type="button" value="Categorias"> 
			<input class="btn btn-primary" onclick="location.href='../webs/webs_view.php'" type="button" value="Webs">
			<input class="btn btn-primary" onclick="location.href='../estadisticas/estadisticas_view.php'" type="button" value="Estadisticas">
		</div>
		<div class="intranet_header_links">
			<input class="btn btn-primary" onclick="location.href='../usuarios/perfil_view.php'" type="button" value="Ver mi perfil">
			<input class="btn btn-primary" onclick="location.href='../unlogin.php'" type="button" value="Salir">
		</div>
	</div>
	