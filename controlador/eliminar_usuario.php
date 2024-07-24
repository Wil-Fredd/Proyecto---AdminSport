<?php  
	include_once("./../model/usuario.php");
	include_once("./../model/conexion.php");

	$USUARIO = new Usuario();

	if (!isset($_GET['id_usuario'])) {
		exit();
	}

	$id = $_GET['id_usuario'];
	
	$query = "DELETE FROM t_usuario WHERE id_usuario =?";
	$resultado = $USUARIO->CNX->prepare($query);
	$resultado->execute(array($id));

	header('Location: ./../vista/usuarios.php');

?>