<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/login.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/oscuro.css?v=<?php echo time(); ?>"/>
    <link rel="shortcut icon" href="./../img/icon_log.png">
    <title>Iniciar sesión - AdminSport</title>
</head>
<body>
    <header>
      
    </header>
  <div class="contenido">
    <div class="login-form">
      
      <img src="./../img/logo.jpeg" class="avatar" alt="Logo">
      <h4>ADMINSPORT</h4>
      <h1>Iniciar sesión</h1>
      <form method="POST" action="">
      <label for="username">Usuario</label>
			<input type="text" id="txtUsu" name="txtUsu" placeholder="Ingrese su usuario">     
      <label for="password">Contraseña</label>
      <input type="password" id="txtPass" name="txtPass" placeholder="Ingrese su contraseña">

			<input type="submit" name="iniciar" class="button" value="Iniciar sesión" >
			<?php include("./../controlador/control_rutas.php"); ?>
		</form> 
    <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
      </div>
      
    </div>
    <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	
</body>
</html>