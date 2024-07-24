<?php
include_once ("./../model/conexion.php");

class Venta
{

	public $CNX;
	public $fecha;
	public $id;
	public $existencia;
	public $id_usuario;
	public $id_cliente;
	public $id_producto;
	public $id_factura;
	public $cedula;
	public $cod_producto;
	public $nombre_cliente;
	public $nombre_producto;
	public $precio;
	public $cantidad;
	public $total;

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
			$query = "INSERT INTO factura (fecha,id_usuario,id_cliente,id, precio, cantidad, totalfactura) VALUES (?,?,?,?,?,?,?)";
			$this->CNX->prepare($query)->execute(array($data->fecha, $data->id_usuario, $data->id_cliente, $data->id_producto, $data->precio, $data->cantidad, $data->total));
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function venta($data)
	{
		$ventas = new Venta();
		$venta = new Venta();
		$usuario = $_SESSION['nombre'];

		$fecha = date("d-m-Y");
		// CARGAR TODOS LOS DATOS QUE SE SELECIONEN POR ID
		$x = $ventas->cargar_id_cliente($data->id_cliente);
		$y = $ventas->cargar_id_producto($data->cod_producto);
		$z = $ventas->cargar_id_usuario($usuario);
		// GUARDAR LOS DATOS DEL CLIENTE Y DEL PRODUCTO
		$venta->fecha = $fecha;
		$venta->id_usuario = $z->id_usuario;
		$venta->id_cliente = $data->id_cliente;
		$venta->id_producto = $y->id;
		$venta->precio = $data->precio;
		$venta->cantidad = $data->cantidad;
		$venta->total = $data->total;

		// RESTAR LA CANTIDAD - LA EXISTENCIA DEL PRODUCTO 
		$y->existencia = $y->existencia - $data->cantidad;

		$ventas->registrar($venta);

	}


	public function editar_venta($data)
	{
		$ventas = new Venta();
		$venta = new Venta();
		$usuario = $_SESSION['nombre'];

		$fecha = date("d-m-Y");
		// CARGAR TODOS LOS DATOS QUE SE SELECIONEN POR ID
		$x = $ventas->cargar_id_cliente($data->id_cliente);
		$y = $ventas->cargar_id_producto($data->cod_producto);
		$z = $ventas->cargar_id_usuario($usuario);
		// GUARDAR LOS DATOS DEL CLIENTE Y DEL PRODUCTO
		$venta->fecha = $fecha;
		$venta->id_usuario = $z->id_usuario;
		$venta->id_cliente = $data->id_cliente;
		$venta->id_producto = $y->id;
		$venta->precio = $data->precio;
		$venta->cantidad = $data->cantidad;
		$venta->total = $data->total;
		$venta->id_factura = $_POST['txtID'];

		$ventas->actualizar($venta);

	}



	public function listar()
	{
		try {
			//$query= "SELECT * FROM productos p1 INNER JOIN proveedores p2 ON p1.cod_proveedor = p2.cod_proveedor";
			$query = "SELECT * FROM factura f1 INNER JOIN t_usuario u1 ON f1.id_usuario = u1.id_usuario INNER JOIN clientes c1 ON f1.id_cliente = c1.id_cliente
                INNER JOIN productos p1 ON f1.id = p1.id";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute();
			return $resultado->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function cargar_id_cliente($id)
	{
		try {
			$query = "SELECT * FROM clientes WHERE id_cliente=?";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute(array($id));
			return $resultado->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function cargar_id_producto($id)
	{
		try {
			$query = "SELECT * FROM productos WHERE id=?";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute(array($id));
			return $resultado->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function cargar_id_usuario($id)
	{
		try {
			$query = "SELECT * FROM t_usuario WHERE nombre_usu=?";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute(array($id));
			return $resultado->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function cargar_id($id)
	{
		try {
			$query = "SELECT * FROM factura f1 INNER JOIN t_usuario u1 ON f1.id_usuario = u1.id_usuario INNER JOIN clientes c1 ON f1.id_cliente = c1.id_cliente
					INNER JOIN productos p1 ON f1.id = p1.id WHERE id_factura=?";
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
			$query = "UPDATE factura set fecha = ?, id_usuario = ?, id_cliente = ?, id = ?, precio = ?, cantidad = ?, totalfactura = ? WHERE id_factura = ?;";
			$this->CNX->prepare($query)->execute(array($data->fecha, $data->id_usuario, $data->id_cliente, $data->id_producto, $data->precio, $data->cantidad, $data->total, $data->id_factura));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}

?>