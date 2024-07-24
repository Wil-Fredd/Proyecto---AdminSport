<?php

include_once ("./../model/proveedor.php");

$proveedor = new Control_Prov();

if (isset($_POST['registrar_prov'])) {
    $proveedor->guardar();
}

if (isset($_POST['editar_prov'])) {
    $proveedor->editar();
}

if (isset($_POST['cancelar_prov'])) {
    header("Location:./../vista/proveedores.php");
}

if (isset($_POST['eliminar_prov'])) {
    $proveedor->eliminar();
}

class Control_Prov
{

    public $PROV;

    public function __construct()
    {
        $this->PROV = new Proveedor();
    }

    public function guardar()
    {

        if (trim($_POST['txtNombre']) === '' || trim($_POST['txtContacto']) === '' || trim($_POST['txtTelefono']) === '' || trim($_POST['txtDireccion']) === '') {
            print '<div class="error"><h4>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h4></div>';
            return;
        } else {
            $proveedor = new Proveedor();
            $proveedor->nombre = $_POST['txtNombre'];
            $proveedor->contacto = $_POST['txtContacto'];
            $proveedor->telefono = $_POST['txtTelefono'];
            $proveedor->direccion = $_POST['txtDireccion'];

            $this->PROV->registrar($proveedor);

            print '<div class="correcto"><h4>¡Registro actualizado, recargue la página para ver los resultados!</h4></div>';
        }
    }

    public function eliminar()
    {
        $this->PROV->delete($_REQUEST['id']);
    }



    public function editar()
    {

        if (trim($_POST['txtNombre']) === '' || trim($_POST['txtContacto']) === '' || trim($_POST['txtTelefono']) === '' || trim($_POST['txtDireccion']) === '') {
            print '<div class="error"><h3>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h3></div>';
            return;
        } else {
            $proveedor = new Proveedor();
            $proveedor->nombre = $_POST['txtNombre'];
            $proveedor->contacto = $_POST['txtContacto'];
            $proveedor->telefono = $_POST['txtTelefono'];
            $proveedor->direccion = $_POST['txtDireccion'];

            $proveedor->cod_proveedor = $_POST['txtCodigo'];

            $this->PROV->actualizar($proveedor);

            print '<div class="correcto"><h3>¡Registro actualizado, recargue la página para ver los resultados!</h3></div>';
        }
    }

    public function mostrar_productos()
    {
        ?>
        <div class="tabla-productos">
            <table>
                <thead>
                    <tr>
                        <td>Codigo</td>
                        <td>Proveedor</td>
                        <td>Contacto</td>
                        <td>Teléfono</td>
                        <td>Dirección</td>
                        <td>Actualizar</td>
                        <td>Eliminar</td>
                    </tr>
                </thead>

                <?php $PROV = new Proveedor();

                foreach ($PROV->listar() as $k): ?>
                    <tr>
                        <td><?php echo $k->cod_proveedor; ?></td>
                        <td><?php echo $k->proveedor; ?></td>
                        <td><?php echo $k->contacto; ?></td>
                        <td><?php echo $k->telefono; ?></td>
                        <td><?php echo $k->direccion; ?></td>
                        <td><a class="btnEditar" href="editar_prov.php?cod_proveedor=<?php echo $k->cod_proveedor; ?>">Actualizar</a>
                        </td>
                        <td>
                            <div class="boton-modal"><label for="btn-modal">Eliminar</label></div>
                        </td>
                    </tr>
                    <input type="checkbox" name="" id="btn-modal">
                    <div class="container-modal">
                        <div class="content-modal">
                            <h4>¿Estás seguro que deseas eliminar este registro?</h4>
                            <div class="btn-cerrar">
                                <a class="btnEliminar"
                                    href="./../controlador/eliminar_prov.php?cod_proveedor=<?php echo $k->cod_proveedor; ?>">Eliminar</a>
                                <label for="btn-modal_2">Cancelar</label>
                            </div>
                        </div>
                        <label for="btn-modal" class="cerrar-modal"></label>
                    </div>

                <?php endforeach;
    }

    public function buscar_productos()
    {

        $consulta = "SELECT * FROM proveedores";

        $busqueda = null;
        if (isset($_POST["busqueda"])) {
            $busqueda = $_POST["busqueda"];
            $consulta = "SELECT * FROM proveedores WHERE cod_proveedor LIKE ?";
        }

        $resultado = $this->PROV->CNX->prepare($consulta);


        if ($busqueda === null)
            $resultado->execute();
        else {
            // Para una búsqueda básica o búsqueda en general, colocamos el parametro de esta manera: '%$busqueda%'
            // Para una búsqueda exacta, solo dejaremos la variable, nos quedaría solo: $busqueda
            $parametros = ["%$busqueda%"];
            $resultado->execute($parametros);
        }

        ?>
                <div class="tabla-productos">
                    <table>
                        <thead>
                            <tr>
                                <td>Codigo</td>
                                <td>Proveedor</td>
                                <td>Contacto</td>
                                <td>Teléfono</td>
                                <td>Dirección</td>
                                <td>Actualizar</td>
                                <td>Eliminar</td>
                            </tr>
                        </thead>
                        <?php
                        while ($proveedor = $resultado->fetchObject()) { ?>
                            <tr>
                                <td><?php echo $proveedor->cod_proveedor ?></td>
                                <td><?php echo $proveedor->proveedor ?></td>
                                <td><?php echo $proveedor->contacto ?></td>
                                <td><?php echo $proveedor->telefono ?></td>
                                <td><?php echo $proveedor->direccion ?></td>
                                <td><a class="btnEditar" href="editar_prov.php?id=<?php echo $proveedor->id; ?>">Actualizar</a></td>
                                <td>
                                    <div class="boton-modal"><label for="btn-modal">Eliminar</label></div>
                                </td>
                            </tr>
                            <input type="checkbox" name="" id="btn-modal">
                            <div class="container-modal">
                                <div class="content-modal">
                                    <h3>¿Estás seguro que deseas eliminar este registro?</h3>
                                    <div class="btn-cerrar">
                                        <a class="btnEliminar"
                                            href="./../controlador/eliminar_prov.php?cod_proveedor=<?php echo $proveedor->cod_proveedor; ?>">Eliminar</a>
                                        <label for="btn-modal">Cancelar</label>
                                    </div>
                                </div>
                                <label for="btn-modal" class="cerrar-modal"></label>
                            </div>
                        <?php }
    }
}

?>