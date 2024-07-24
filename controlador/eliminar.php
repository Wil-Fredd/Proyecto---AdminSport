<?php  
	include_once("./../model/producto.php");
	include_once("./../model/conexion.php");

	$MODEL = new Producto();

	if (!isset($_GET['id'])) {
		exit();
	}

	$id = $_GET['id'];
	
	$query = "DELETE FROM productos WHERE id =?";
	$resultado = $MODEL->CNX->prepare($query);
	$resultado->execute(array($id));

	header('Location: ./../vista/productos.php');

?>