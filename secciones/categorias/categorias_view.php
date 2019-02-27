<?php require "../header.php" ?>
<div>
	<h2 align="center">CATEGORIAS</h2>
	<div align="center">
		<div style="margin: 20px;overflow: hidden; width: 30%" class="border">
			<p>Insertar un nuevo categoria:</p>
			<form class="form-group" name="form_insert" method="post" action="categoria_ctrl.php?op=1">
					<input type="text" name="categoria" size="30" placeholder="Nombre categoria" required>
					<input class="btn btn-primary btn-sm" type="submit" value="Añadir"/>
		</div>
		</form>
		<?php 
		if (isset($_GET["msg"])) { ?>
			<div style="color:red">
				<?php echo $_GET["msg"];?>
			</div>
		<?php } ?>
		<h4>Lista de categorias</h4>
		<?php 
		include "../../model/ccategorias.php";
		//Comprobamos si se quiere editar una película:
		$p_edit_it = 0;
		if (isset($_GET["id"])) {
			$p_edit_it = $_GET["id"];
		}
		$obj = new CCategorias();
		//Para la paginación:
		$tam_pag=6;
		$num_items = $obj->TotalCategorias();
		//Comprobamos si hay que paginar:
		if ($num_items>$tam_pag) {
			//Obtenemos de la url en que página estoy:
			if (isset($_GET["pag"])) {
				$pag_act = $_GET["pag"];
			} else {
				$pag_act=1;
			}
			//Calculamos cuantas páginas hay:
			$num_pags = ceil($num_items / $tam_pag);
			//Según la página en la que estamos cargarmos las pelis:
			$inicio = ($pag_act-1)*$tam_pag;
		} else {
			$inicio=0;
		}
		$info = $obj->ListarPaginado($inicio, $tam_pag);
		?>

			<table align="center" width="30%" class="table">
				<thead class="thead-dark"><tr><th width="1%">ID</th><th>NOMBRE</th><th width="1%"></th><th width="1%"></th></tr></thead>
				<?php
					foreach ($info as $key)
					{
						$id_cat=$key['id_cat'];
						$nombre_cat=$key['nombre_cat'];
						$p_id=$id_cat;	//Campo clave con el que distinguimos una pelicula univocamente
					if ($p_id==$p_edit_it) { //Editamos directamente en la fila: ?>
						<form id="form_update" name="form_update" method="post" action="categoria_ctrl.php?op=2">
						<input type="hidden" name="id_categoria" value="<?php echo $id_cat; ?>"/>
						<tr valign="top">
							<td><?php echo $id_cat; ?></td>
							<td width="10%"><input type="text" name="nombre_categoria" value="<?php echo $nombre_cat; ?>"/></td>
						
							<td width="1%"><a href="#" onclick="document.form_update.submit();" border="0"><img src="../../images/ic_save.png" width="24"/></a></td>
							<td width="1%"><a href="categorias_view.php" border="0"><img src="../../images/ic_cancel.png" width="24"/></a></td>
						</tr>
						</form>
					<?php } else { ?>
					<tr>
						<td><?php echo $id_cat; ?></td>
						<td><?php echo $nombre_cat; ?></td>
						<td><a href="categorias_view.php?id=<?php echo $id_cat; ?>" border="0"><img src="../../images/ic_edit.png" width="24"/></a></td>
						<td><a href="#" onclick="if(confirm('Realmente desea eliminar la categoria y los productos asociados a dicha categoria?')){
						document.location='categoria_ctrl.php?op=3&id=<?php echo $id_cat; ?>';}
						else{ alert('Operacion Cancelada');
						}" border="0"><img src="../../images/ic_delete.png" width="24"/></a></td>
					</tr>
					<?php } //If
				} //For?>
			</table>

		<!-- Paginación -->
		<?php //Comprobamos si hay que paginar:
		if ($num_items>$tam_pag) {
			?>
			<div style="width:20%; margin: auto;">
				<?php for ($p=1;$p<=$num_pags;$p++) { 
					if ($p==$pag_act) {
						echo "<span style='margin:2px;'>$p</span>";
					} else {
							//Formato link:
						echo "<span style='margin:2px;'>
						<a href='categorias_view.php?pag=$p'>$p</a>
						</span>";
					}

				} ?>
			</div>
			<?php } ?>
	</div>
</div>

	<?php require "../footer.php" ?>