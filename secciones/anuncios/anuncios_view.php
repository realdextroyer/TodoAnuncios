<?php
require "../header.php";
?>
	<div class="container" align="center">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4">
				<h1 class="h4 mb-3 font-weight-normal">Insertar Nuevo Anuncio</h1>
				<form name="form_insert" method="post" action="controller.php?op=1">
					
						<input class="form-control form-control-sm" style="text-align: center" type="text" name="producto" size="30" placeholder="Nombre producto" required>
						<input class="form-control form-control-sm" style="text-align: center" type="text" name="URLfoto" placeholder="URL foto" required>
						<input class="form-control form-control-sm" style="text-align: center" type="text" name="URLanuncio" placeholder="URL anuncio" required>
						<?php  
							include "../../model/ccategorias.php";
							$obj = new CCategorias();
							$lista=$obj->Listar();
							?>
							<select required="required" class="form-control form-control-sm" style="text-align: center" name="categoria">
								<option value="" selected="" disabled="">Seleccione categoria</option>
								<?php foreach ($lista as $value)
								{
									$idcat = $value["id_cat"];
									$nombrecat = $value["nombre_cat"];
									echo "<option value='$idcat'>$nombrecat</option>";
								}
								?>
							</select>
						
						<?php  
							include "../../model/cwebs.php";
							$obj = new CWebs();
							$lista=$obj->Listar();
							?>
							<select required="required" class="form-control form-control-sm" style="text-align: center" name="web">
								<option value="" selected="" disabled="">Seleccione web</option>
								<?php foreach ($lista as $value)
								{
									$idweb = $value["id_webs"];
									$nombreweb = $value["nombre_web"];
									echo "<option value='$idweb'>$nombreweb</option>";
								}
								?>
							</select>
						<input class="form-control form-control-sm" style="text-align: center" type="text" name="precio_anuncio" size="30" placeholder="Precio anunciante" required>
						<input class="form-control form-control-sm" style="text-align: center" type="text" name="precio_chollo" placeholder="Precio chollo" required>
						<input class="form-control form-control-sm" style="text-align: center" type="text" name="precio_correcto" placeholder="Precio adecuado" required>
						<input style="margin: 5PX" class="btn btn-primary btn-sm" type="submit" value="Añadir">
					</form>
				<?php 
				if (isset($_GET["msg"])) { ?>
					<div style="color:red">
						<?php echo $_GET["msg"];?>
					</div>
			</div>
	
		<?php } ?>
		<div class="col-4"></div>
	</div>
</div>
		
		<?php 
			include "../../model/canuncios.php";
			//Comprobamos si se quiere editar una película:
			$p_edit_it = 0;
			if (isset($_GET["id"]))
			{
				$p_edit_it = $_GET["id"];
			}
			$obj = new CAnuncios();
			//Para la paginación:
			$tam_pag=4;
			$id_usuario=$_SESSION['us_id'];
			$num_items = $obj->TotalAnuncios($id_usuario);
			//Comprobamos si hay que paginar:
			if ($num_items>$tam_pag)
			{
				//Obtenemos de la url en que página estoy:
				if (isset($_GET["pag"]))
				{
					$pag_act = $_GET["pag"];
				}
				else
				{
					$pag_act=1;
				}
				//Calculamos cuantas páginas hay:
				$num_pags = ceil($num_items / $tam_pag);
				//Según la página en la que estamos cargarmos las pelis:
				$inicio = ($pag_act-1)*$tam_pag;
			}
			else
			{
				$inicio=0;
			}
			$id_usuario=$_SESSION['us_id'];
			$info = $obj->ListarTotalPaginado($id_usuario,$inicio,$tam_pag);
		?>
