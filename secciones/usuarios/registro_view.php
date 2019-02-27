<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../../css/css_intranet.css">
	<link href="../../css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="../../css/signin.css" rel="stylesheet">
</head>
<body class="text-center">	
			<form class="form-signin" name="validar" method="post" action="controller.php?op=2">
				<img class="mb-4" src="../../images/logo.jpg" alt="" width="72" height="72">
				<h1 class="h3 mb-3 font-weight-normal">Por favor, registrese</h1>
				<?php if (isset($_GET["msg"])) { ?>
					<div class="alert alert-danger"><?php echo $_GET["msg"]; ?>
					</div>
				<?php }	?>	
					<label class="sr-only">Usuario</label>
  					<input type="text" name="nombre" class="form-control" placeholder="Usuario" required autofocus>
  					<label for="inputEmail" class="sr-only">Correo Electrónico</label>
  					<input type="email" name="mail" class="form-control" placeholder="Correo Electrónico" required autofocus>
					<label for="inputPassword" class="sr-only">Password</label>
  					<input type="password" name="pass" class="form-control" placeholder="Password" required>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>				
				<h1 class="h5 mb-3 font-weight-normal">
					Ya tienes cuenta? <p><a href="login_view.php">Identificate</a></p>
				</h1>
		</form>
</body>
</html>