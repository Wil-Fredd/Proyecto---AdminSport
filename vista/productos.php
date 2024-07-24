<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

    if($_SESSION['rol'] != 1) header('Location: ./../vista/error.php');
    

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
    <link rel="shortcut icon" href="./../img/icon_inv.png">
    <title>Gestión de inventario</title>
</head>
<body>
    <header class="header">
        <nav>
           <ul class="nav-links">
                <li><a href="./../vista/productos.php"><span>INVENTARIO</span></a></li>
                <li><a href="./../vista/proveedores.php">PROVEEDORES</a></li>
                <li><a href="./../vista/clientes.php">CLIENTES</a></li>
                <li><a href="./../vista/ventas.php">VENTAS</a></li>
                <li><a href="./../vista/usuarios.php">USUARIOS</a></li>
                
           </ul>            
        </nav>
        <a class="btnSalir" href="./../controlador/cerrar.php"><img class="img" src="../img/salir_2.png" alt="Icono-Cerrar"></a>
    </header>
	<div class="contenido">
    <h2 id="titulo" class="titulo">GESTIÓN DE INVENTARIO</h2>
        <div class="reportes">
            <a href="./../reportes/reporte_productos.php" id="PDF" target="_blank"><img src="./../img/pdf_icono.png" alt="icono-pdf" id="pdf_icono">GENERAR PDF</a>
            <a href="./../reportes/reporte_productos_excel.php" id="EXCEL" target="_blank"><img src="./../img/excel_icono_2.png" alt="icono-excel" id="excel_icono_2">GENERAR EXCEL</a>
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
            
        </div>
		
        <div class="btnAgregar">
        <div class="boton-modal_2"><label for="btn-modal_2"><img src="./../img/anadir.png" alt="">Agregar</label></div><h1>Zapato</h1>

        
	
        <input type="checkbox" name="" id="btn-modal_2">
        <div class="container-modal_2">
        <div class="content-modal_2">
            <form action="" method="post">
                <div class="form-datos">
                <p>Código del zapato</p>  
                <input id="txtCodigo" name="txtCodigo" type="text" placeholder="Escribe el código del zapato">
                <br><br>
                <p>Nombre o descripción del zapato:</p>
                <input id="txtNombre" name="txtNombre" type="text" placeholder="Ingrese el nombre o descripción del zapato">
                <br><br>
                <p>Precio compra</p>
                <input id="txtPrecio" name="txtPcompra" type="number" step="any" placeholder="Precio de compra">
                <br><br>
                <p>Precio venta</p>
                <input id="txtPrecio" name="txtPventa" type="number" step="any" placeholder="Precio de venta">
                <br><br>
                <p>Existencia</p>
                <input id="txtPrecio" name="txtExistencia" type="number" placeholder="Existencia">
                <br><br>
                <p>Proveedor</p>
                <?php 
                
               include_once("./../controlador/control_productos.php");
               $CONTROL = new Control;
               $CONTROL->mostrar_proveedores();
                ?>

                </div>
            
                <div class="btn-cerrar">
                <input id="btn-registrar" name="registrar" type="submit" value="REGISTRAR">
                    <label for="btn-modal_2">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal_2" class="cerrar-modal_2"></label>
            </div>
        </div>
            <?php include_once("./../controlador/control_rutas.php"); ?>
    
            </form>
        </div>
        </div>
		<form action="" method="post">
        <div class="buscador">
            <input class="inputTxt" name="busqueda" type="text" placeholder="Escribe el código del producto que deseas buscar">
            <input id="buscador" value="Buscar" name="enviar" type="submit">
            <input id="cancelar" value="Cancelar" name="cancelar" type="submit">
        </div>
        </form>
			<?php 
            
            include_once("./../controlador/control_productos.php");

            $control = new Control();
        
            if(isset($_POST['enviar'])) $control->buscar_productos();
            
        
            else $control->mostrar_productos();
            
            ?>
            
            
            
        
	</div>
    
    <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	
</body>
</html>