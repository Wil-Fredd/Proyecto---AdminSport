<?php  
	include_once("./../model/cliente.php");
	include_once("./../model/conexion.php");

	$CLIENTE = new Cliente();

	if (!isset($_GET['id_cliente'])) {
		exit();
	}

	$id = $_GET['id_cliente'];
	
	$query = "DELETE FROM clientes WHERE id_cliente =?";
	$resultado = $CLIENTE->CNX->prepare($query);
	$resultado->execute(array($id));

	header('Location: ./../vista/clientes.php');

?>