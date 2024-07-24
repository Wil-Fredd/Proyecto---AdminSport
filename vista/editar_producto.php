<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

    if($_SESSION['rol'] != 1) header('Location: ./../vista/error.php');

    include_once("./../model/producto.php");
    $id = $_GET['id'];
		
	$MODEL = new Producto();

    $k = $MODEL->cargar_id($id);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./../CSS/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/agregar_producto.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/oscuro.css?v=<?php echo time(); ?>" />
    <link rel="shortcut icon" href="./../img/icon_ac.png">
    <title>Actualizar zapato - AdminSport</title>
</head>
<body>
	<div class="contenido-form">
	<h2 id="titulo">EDITAR CALZADO</h2>
    <div class="boton-izquierda">
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
        </div>
		<form method="POST" action="">
			
			<div class="form">
            <input type="hidden" name="txtID" value="<?php echo $id = $_GET['id']; ?>"> 
            <p>Código del producto</p>  
            <input id="txtCodigo" name="txtCodigo" type="text" value="<?php echo $k->codigo; ?>" placeholder="Escribe el código del producto">
            <br><br>
            <p>Nombre o descripción del producto:</p>
            <input id="txtNombre" name="txtNombre" type="text" value="<?php echo $k->nombre;?>" placeholder="Ej. Jordan Retro 4">
            <br><br><br>
            <div class="frmPrecios">
                <p>Precio compra</p>
                <p>Precio venta</p>
                <p>Existencia</p>
            </div>
            <div class="inputPrecios">
                <input id="txtPrecio" name="txtPcompra" type="number" step="any" value="<?php echo $k->pcompra;?>" placeholder="Precio de compra">
                <input id="txtPrecio" name="txtPventa" type="number" step="any" value="<?php echo $k->pventa;?>" placeholder="Precio de venta">
                <input id="txtPrecio" name="txtExistencia" type="number" value="<?php echo $k->existencia;?>" placeholder="Existencia">
            </div>
            
            <div class="botones">
    			<input id="txtRegistrar" name="editar" type="submit" value="ACTUALIZAR">
    			<input id="txtCancelar" name="cancelar" type="submit" value="CANCELAR">
   			</div>
			   <?php 
        include_once("./../controlador/control_rutas.php"); ?>
		</form>
	</div>
    
	<script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	

</body>
</html>