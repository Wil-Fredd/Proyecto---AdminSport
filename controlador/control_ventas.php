<?php 

    include_once("./../model/venta.php");

    $venta = new Control_Venta();

    if(isset($_POST['registrar_venta']))
    {
            $venta->guardar();
    }

    if(isset($_POST['editar_venta']))
    {
            $venta->editar();
    }

    if(isset($_POST['cancelar_venta']))
    {
        header("Location:./../vista/ventas.php");
    }
    
    class Control_Venta
    {
        public $VENTA;
        

        public function __construct()
        {
            $this->VENTA = new Venta();
            
        }
        
        public function guardar()
        {

            if (trim($_POST['txtExistencia']) === '' || trim($_POST['txtPrecio']) === '') 
		    {
			    print '<div class="error"><h4>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h4></div>'; 
    		    return;
		    }
        else 
            {
            $venta = new Venta();
            $venta->id_cliente = $_POST['clientes'];
            $venta->cod_producto = $_POST['productos'];
            $venta->cantidad = $_POST['txtExistencia'];
            $venta->precio = $_POST['txtPrecio']; 
            $venta->total = $_POST['txtTotal'];
            
            
            $this->VENTA->venta($venta);

            print '<div class="correcto"><h4>¡Registro exitoso, recargue la página para ver los resultados!</h4></div>';
            }
        }

        

        public function editar()
        {

            if (trim($_POST['txtExistencia']) === '') 
		    {
			    print '<div class="error"><h4>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h4></div>'; 
    		    return;
		    }
        else 
            {
            $venta = new Venta();
            $venta->id_cliente = $_POST['clientes'];
            $venta->cod_producto = $_POST['productos'];
            $venta->cantidad = $_POST['txtExistencia'];
            $venta->precio = $_POST['txtPrecio']; 
            $venta->total = $_POST['txtTotal'];

            $venta->id_factura = $_POST['txtID'];
            
            
            $this->VENTA->editar_venta($venta);

            print '<div class="correcto"><h4>¡Registro exitoso, recargue la página para ver los resultados!</h4></div>';
            }
        }

        public function mostrar_ventas()
        {
            ?><div class="tabla-productos">
    		<table>
                <thead>
            <tr>
				<td>Fecha</td>
				<td>Usuario</td>
				<td>Cliente</td>
				<td>Calzado</td>
				<td>Precio Venta</td>
                <td>Cantidad</td>
                <td>Total</td>
                <td>Actualizar</td>
				<td>Factura</td>
				<td>Eliminar</td>
			</tr>
                </thead>
			
            <?php $MODEL = new Venta();
			
				 foreach ($MODEL->listar() as $k):?> 
					<tr>
						<td><?php echo $k->fecha;?></td>
						<td><?php echo $k->nombre_usu;?></td>
						<td><?php echo $k->nombre_cliente;?></td>
						<td><?php echo $k->nombre;?></td>
						<td><?php echo $k->precio;?></td>
                        <td><?php echo $k->cantidad;?></td>
                        <td><?php echo $k->totalfactura;?></td>
						<td><a  class="btnEditar" href="editar_ventas.php?id_factura=<?php echo $k->id_factura;?>">Actualizar</a></td>
                        <td><a  class="btnFactura" target="_blank" href="./../reportes/factura.php?id_factura=<?php echo $k->id_factura;?>">Factura</a></td>
                		<td><div class="boton-modal"><label for="btn-modal">Eliminar</label></div></td>
					</tr>
        <input type="checkbox" name="" id="btn-modal">
        <div class="container-modal">
            <div class="content-modal">
                <h4>¿Estás seguro que deseas eliminar este registro?</h4>
                <div class="btn-cerrar">
                <a class="btnEliminar" href="./../controlador/eliminar_venta.php?id_factura=<?php echo $k->id_factura; ?>">Eliminar</a>
                    <label for="btn-modal">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal" class="cerrar-modal"></label>
        </div>
						
				<?php endforeach; 
            }

        public function buscar_ventas()
        {
        
        $consulta = "SELECT * FROM factura f1 INNER JOIN t_usuario u1 ON f1.id_usuario = u1.id_usuario INNER JOIN clientes c1 ON f1.id_cliente = c1.id_cliente
        INNER JOIN productos p1 ON f1.id = p1.id";
        
        $busqueda = null;
        if (isset($_POST["busqueda"]))
        {    
            $busqueda = $_POST["busqueda"];
            $consulta = "SELECT * FROM factura f1 INNER JOIN t_usuario u1 ON f1.id_usuario = u1.id_usuario INNER JOIN clientes c1 ON f1.id_cliente = c1.id_cliente
            INNER JOIN productos p1 ON f1.id = p1.id WHERE nombre_cliente LIKE ?";
            
        }

        $resultado = $this->VENTA->CNX->prepare($consulta);


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
    				<td>Fecha</td>
				    <td>Usuario</td>
                    <td>Cliente</td>
                    <td>Calzado</td>
                    <td>Precio Venta</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                    <td>Actualizar</td>
                    <td>Factura</td>
                    <td>Eliminar</td>
    			</tr>
                    </thead>
    			 <?php
            while ($venta = $resultado->fetchObject()) {?>
            <tr>
            <td><?php echo $venta->fecha ?></td>
            <td><?php echo $venta->nombre_usu ?></td>
            <td><?php echo $venta->nombre_cliente ?></td>
            <td><?php echo $venta->nombre ?></td>
            <td><?php echo $venta->precio ?></td>
            <td><?php echo $venta->cantidad ?></td>
            <td><?php echo $venta->totalfactura ?></td>
            <<td><a  class="btnEditar" target="_blank" href="editar_ventas.php?id_factura=<?php echo $venta->id_factura;?>">Actualizar</a></td>
                        <td><a  class="btnEditar" href="./../reportes/factura.php?id_factura=<?php echo $venta->id_factura;?>">Factura</a></td>
                		<td><div class="boton-modal"><label for="btn-modal">Eliminar</label></div></td>
					</tr>
        <input type="checkbox" name="" id="btn-modal">
        <div class="container-modal">
            <div class="content-modal">
                <h4>¿Estás seguro que deseas eliminar este registro?</h4>
                <div class="btn-cerrar">
                <a class="btnEliminar" href="./../controlador/eliminar_venta.php?id_factura=<?php echo $venta->id_factura; ?>">Eliminar</a>
                    <label for="btn-modal">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal" class="cerrar-modal"></label>
        </div>
						
				<?php
             }
        }

        
    }

?>