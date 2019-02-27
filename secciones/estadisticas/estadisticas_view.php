<?php
require "../header.php";
include "../../model/canuncios.php";
$obj=new CAnuncios();
?>
<div class="intranet_content">
	<h3 align="center">ESTADISTICAS</h3>
	<h4 align="center">Total de anuncios disponibles: <?php echo $obj->TotalValoracion() ?></h4>
	<h5 align="center">Total de anuncios precio chollo: <?php echo $obj->TotalValoracion(0) ?></h5>
	<h5 align="center">Total de anuncios precio correcto: <?php echo $obj->TotalValoracion(1) ?></h5>
	<h5 align="center">Total de anuncios precio alto: <?php echo $obj->TotalValoracion(2) ?></h5>
</div>
<?php require "../footer.php" ?>