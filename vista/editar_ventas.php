<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

    include_once("./../model/venta.php");
    $id = $_GET['id_factura'];
		
	$MODEL = new Venta();

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
    <title>Actualizar venta - AdminSport</title>
</head>
<body>
	<div class="contenido-form">
	<h2 id="titulo">EDITAR CALZADO</h2>
    <div class="boton-izquierda">
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
        </div>
		<form method="POST" action="">
			
			<div class="form">
            <input type="hidden" name="txtID" value="<?php echo $id = $_GET['id_factura']; ?>"> 
            <p>Cédula del cliente:</p>
                <?php 
                
               include_once("./../controlador/control_clientes.php");
               $CONTROL = new Control_Cliente;
               $CONTROL->mostrar_clientes();
                ?>
                <br><br>

                <p>Código del zapato:</p>
                <?php 
                
               include_once("./../controlador/control_productos.php");
               $CONTROL = new Control;
               $CONTROL->mostrar_zapatos();
               
                ?>
                <br><br>
                <p>Precio</p>
                <input id="txtPrecio" name="txtPrecio" type="number" value="<?php echo $k->precio;?>" placeholder="Precio">
                <p>Cantidad</p>
                <input id="txtCantidad" name="txtExistencia" type="number" value="<?php echo $k->cantidad;?>" placeholder="Cantidad">
                <br><br>
                <p>Total:</p>
                <input id="txtTotal" name="txtTotal" type="number" placeholder="Total" readonly>
                <br><br>
            
            <div class="botones">
    			<input id="txtRegistrar" name="editar_venta" type="submit" value="ACTUALIZAR">
    			<input id="txtCancelar" name="cancelar_venta" type="submit" value="CANCELAR">
   			</div>
               <?php include_once("./../controlador/control_ventas.php"); ?>
		</form>
	</div>
    
	<script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	

</body>
</html>