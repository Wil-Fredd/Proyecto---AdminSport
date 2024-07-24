<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../CSS/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/productos.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/oscuro.css?v=<?php echo time(); ?>"/>
    <link rel="shortcut icon" href="./../img/icon_venta.png">
    <title>Gestión de ventas</title>
</head>
<body>
    <header class="header">
        <nav>
           <ul class="nav-links">
                <li><a href="./../vista/productos.php">INVENTARIO</a></li>
                <li><a href="./../vista/proveedores.php">PROVEEDORES</a></li>
                <li><a href="./../vista/clientes.php">CLIENTES</a></li>
                <li><a href="./../vista/ventas.php"><span>VENTAS</span></a></li>
                <li><a href="./../vista/usuarios.php">USUARIOS</a></li>
                
           </ul>            
        </nav>
        <a class="btnSalir" href="./../controlador/cerrar.php"><img class="img" src="../img/salir_2.png" alt="Icono-Cerrar"></a>
    </header>
	<div class="contenido">
    <h2 id="titulo" class="titulo">GESTIÓN DE VENTAS</h2>
        <div class="reportes">
            <a href="./../reportes/reporte_ventas.php" id="PDF" target="_blank"><img src="./../img/pdf_icono.png" alt="icono-pdf" id="pdf_icono">GENERAR PDF</a>
            <a href="./../reportes/ventas_excel.php" id="EXCEL" target="_blank"><img src="./../img/excel_icono_2.png" alt="icono-excel" id="excel_icono_2">GENERAR EXCEL</a>
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
            
        </div>
		
        <div class="btnAgregar">
        <div class="boton-modal_2"><label for="btn-modal_2"><img src="./../img/anadir.png" alt="">Agregar</label></div><h1>Venta</h1>

        <input type="checkbox" name="" id="btn-modal_2">
        <div class="container-modal_2">
        <div class="content-modal_2">
            <form action="" method="post">
                <div class="form-datos">
                <h3>Agregar venta</h3>
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
                <input id="txtPrecio" name="txtPrecio" type="number" placeholder="Precio">
                <p>Cantidad</p>
                <input id="txtCantidad" name="txtExistencia" type="number" placeholder="Cantidad">
                <br><br>
                <p>Total:</p>
                <input id="txtTotal" name="txtTotal" type="number" placeholder="Total" readonly>
                <br><br>
                </div>
            
                <div class="btn-cerrar">
                <input id="btn-registrar" name="registrar_venta" type="submit" value="REGISTRAR">
                    <label for="btn-modal_2">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal_2" class="cerrar-modal_2"></label>
            </div>
        </div>
            <?php include_once("./../controlador/control_ventas.php"); ?>
    
            </form>
        </div>
        </div>
		<form action="" method="post">
        <div class="buscador">
            <input class="inputTxt" name="busqueda" type="text" placeholder="Escribe el nombre del cliente o del usuario que deseas buscar">
            <input id="buscador" value="Buscar" name="enviar" type="submit">
            <input id="cancelar" value="Cancelar" name="cancelar" type="submit">
        </div>
        </form>
			<?php 
            
            include_once("./../controlador/control_ventas.php");

            $control = new Control_Venta();
        
            if(isset($_POST['enviar'])) $control->buscar_ventas();
            
        
            else $control->mostrar_ventas();
            
            ?>
            
            
        <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	    <script type="text/javascript" src="./../js/funciones.js"></script>	
        
	</div>
    
  
</body>
</html>