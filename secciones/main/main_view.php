<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../../css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
	<link href="../../css/jquery-ui.css" rel="stylesheet">
	<script src="../../jquery/jquery.min.js"></script>
	<script src="../../jquery/jquery-ui.js"></script>
	<script src="../../jquery/sb-admin-datatables.js"></script>
    <script src="../../jquery/jquery.dataTables.js"></script>
    <script src="../../jquery/bootstrap.bundle.min.js"></script>
    <script src="../../jquery/dataTables.bootstrap4.js"></script>

<style>
	body
	{
		font-family: "Trebuchet MS", sans-serif;
		margin: 50px;
		background-image: url('../../images/deals.jpg');
		background-position: center top;
		background-repeat: no-repeat;
		background-size:100% 200%;
		background-color: aqua;
    }
    select
    {
		width: 200px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	.seleccion
	{
		background-size: cover;
		background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.5));
	}
	.imagenfondo
	{
		background-image: url('../../images/deals.jpeg');
		background-size: 25%;
		background-repeat: no-repeat;
	}

</style>

</head>

<body>
	<div align="center" class="demoHeaders imagenfondo">
		<p><span style="color: #3E55C9;font-size: 25px"><marquee width='50%'>Bienvenido a TodoAnuncios, la web donde encontraras...</marquee></span></p>
		<p style="font-weight: bold" align="center">Categorías:</p>
		<p></p>
		<?php 
			include "../../model/ccategorias.php";
			$objcat = new CCategorias();
			$listacat=$objcat->Listar();
			include "../../model/canuncios.php";
			$obj = new CAnuncios();

			foreach ($listacat as $key)
			{
				$id_cat=$key['id_cat'];
				$nombre_cat=$key['nombre_cat'];
				$cat_min=$obj->Producto_Cat_Min($id_cat);
				$producto_min="";
				$precio_min="";
				$enlace="";
				
				foreach ($cat_min as $key)
				{
					$producto_min=$key['nombre_producto'];
					$precio_min=$key['precio_anuncio'];
					$enlace=$key['URL_anuncio'];
				}
				if ($producto_min<>"")
				{
				echo "<p>$nombre_cat: <a style='color: blue; text-decoration: none;' href='$enlace' target='_blank'>".$producto_min."</a> desde ".$precio_min." €</p>";
				}
			}	
		?>	
	</div>

	<h2 align="center" class="demoHeaders">ANUNCIOS</h2>

	<div class="seleccion" id="tabs">
		<ul>
			<li><a href='#tabs-0'>Total</a></li>
			<?php
				foreach ($listacat as $key)
				{
					$id_cat=$key['id_cat'];
					$nombre_cat=$key['nombre_cat'];
					echo "<li><a href='#tabs-".$id_cat."'>$nombre_cat</a></li>";
				}
			?>
		</ul>		
			<?php

				$lista_cat = array();
				//Añadimos cat 0 y Total:
				$lista_cat[]=array('id_cat'=>'0','nombre_cat'=>'Total');
				foreach ($listacat as $key)
				{
					$lista_cat[] = $key;
				}
				foreach ($lista_cat as $key)
				{
					$id_cat=$key['id_cat'];
					$nombre_cat=$key['nombre_cat'];
					$lista=$obj->ListarCat($id_cat);
					echo "<div id='tabs-".$id_cat."'>";
			?>
					<table id="dtBasic" width="100%">
						<thead style="font-weight: bold;" align="center"><td>PRODUCTO</td><td ></td><td>PRECIO</td><td>WEB</td><td></td></thead>
						<?php 
							foreach ($lista as $key)
							{
								$nombre_producto=$key['nombre_producto'];
								$URLfoto=$key['URL_foto'];
								$URLanuncio=$key['URL_anuncio'];
								$precio_anuncio=$key['precio_anuncio'];
								$valor=$key['valoracion'];
								$nombre_web=$key['nombre_web'];
						?>
							<tr align="center">
								<td><?php echo $nombre_producto ?></td>
								<td><img width="100" src='<?php echo $URLfoto ?>'></td>
								<td><?php echo $precio_anuncio.' €' ?></td>
								<td><a style="color: blue; text-decoration: none;" href='<?php echo $URLanuncio ?>' target=”_blank” ><?php echo $nombre_web ?></a></td>
								<td>
									<?php
									//Pintamos la imagen dependiendo de la valoracion
									switch ($valor)
									{
										case '0':
											echo "<img width=60 src='../../images/chollo.png'>";
										break;
										case '1':
											echo "<img width=50 src='../../images/correcto.png'>";
										break;
										case '2':
											echo "<img width=40 src='../../images/malo.png'>";
										break;
									}
									?>	
								</td>
							</tr>
							<?php
							}//cerrar foreach
							?>
					</table>			
					</div>
			<?php
				}//cerrar foreach
			?>
	</div>

	<script>
		$("#tabs").tabs();
	</script>

</body>
</html>