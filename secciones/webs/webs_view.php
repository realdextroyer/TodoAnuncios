<?php require "../header.php" ?>
<div align="center">
	<h3>WEBS</h3>
	<div align="center">
		<div style="margin: 20px;overflow: hidden; width: 30%" class="border">
		<p>Insertar un nueva web:</p>
		<form name="form_insert" method="post" action="web_ctrl.php?op=1">
				<input type="text" name="web" size="30" placeholder="Nombre Web" required>
				<input class="btn btn-primary btn-sm" type="submit" value="Añadir"/>
		</form>
		</div>
		<?php 
		if (isset($_GET["msg"])) { ?>
			<div style="color:red">
				<?php echo $_GET["msg"];?>
			</div>
		<?php } ?>
		<h4>Lista de Webs</h4>
		<?php 
		include "../../model/cwebs.php";
		//Comprobamos si se quiere editar una película:
		$p_edit_it = 0;
		if (isset($_GET["id"])) {
			$p_edit_it = $_GET["id"];
		}
		$obj = new CWebs();
		//Para la paginación:
		$tam_pag=6;
		$num_items = $obj->TotalWebs();
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
					$id_webs=$key['id_webs'];
					$nombre_web=$key['nombre_web'];
					$p_id=$id_webs;	//Campo clave con el que distinguimos una pelicula univocamente
						if ($p_id==$p_edit_it)
							{ //Editamos directamente en la fila: 
				?>
							<form id="form_update" name="form_update" method="post" action="web_ctrl.php?op=2">
							<input type="hidden" name="id_web" value="<?php echo $id_webs; ?>"/>
							<tr valign="top">
								<td><?php echo $id_webs; ?></td>
								<td width="10%"><input type="text" name="nombre_web" value="<?php echo $nombre_web; ?>"/></td>
							
								<td width="1%"><a href="#" onclick="document.form_update.submit();" border="0"><img src="../../images/ic_save.png" width="24"/></a></td>
								<td width="1%"><a href="webs_view.php" border="0"><img src="../../images/ic_cancel.png" width="24"/></a></td>
							</tr>
							</form>
							<?php
							}
							else
							{
							?>
						<tr>
							<td><?php echo $id_webs; ?></td>
							<td><?php echo $nombre_web; ?></td>
							<td><a href="webs_view.php?id= <?php echo $id_webs; ?>" border="0"><img src="../../images/ic_edit.png" width="24"/></a></td>
							<td><a href="#" onclick="if(confirm('Realmente desea eliminar la web y los productos asociados a dicha web?')){
								document.location='web_ctrl.php?op=3&id=<?php echo $id_webs; ?>';}
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
						<a href='webs_view.php?pag=$p'>$p</a>
						</span>";
					}

				} ?>
			</div>
			<?php } ?>
		</div>
	</div>

	<?php require "../footer.php" ?>