<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');
    
    include_once("./../model/cliente.php");
    
    $id = $_GET['id_cliente'];
		
	$CLIENTE = new Cliente();

    $cliente = $CLIENTE->cargar_id($id);

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
    <title>Actualizar cliente - AdminSport</title>
</head>
<body>
		<div class="contenido-form">
    	<h2 id="titulo">ACTUALIZAR CLIENTE</h2>
        <div class="boton-izquierda">
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
        </div>
       
        <form action="" method="POST">
            
        <input type="hidden" name="txt_cliente" value="<?php echo $id = $_GET['id_cliente']; ?>"> 
            <div class="form">
            <p>Cédula</p>  
            <input id="txtNombre" name="txtCedula" type="text" value="<?php echo $cliente->cedula;?>" placeholder="Ingrese la cédula del cliente">
            <br><br>
            <p>Nombre:</p>
            <input id="txtContacto" name="txtNombre" type="text" value="<?php echo $cliente->nombre_cliente;?>" placeholder="Ingresa el nombre completo del cliente">
            <br><br>
            <p>Número telefónico:</p>
            <input id="txtTelefono" name="txtTelefono" type="text" value="<?php echo $cliente->telefono;?>" placeholder="Ingrese el número telefónico del cliente">
            <br><br>
            <p>Dirección:</p>
            <input id="txtDireccion" name="txtDireccion" type="text" value="<?php echo $cliente->direccion;?>" placeholder="Ingrese la dirección completa">
            <br><br>
            
            
            <div class="botones">

    <input id="txtRegistrar" name="editar_cliente" type="submit" value="ACTUALIZAR">
    <input id="txtCancelar" name="cancelar_cliente" type="submit" value="CANCELAR">
    
   </div>
   <?php include_once("./../controlador/control_clientes.php"); ?>
   
        </form>
    </div>

    <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	
</body>
</html>