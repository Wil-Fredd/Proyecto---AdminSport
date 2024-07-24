<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

    if($_SESSION['rol'] != 1) header('Location: ./../vista/error.php');
    
    include_once("./../model/proveedor.php");
    
    $id = $_GET['cod_proveedor'];
		
	$PROV = new Proveedor();

    $prov = $PROV->cargar_id($id);

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
    <title>Actualizar proveedor - AdminSport</title>
</head>
<body>

		<div class="contenido-form">
    	<h2 id="titulo">AGREGAR PROVEEDOR</h2>
        <div class="boton-izquierda">
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
        </div>
       
        <form action="" method="POST">
            
        <input type="hidden" name="txtCodigo" value="<?php echo $cod_proveedor = $_GET['cod_proveedor']; ?>"> 
            <div class="form">
            <p>Proveedor</p>  
            <input id="txtNombre" name="txtNombre" type="text" value="<?php echo $prov->proveedor;?>" placeholder="Ingrese el nombre del proveedor">
            <br><br>
            <p>Contacto:</p>
            <input id="txtContacto" name="txtContacto" type="text" value="<?php echo $prov->contacto;?>" placeholder="Ingresa el nombre completo del contacto">
            <br><br>
            <p>Número telefónico:</p>
            <input id="txtTelefono" name="txtTelefono" type="text" value="<?php echo $prov->telefono;?>" placeholder="Ej. 04245599462">
            <br><br>
            <p>Dirección:</p>
            <input id="txtDireccion" name="txtDireccion" type="text" value="<?php echo $prov->direccion;?>" placeholder="Ingrese la dirección completa">
            <br><br>
            
            
            <div class="botones">

    <input id="txtRegistrar" name="editar_prov" type="submit" value="ACTUALIZAR">
    <input id="txtCancelar" name="cancelar_prov" type="submit" value="CANCELAR">
    
   </div>
   <?php include_once("./../controlador/control_prov.php"); ?>
   
        </form>
    </div>

    <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	
</body>
</html>