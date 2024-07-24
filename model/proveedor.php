<?php
include_once ("./../model/conexion.php");
class Proveedor
{

	public $CNX;
	public $cod_proveedor;
	public $nombre;
	public $contacto;
	public $telefono;
	public $direccion;

	public function __construct()
	{
		try {
			$this->CNX = conexion::conectar();
		} catch (Exception $e) {
			die($e->getMessage());
		}


	}

	public function registrar($data)
	{
		try {
			$query = "INSERT INTO proveedores (proveedor,contacto,telefono,direccion) VALUES (?,?,?,?)";
			$this->CNX->prepare($query)->execute(array($data->nombre, $data->contacto, $data->telefono, $data->direccion));
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function listar()
	{
		try {
			$query = "SELECT `cod_proveedor`, `proveedor`, `contacto`, `telefono`, `direccion` FROM `proveedores` WHERE 1";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute();
			return $resultado->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function delete($id)
	{
		try {
			$query = "DELETE FROM proveedores WHERE cod_proveedor = ?";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}


	public function cargar_id($id)
	{
		try {
			$query = "SELECT * FROM proveedores WHERE cod_proveedor=?";
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
			$query = "UPDATE proveedores set proveedor = ?, contacto = ?, telefono = ?, direccion = ? WHERE cod_proveedor = ?;";
			$this->CNX->prepare($query)->execute(array($data->nombre, $data->contacto, $data->telefono, $data->direccion, $data->cod_proveedor));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}

?>