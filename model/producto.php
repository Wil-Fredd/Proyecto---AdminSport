<?php
include_once ("./../model/conexion.php");
class Producto
{

	public $CNX;
	public $id;
	public $codigo;
	public $nombre;
	public $pcompra;
	public $pventa;
	public $existencia;
	public $cod_proveedor;

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
			$query = "INSERT INTO productos (codigo,nombre,pcompra,pventa,existencia, cod_proveedor) VALUES (?,?,?,?,?,?)";
			$this->CNX->prepare($query)->execute(array($data->codigo, $data->nombre, $data->pcompra, $data->pventa, $data->existencia, $data->cod_proveedor));
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function listar()
	{
		try {
			$query = "SELECT * FROM productos p1 INNER JOIN proveedores p2 ON p1.cod_proveedor = p2.cod_proveedor";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute();
			return $resultado->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function listar_id($data)
	{
		try {
			$query = "SELECT `$data->id`, `codigo`, `nombre`, `pcompra`, `pventa`, `existencia` FROM `productos` WHERE 1";
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
			$query = "Delete from productos where id =?";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function cargar_id($id)
	{
		try {
			$query = "SELECT * from productos where id=?";
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
			$query = "UPDATE productos set codigo = ?, nombre = ?, pcompra = ?, pventa = ?, existencia = ? WHERE id = ?;";
			$this->CNX->prepare($query)->execute(array($data->codigo, $data->nombre, $data->pcompra, $data->pventa, $data->existencia, $data->id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function obtener_proveedor()
	{
		$query = "SELECT * FROM proveedores ORDER BY cod_proveedor";
		$resultado = $this->CNX->prepare($query);
		$resultado->execute();
		$data = $resultado->fetchAll();
		foreach ($data as $valores):
			?>
			<option value="<?php echo $valores["cod_proveedor"]; ?>"> <?php echo $valores["proveedor"]; ?> </option> <?php
		endforeach;
	}

	public function obtener_proveedor_id()
	{
		$query = "SELECT * FROM proveedores ORDER BY cod_proveedor";
		$resultado = $this->CNX->prepare($query);
		$resultado->execute();
		$data = $resultado->fetchAll();
		foreach ($data as $valores):
			?>
			<option value="<?php echo $valores["cod_proveedor"]; ?>"> <?php echo $valores["proveedor"]; ?> </option> <?php
		endforeach;
	}

	public function obtener_producto()
	{
		$query = "SELECT * FROM productos ORDER BY id";
		$resultado = $this->CNX->prepare($query);
		$resultado->execute();
		$data = $resultado->fetchAll();
		foreach ($data as $valores):
			?>
			<option value="<?php echo $valores["id"]; ?>"> <?php echo $valores["codigo"]; ?> </option>
			<?php
		endforeach;
	}
}

?>