<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

    if($_SESSION['rol'] != 1) header('Location: ./../vista/error.php');

    include_once("./../model/proveedor.php");
    
    if (isset($_GET['cod_proveedor']))
    {
        $id = $_GET['cod_proveedor'];
		
        $PROV = new Proveedor();
    
        $prov = $PROV->cargar_id($id);    
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../CSS/header.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/productos.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/oscuro.css?v=<?php echo time(); ?>"/>
    <link rel="shortcut icon" href="./../img/icon_prov.png">
    <title>Gestión de proveedores</title>
</head>
<body>
<header class="header">
        <nav>
           <ul class="nav-links">
                <li><a href="./../vista/productos.php">INVENTARIO</a></li>
                <li><a href="./../vista/proveedores.php"><span>PROVEEDORES</span></a></li>
                <li><a href="./../vista/clientes.php">CLIENTES</a></li>
                <li><a href="./../vista/ventas.php">VENTAS</a></li>
                <li><a href="./../vista/usuarios.php">USUARIOS</a></li>
                
           </ul>            
        </nav>
        <a class="btnSalir" href="./../controlador/cerrar.php"><img class="img" src="../img/salir_2.png" alt="Icono-Cerrar"></a>
    </header>
	<div class="contenido">
    <h2 id="titulo" class="titulo">CONTROL DE PROOVEDORES</h2>
        <div class="reportes">
            <a href="./../reportes/reporte_proveedores.php" id="PDF" target="_blank"><img src="./../img/pdf_icono.png" alt="icono-pdf" id="pdf_icono">GENERAR PDF</a>
            <a href="./../reportes/proveedor_excel.php" id="EXCEL" target="_blank"><img src="./../img/excel_icono_2.png" alt="icono-excel" id="excel_icono_2">GENERAR EXCEL</a>
            <input type="submit" class="oscuro" id="modo_oscuro" value="OSCURO/CLARO">
            
        </div>
		
        <div class="btnAgregar">
        <div class="boton-modal_2"><label for="btn-modal_2"><img src="./../img/anadir.png" alt="">Agregar</label></div><h1>Proveedor</h1>

        
	
        <input type="checkbox" name="" id="btn-modal_2">
        <div class="container-modal_2">
        <div class="content-modal_2">
            <form action="" method="post">
            <h3>Agregar proveedor</h3>
            <p>Proveedor</p>  
            <input id="txtNombre" name="txtNombre" type="text"  placeholder="Ingrese el nombre del proveedor">
            <br><br>
            <p>Contacto:</p>
            <input id="txtContacto" name="txtContacto" type="text" placeholder="Ingresa el nombre completo del contacto">
            <br><br>
            <p>Número telefónico:</p>
            <input id="txtTelefono" name="txtTelefono" type="text" placeholder="Ej. 04245599462">
            <br><br>
            <p>Dirección:</p>
            <input id="txtDireccion" name="txtDireccion" type="text" placeholder="Ingrese la dirección completa">
            <br><br>
                <div class="btn-cerrar">
                <input id="btn-registrar" name="registrar_prov" type="submit" value="REGISTRAR">
                    <label for="btn-modal_2">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal_2" class="cerrar-modal_2"></label>
            </div>
        </div>
            <?php include_once("./../controlador/control_prov.php"); ?>
    
            </form>
        </div>
		<form action="" method="post">
        <div class="buscador">
            <input class="inputTxt" name="busqueda" type="text" placeholder="Escribe el código del proveedor que deseas buscar">
            <input id="buscador" value="Buscar" name="enviar_prov" type="submit">
            <input id="cancelar" value="Cancelar" name="cancelar_prov" type="submit">
        </div>
        </form>
			<?php 
            
            include_once("./../controlador/control_prov.php");
            
            $prov = new Control_Prov();
            
            if(isset($_POST['enviar_prov'])) $prov->buscar_productos();
            
            else $prov->mostrar_productos();

            ?>
   
	</div>
    
    <script type="text/javascript" src="./../js/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="./../js/funciones.js"></script>	
</body>
</html>