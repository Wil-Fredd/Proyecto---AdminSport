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
    <link rel="shortcut icon" href="./../img/icon_cli.png">
    
    <title>Gestión de clientes</title>
</head>
<body>
    <header class="header">
        <nav>
           <ul class="nav-links">
                <li><a href="./../vista/productos.php">INVENTARIO</a></li>
                <li><a href="./../vista/proveedores.php">PROVEEDORES</a></li>
                <li><a href="./../vista/clientes.php"><span>CLIENTES</span></a></li>
                <li><a href="./../vista/ventas.php">VENTAS</a></li>
                <li><a href="./../vista/usuarios.php">USUARIOS</a></li>
                
           </ul>            
        </nav>
        <a class="btnSalir" href="./../controlador/cerrar.php"><img class="img" src="../img/salir_2.png" alt="Icono-Cerrar"></a>
    </header>
	<div class="contenido">
    <h2 id="titulo" class="titulo">GESTIÓN DE CLIENTES</h2>
        <div class="reportes">
            <a href="./../reportes/reporte_clientes.php" id="PDF" target="_blank"><img src="./../img/pdf_icono.png" alt="icono-pdf" id="pdf_icono">GENERAR PDF</a>
            <a href="./../reportes/clientes_excel.php" id="EXCEL" target="_blank"><img src="./../img/excel_icono_2.png" alt="icono-excel" id="excel_icono_2">GENERAR EXCEL</a>
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
        </div>
        <div class="btnAgregar">
        <div class="boton-modal_2"><label for="btn-modal_2"><img src="./../img/anadir.png" alt="">Agregar</label></div><h1>Cliente</h1>
        <input type="checkbox" name="" id="btn-modal_2">
        <div class="container-modal_2">
        <div class="content-modal_2">
            <form action="" method="post">
                <div class="form-datos">
                    <h3>Agregar cliente</h3>
                <p>Cédula o RIF:</p>  
                <input id="txtCedula" name="txtCedula" type="text" placeholder="Ingrese la cédula o RIF del cliente">
                <br><br>
                <p>Nombre completo:</p>
                <input id="txtNombre" name="txtNombre" type="text" placeholder="Ingrese el nombre completo del cliente">
                <br><br>
                <p>Número telefónico:</p>
                <input id="txtTelefono" name="txtTelefono" type="text" placeholder="Ingrese el número teléfonico">
                <br><br>
                <p>Dirección:</p>
                <input id="txtDireccion" name="txtDireccion" type="text" placeholder="Ingrese la dirección completa">
                <br><br>
                </div>
            
                <div class="btn-cerrar">
                <input id="btn-registrar" name="registrar_cliente" type="submit" value="REGISTRAR">
                    <label for="btn-modal_2">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal_2" class="cerrar-modal_2"></label>
            </div>
        </div>
            <?php include_once("./../controlador/control_clientes.php"); ?>
    
            </form>
        </div>

		<form action="" method="post">
        <div class="buscador">
            <input class="inputTxt" name="busqueda" type="text" placeholder="Escribe la cédula del cliente que deseas buscar">
            <input id="buscador" value="Buscar" name="enviar" type="submit">
            <input id="cancelar" value="Cancelar" name="cancelar" type="submit">
        </div>
        </form>
			<?php 
            
            include_once("./../controlador/control_clientes.php");

            $control = new Control_Cliente();
        
            
            if(isset($_POST['enviar'])) $control->buscar_productos();
        
            else $control->mostrar_productos();
            
            ?>
	</div>
    
    <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	
</body>
</html>