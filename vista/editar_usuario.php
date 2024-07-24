<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

    if($_SESSION['rol'] != 1) header('Location: ./../vista/error.php');
    
    include_once("./../model/usuario.php");
    
    $id = $_GET['id_usuario'];
		
	$USUARIO = new Usuario();

    $usuario = $USUARIO->cargar_id($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../CSS/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/agregar_producto.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/oscuro.css?v=<?php echo time(); ?>"/>
    <link rel="shortcut icon" href="./../img/icon_ac.png">
    <title>Actualizar usuario - AdminSport</title>
</head>
<body>
		<div class="contenido-form">
    	<h2 id="titulo">AGREGAR PROVEEDOR</h2>
        <div class="boton-izquierda">
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
        </div>
       
        <form action="" method="POST">
            
        <input type="hidden" name="txtID" value="<?php echo $id = $_GET['id_usuario']; ?>"> 
            <div class="form">
            <p>Nombre de usuario:</p>  
            <input id="txtNombre" name="txtNombre" type="text" value="<?php echo $usuario->nombre_usu;?>" placeholder="Ingrese el nombre del usuario">
            <br><br>
            <p>Contraseña:</p>
            <input id="txtContacto" name="txtContraseña" type="text" value="<?php echo $usuario->password_usu;?>" placeholder="Ingrese la contraseña">
            <br><br>
            <p>Rol:</p>
            <select name="roles" id="productos">
                    <option value=""></option>
                    <option value="1">Administrador</option>
                    <option value="0">Vendedor</option>
                </select>
            
            <div class="botones">

    <input id="txtRegistrar" name="editar_usuario" type="submit" value="ACTUALIZAR">
    <input id="txtCancelar" name="cancelar_usuario" type="submit" value="CANCELAR">
    
   </div>
   <?php include_once("./../controlador/control_usuarios.php"); ?>
   
        </form>
    </div>

    <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	
</body>
</html>