<div align="center">
			<h1 class="h3 mb-3 font-weight-normal">Lista de anuncios</h1>
			<table width="50%" class="table">
				<thead class="thead-dark"><tr align="center"><th>ID</th><th>PRODUCTO</th><th>CATEGORIA</th><th>WEB</th><th>FOTO</th><th>ANUNCIO</th><th>PRECIO ANUNCIO</th><th>PRECIO CORRECTO</th><th>PRECIO CHOLLO</th><th></th><th></th></tr></thead>
				<?php
					foreach ($info as $key)
					{
						$id_producto=$key['id_producto'];
						$nombre_producto=$key['nombre_producto'];
						$nombre_cat=$key['nombre_cat'];
						$nombre_web=$key['nombre_web'];
						$URLfoto=$key['URL_foto'];
						$URLanuncio=$key['URL_anuncio'];
						$precio_anuncio=$key['precio_anuncio'];
						$precio_correcto=$key['precio_correcto'];
						$precio_chollo=$key['precio_chollo'];
						$id_categoria=$key['id_cat'];
						$id_web=$key['id_web'];


						$p_id=$id_producto;	//Campo clave con el que distinguimos una pelicula univocamente
						if ($p_id==$p_edit_it) { //Editamos directamente en la fila: ?>
							<form id="form_update" name="form_update" method="post" action="controller.php?op=2">
							<input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>"/>
							<tr align="center" style="width: auto" valign="top">
								<td><?php echo $id_producto; ?></td>
								<td><input style="width: 100" type="text" name="producto" value="<?php echo $nombre_producto; ?>"/></td>
								<td >
									<?php  
									$obj = new CCategorias();
									$lista=$obj->Listar();
									?>
									<select name="categoria">
										<?php foreach ($lista as $value)
										{
											$idcat = $value["id_cat"];
											$nombrecat = $value["nombre_cat"];
											if ($idcat==$id_categoria) 
												echo "<option value='$idcat' selected=''>$nombrecat</option>";
											else
												echo "<option value='$idcat'>$nombrecat</option>";
										}
										?>
									</select>
								</td>
								<td>
									<?php  
									$obj = new CWebs();
									$lista=$obj->Listar();
									?>
									<select name="web">
										<?php foreach ($lista as $value)
										{
											$idweb = $value["id_webs"];
											$nombreweb = $value["nombre_web"];
											if ($idweb==$id_web)
												echo "<option value='$idweb' selected=''>$nombreweb</option>";
											else
												echo "<option value='$idweb'>$nombreweb</option>";
										}
										?>
									</select>
								</td>
								<td><input style="width: 100" type="text" name="URLfoto" value="<?php echo $URLfoto; ?>"/></td>
								<td><input style="width: 100" type="text" name="URLanuncio" value="<?php echo $URLanuncio; ?>"/></td>
								<td><input style="width: 50" type="text" name="precio_anuncio" value="<?php echo $precio_anuncio; ?>"/></td>
								<td><input style="width: 50" type="text" name="precio_correcto" value="<?php echo $precio_correcto; ?>"/></td>
								<td><input style="width: 50" type="text" name="precio_chollo" value="<?php echo $precio_chollo; ?>"/></td>
								<td><a href="#" onclick="document.form_update.submit();" border="0"><img src="../../images/ic_save.png" width="24"/></a></td>
								<td><a href="anuncios_view.php" border="0"><img src="../../images/ic_cancel.png" width="24"/></a></td>						
							</tr>
							</form>
						<?php
						}
						else
						{ 
					?>
					<tr align="center">
						<td><?php echo $id_producto; ?></td>
						<td><?php echo $nombre_producto; ?></td>
						<td><?php echo $nombre_cat; ?></td>
						<td><?php echo $nombre_web; ?></td>
						<td><img width="100" src="<?php echo $URLfoto ?>"></td>
						<td><a href="<?php echo $URLanuncio; ?>" target=”_blank”>Enlace</a></td>
						<td><?php echo $precio_anuncio.' €'; ?></td>
						<td><?php echo $precio_correcto.' €'; ?></td>
						<td><?php echo $precio_chollo.' €'; ?></td>
						<td width="1%"><a href="anuncios_view.php?id=<?php echo $id_producto; ?>" border="0"><img src="../../images/ic_edit.png" width="24"/></a></td>
						<td width="1%"><a href="controller.php?op=3&id=<?php echo $id_producto; ?>" border="0"><img src="../../images/ic_delete.png" width="24"/></a></td>
					</tr>
					<?php
						} //If
					} //For
					?>
			</table>
			<!-- Paginación -->
		<?php //Comprobamos si hay que paginar:
		if ($num_items>$tam_pag) {
			?>
			<div style="width:20%; margin: auto; margin-bottom: 40px">
				<?php for ($p=1;$p<=$num_pags;$p++) { 
					if ($p==$pag_act) {
						echo "<span style='margin:2px;'>$p</span>";
					} else {
							//Formato link:
						echo "<span style='margin:2px;'>
						<a href='anuncios_view.php?pag=$p'>$p</a>
						</span>";
					}

				} ?>
			</div>
			<?php } ?>
</div>
<?php require "../footer.php" ?>