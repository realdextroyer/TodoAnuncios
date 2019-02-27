<?php require "../header.php" ?>
<div class="container">
	<div class="row" align="center">
		<div class="col-4"></div>
		<div class="col-4">
			<h1 class="h3 mb-3 font-weight-normal">MI PERFIL</h1>
			<?php //Cargamos los datos del usuario actual:
			//Obtenemos de la session el id de usuario
			require "../../model/cusuarios.php";
			$obj = new CUsuarios();
			$obj->Cargar($_SESSION["us_id"]);
			//Mostramos un formulario para editar los datos actuales:
			?>
			<form name="form_editar" method="post" action="controller.php?op=3">
				<input class="form-control" type="hidden" name="id" value="<?php echo $obj->getID();?>"/>
				<h1 class="h6 mb-3 font-weight-normal">Tu nombre:</h1>
				<input class="form-control" style="text-align: center" type="text" name="nombre" value="<?php echo $obj->getNombre();?>" disabled><br/>
				<h1 class="h6 mb-3 font-weight-normal">Tu email:</h1>
				<input class="form-control" style="text-align: center" type="text" name="mail" value="<?php echo $obj->getMail();?>" disabled><br/>
				<h1 class="h5 mb-3 font-weight-normal">Modificar password:</h1>
				<?php if (isset($_GET["msg"])) { ?>
				<div class="alert alert-danger"><?php echo $_GET["msg"]; ?></div>
			<?php }	?>
				<input style="text-align: center" class="form-control" type="password" name="pass_old" placeholder="Password actual"><br/>
				<input style="text-align: center" class="form-control" type="password" name="pass_new" placeholder="Nuevo password"><br/>
				<p><input style="margin: 5PX" class="btn btn-primary" type="submit" value="Cambiar Password"></p>
			</form>
		</div>
		<div class="col-4"></div>
	</div>
</div>


<?php require "../footer.php" ?>