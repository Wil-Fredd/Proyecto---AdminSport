<?php include_once ("./../model/conexion.php");

class Usuario
{
	public $CNX;
	public $id_usuario;
	public $nombre;
	public $contraseña;
	public $rol;

	public function __construct()
	{
		try {
			$this->CNX = conexion::conectar();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function iniciar($usuario)
	{
		$sentencia = $this->CNX->prepare('SELECT * FROM t_usuario WHERE nombre_usu = ? AND password_usu = ?;');
		$sentencia->execute([$usuario->nombre, $usuario->contraseña]);
		$datos = $sentencia->fetch(PDO::FETCH_OBJ);

		if ($datos === FALSE) {
			echo '<div class="error"><h4>Usuario y/o contraseña incorrecto.</h4></div>';
		} elseif ($sentencia->rowCount() == 1) {
			session_start();
			$_SESSION['nombre'] = $datos->nombre_usu;
			$_SESSION['rol'] = $datos->rol;
			if ($_SESSION['rol'] != 1)
				header('Location: ./../vista/ventas.php');
			else
				header('Location: ./../vista/productos.php');
		}
	}
	public function registrar($data)
	{
		try {
			$query = "INSERT INTO t_usuario (nombre_usu,password_usu,rol) VALUES (?,?,?)";
			$this->CNX->prepare($query)->execute(array($data->nombre, $data->contraseña, $data->rol));
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}


	public function listar()
	{
		try {
			$query = "SELECT * FROM t_usuario WHERE 1";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute();
			return $resultado->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function cargar_id($id)
	{
		try {
			$query = "SELECT * FROM t_usuario WHERE id_usuario=?";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute(array($id));
			return $resultado->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function actualizar($data)
	{
		try {
			$query = "UPDATE t_usuario set nombre_usu = ?, password_usu = ?, rol = ? WHERE id_usuario = ?;";
			$this->CNX->prepare($query)->execute(array($data->nombre, $data->contraseña, $data->rol, $data->id_usuario));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}

?>