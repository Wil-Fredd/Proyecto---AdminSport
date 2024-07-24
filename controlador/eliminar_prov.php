<?php 

    include_once("./../model/proveedor.php");
	include_once("./../model/conexion.php");

	$PROV = new Proveedor();

	if (!isset($_GET['cod_proveedor'])) {
		exit();
	}

	$id = $_GET['cod_proveedor'];
	
	$query = "DELETE FROM proveedores WHERE cod_proveedor =?";
	$resultado = $PROV->CNX->prepare($query);
	$resultado->execute(array($id));

	header('Location: ./../vista/proveedores.php');

?>