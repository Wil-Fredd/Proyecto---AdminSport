<?php  
	include_once("./../model/venta.php");
	include_once("./../model/conexion.php");

	$MODEL = new Venta();

	if (!isset($_GET['id_factura'])) {
		exit();
	}

	$id = $_GET['id_factura'];
	
	$query = "DELETE FROM factura WHERE id_factura =?";
	$resultado = $MODEL->CNX->prepare($query);
	$resultado->execute(array($id));

	header('Location: ./../vista/ventas.php');

?>