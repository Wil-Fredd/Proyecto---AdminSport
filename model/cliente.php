<?php 
	include_once("./../model/conexion.php");
    class Cliente
    {
		
		public $CNX;
		public $id_cliente;
        public $cedula;
		public $nombre_cliente;
		public $telefono;
		public $direccion;

		public function __construct()
        {
			try {
				$this->CNX = conexion::conectar();
			} catch (Exception $e){
				die($e->getMessage());
			}
		}

		public function registrar($data)
		{
			try{
				$query = "INSERT INTO clientes (cedula,nombre_cliente,telefono,direccion) VALUES (?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre_cliente,$data->telefono,$data->direccion));
			} catch (Exception $e){
				die($e->getMessage());
			}
		
		}

		public function listar(){
				try{
					$query= "SELECT `id_cliente`, `cedula`, `nombre_cliente`, `telefono`, `direccion` FROM `clientes` WHERE 1";
					$resultado = $this->CNX->prepare($query);
					$resultado->execute();
					return $resultado->fetchAll(PDO::FETCH_OBJ);
				} catch (Exception $e){
					die ($e->getMessage());
				}
			}
        /*
			public function listar_id($data){
				try{
					$query= "SELECT `$data->id`, `codigo`, `nombre`, `pcompra`, `pventa`, `existencia` FROM `productos` WHERE 1";
					$resultado = $this->CNX->prepare($query);
					$resultado->execute();
					return $resultado->fetchAll(PDO::FETCH_OBJ);
				} catch (Exception $e){
					die ($e->getMessage());
				}
			}

		public function delete($id){
				try{
					$query = "DELETE FROM proveedores WHERE cod_proveedor = ?";
					$resultado = $this->CNX->prepare($query);
					$resultado->execute(array($id));
					} catch (Exception $e){
						die($e->getMessage());
					}
				
			}
		
		*/
		public function cargar_id($id){
				try{
					$query= "SELECT * FROM clientes WHERE id_cliente=?";
					$resultado = $this->CNX->prepare($query);
					$resultado->execute(array($id));
					return $resultado->fetch(PDO::FETCH_OBJ);
				} catch (Exception $e){
					die ($e->getMessage());
				}
			}

		public function actualizar($data){
			try{
			$query = "UPDATE clientes set cedula = ?, nombre_cliente = ?, telefono = ?, direccion = ? WHERE id_cliente = ?;";
			$this->CNX->prepare($query)->execute(array($data->cedula,$data->nombre_cliente,$data->telefono,$data->direccion,$data->id_cliente));
		} catch (Exception $e){
			die($e->getMessage());
		}
			}

		public function obtener_cliente()
        {				
            $query = "SELECT * FROM clientes ORDER BY id_cliente";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute();
			$data = $resultado->fetchAll();
			foreach ($data as $valores):
                ?> <option value="<?php echo $valores["id_cliente"];?>"> <?php echo $valores["cedula"];?>  </option>
				<?php 
                endforeach;
				
        }

		/*public function obtener_nombre_cliente($id)
        {				
            $query = "SELECT * FROM clientes ORDER BY id_cliente";
			$resultado = $this->CNX->prepare($query);
			$resultado->execute();
			$data = $resultado->fetchAll();
			foreach ($data as $valores):

				 $nombre_cliente = $valores['nombre'];
                endforeach;
				?> <input type="text" id="txtNombre" value="<?php echo $nombre_cliente?>"><?php
        }*/
	}

?>