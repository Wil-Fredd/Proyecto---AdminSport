<?php 

    
    include_once("./../model/cliente.php");

    $cliente = new Control_Cliente();

    if(isset($_POST['registrar_cliente']))
    {
            $cliente->guardar();
    }

    if(isset($_POST['editar_cliente']))
    {
        $cliente->editar();
    }

    if(isset($_POST['cancelar_cliente']))
    {
        header("Location:./../vista/clientes.php");
    }

    
    class Control_Cliente
    {
        
        public $CLIENTE;


        public function __construct()
        {
            $this->CLIENTE = new Cliente();
        }
        
        public function guardar()
        {
            if (trim($_POST['txtNombre']) === '' || trim($_POST['txtCedula']) === '' || trim($_POST['txtTelefono']) === '' || trim($_POST['txtDireccion']) === '') 
		    {
			    print '<div class="error"><h4>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h4></div>'; 
    		    return;
		    }
        else 
            {
            $cliente = new Cliente();
            $cliente->cedula = $_POST['txtCedula'];
            $cliente->nombre_cliente = $_POST['txtNombre'];
            $cliente->telefono = $_POST['txtTelefono'];
            $cliente->direccion = $_POST['txtDireccion'];
            
            $this->CLIENTE->registrar($cliente);

            print '<div class="correcto"><h4>¡Registro exitoso, recargue la página para ver los resultados!</h4></div>';
            }
        }
    

        /*public function eliminar()
        {
            $this->PROV->delete($_REQUEST['id']);
        }

        
        */
        public function editar()
        {

            if (trim($_POST['txtCedula']) === '' || trim($_POST['txtNombre']) === '' || trim($_POST['txtTelefono']) === '' || trim($_POST['txtDireccion']) === '') 
		    {
			    print '<div class="error"><h3>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h3></div>'; 
    		    return;
		    }
        else 
            {
            $cliente = new Cliente();
            $cliente->cedula = $_POST['txtCedula'];
            $cliente->nombre_cliente = $_POST['txtNombre'];
            $cliente->telefono = $_POST['txtTelefono'];
            $cliente->direccion = $_POST['txtDireccion'];

            $cliente->id_cliente = $_POST['txt_cliente'];
                
                $this->CLIENTE->actualizar($cliente);

                print '<div class="correcto"><h3>¡Registro actualizado, recargue la página para ver los resultados!</h3></div>';
             }
        }
        
        public function mostrar_productos()
        {
            ?><div class="tabla-productos">
    		<table>
                <thead>
            <tr>
				<td>ID</td>
				<td>Cédula</td>
				<td>Nombre</td>
				<td>Teléfono</td>
				<td>Dirección</td>
				<td>Actualizar</td>
				<td>Eliminar</td>
			</tr>
                </thead>
			
            <?php $CLIENTE = new Cliente();
			
				 foreach ($CLIENTE->listar() as $k):?> 
					<tr>
						<td><?php echo $k->id_cliente;?></td>
						<td><?php echo $k->cedula;?></td>
						<td><?php echo $k->nombre_cliente;?></td>
						<td><?php echo $k->telefono;?></td>
						<td><?php echo $k->direccion;?></td>
						<td><a  class="btnEditar" href="editar_cliente.php?id_cliente=<?php echo $k->id_cliente;?>">Actualizar</a></td>
                		<td><div class="boton-modal"><label for="btn-modal">Eliminar</label></div></td>
					</tr>
        <input type="checkbox" name="" id="btn-modal">
        <div class="container-modal">
            <div class="content-modal">
                <h3>¿Estás seguro que deseas eliminar este registro?</h3>
                <div class="btn-cerrar">

                <a class="btnEliminar" href="./../controlador/eliminar_cliente.php?id_cliente=<?php echo $k->id_cliente; ?>">Eliminar</a>
                    <label for="btn-modal">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal" class="cerrar-modal"></label>
        </div>
						
				<?php endforeach; 
            }
        
        public function buscar_productos()
        {
        
        $consulta = "SELECT * FROM clientes";
        
        $busqueda = null;
        if (isset($_POST["busqueda"]))
        {    
            $busqueda = $_POST["busqueda"];
            $consulta = "SELECT * FROM clientes WHERE cedula LIKE ?";
        }

        $resultado = $this->CLIENTE->CNX->prepare($consulta);


        if ($busqueda === null) $resultado->execute();
        
        else
        {
            // Para una búsqueda básica o búsqueda en general, colocamos el parametro de esta manera: '%$busqueda%'
            // Para una búsqueda exacta, solo dejaremos la variable, nos quedaría solo: $busqueda
            $parametros = ["%$busqueda%"];
            $resultado->execute($parametros);
        }

        ?><div class="tabla-productos">
        		<table>
                    <thead>
                    <tr>
    				<td>ID</td>
				    <td>Cédula</td>
				    <td>Nombre</td>
				    <td>Teléfono</td>
				    <td>Dirección</td>
				    <td>Actualizar</td>
				    <td>Eliminar</td>
    			    </tr>
                    </thead>
    			 <?php
            while ($cliente = $resultado->fetchObject()) {?>
            <tr>
            <td><?php echo $cliente->id_cliente ?></td>
            <td><?php echo $cliente->cedula ?></td>
            <td><?php echo $cliente->nombre_cliente ?></td>
            <td><?php echo $cliente->telefono ?></td>
            <td><?php echo $cliente->direccion ?></td>
            <td><a  class="btnEditar" href="editar_cliente.php?id_cliente=<?php echo $cliente->id_cliente;?>">Actualizar</a></td>
            <td><div class="boton-modal"><label for="btn-modal">Eliminar</label></div></td>
					</tr>
        <input type="checkbox" name="" id="btn-modal">
        <div class="container-modal">
            <div class="content-modal">
                <h3>¿Estás seguro que deseas eliminar este registro?</h3>
                <div class="btn-cerrar">
                <a class="btnEliminar" href="./../controlador/eliminar_cliente.php?id_cliente=<?php echo $cliente->id_cliente; ?>">Eliminar</a>
                    <label for="btn-modal">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal" class="cerrar-modal"></label>
        </div>
            <?php }
        }
        
        public function mostrar_clientes()
        {
            ?> <select name="clientes" id="">
                <?php
            $cliente = new Cliente();
			
            $cliente->obtener_cliente();?> 

            </select><?php
             
        }
    }

    

    
?>