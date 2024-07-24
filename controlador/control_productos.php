<?php

include_once ("./../model/producto.php");
include_once ("./../model/usuario.php");


class Control
{
    public $MODEL;
    public $USER;

    public function __construct()
    {
        $this->MODEL = new Producto();
        $this->USER = new Usuario();
    }

    public function index()
    {
        include_once ("./../vista/login.php");
    }

    public function iniciar_sesion()
    {
        $usuario = new Usuario();

        $usuario->nombre = $_POST['txtUsu'];
        $usuario->contraseña = $_POST['txtPass'];

        if (empty($usuario->nombre) || empty($usuario->contraseña))
            print '<div class="error"><h4>Debes completar todos los campos.</h4></div>';
        else
            $this->USER->iniciar($usuario);
    }

    public function guardar()
    {

        if (
            trim($_POST['txtCodigo']) === '' || trim($_POST['txtNombre']) === '' || trim($_POST['txtPcompra']) === '' || trim($_POST['txtPventa']) === ''
            || trim($_POST['txtExistencia']) === ''
        ) {
            print '<div class="error"><h4>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h4></div>';
            return;
        } else {
            $producto = new Producto();
            $producto->codigo = $_POST['txtCodigo'];
            $producto->nombre = $_POST['txtNombre'];
            $producto->pcompra = $_POST['txtPcompra'];
            $producto->pventa = $_POST['txtPventa'];
            $producto->existencia = $_POST['txtExistencia'];
            $producto->cod_proveedor = $_POST['proveedor'];


            $this->MODEL->registrar($producto);

            print '<div class="correcto"><h4>¡Registro exitoso, recargue la página para ver los resultados!</h4></div>';
        }
    }

    public function eliminar()
    {
        $this->MODEL->delete($_REQUEST['id']);
    }

    public function editar()
    {

        if (
            trim($_POST['txtCodigo']) === '' || trim($_POST['txtNombre']) === '' || trim($_POST['txtPcompra']) === '' || trim($_POST['txtPventa']) === ''
            || trim($_POST['txtExistencia']) === ''
        ) {
            print '<div class="error"><h3>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h3></div>';
            return;
        } else {
            $producto = new Producto();
            $producto->codigo = $_POST['txtCodigo'];
            $producto->nombre = $_POST['txtNombre'];
            $producto->pcompra = $_POST['txtPcompra'];
            $producto->pventa = $_POST['txtPventa'];
            $producto->existencia = $_POST['txtExistencia'];

            $producto->id = $_POST['txtID'];

            $this->MODEL->actualizar($producto);

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
                        <td>Nombre</td>
                        <td>Precio compra</td>
                        <td>Precio venta</td>
                        <td>Ganancia</td>
                        <td>Existencia</td>
                        <td>Proveedor</td>
                        <td>Actualizar</td>
                        <td>Eliminar</td>
                    </tr>
                </thead>

                <?php $MODEL = new Producto();

                foreach ($MODEL->listar() as $k): ?>
                    <tr>
                        <td><?php echo $k->codigo; ?></td>
                        <td><?php echo $k->nombre; ?></td>
                        <td><?php echo $k->pcompra; ?></td>
                        <td><?php echo $k->pventa; ?></td>
                        <td><?php echo $k->pventa - $k->pcompra ?></td>
                        <td><?php echo $k->existencia; ?></td>
                        <td><?php echo $k->proveedor; ?></td>
                        <td><a class="btnEditar" href="editar_producto.php?id=<?php echo $k->id; ?>">Actualizar</a></td>
                        <td>
                            <div class="boton-modal"><label for="btn-modal">Eliminar</label></div>
                        </td>
                    </tr>
                    <input type="checkbox" name="" id="btn-modal">
                    <div class="container-modal">
                        <div class="content-modal">
                            <h3>¿Estás seguro que deseas eliminar este registro?</h3>
                            <div class="btn-cerrar">
                                <a class="btnEliminar" href="./../controlador/eliminar.php?id=<?php echo $k->id; ?>">Eliminar</a>
                                <label for="btn-modal">Cancelar</label>
                            </div>
                        </div>
                        <label for="btn-modal" class="cerrar-modal"></label>
                    </div>

                <?php endforeach;
    }

    public function buscar_productos()
    {

        $consulta = "SELECT * FROM productos";

        $busqueda = null;
        if (isset($_POST["busqueda"])) {
            $busqueda = $_POST["busqueda"];
            $consulta = "SELECT * FROM productos WHERE codigo LIKE ?";
        }

        $resultado = $this->MODEL->CNX->prepare($consulta);


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
                                <td>Nombre</td>
                                <td>Precio compra</td>
                                <td>Precio venta</td>
                                <td>Ganancia</td>
                                <td>Existencia</td>
                                <td>Actualizar</td>
                                <td>Eliminar</td>
                            </tr>
                        </thead>
                        <?php
                        while ($producto = $resultado->fetchObject()) { ?>
                            <tr>
                                <td><?php echo $producto->codigo ?></td>
                                <td><?php echo $producto->nombre ?></td>
                                <td><?php echo $producto->pcompra ?></td>
                                <td><?php echo $producto->pventa ?></td>

                                <td><?php echo $producto->pventa - $producto->pcompra ?></td>
                                <td><?php echo $producto->existencia ?></td>
                                <td><a class="btnEditar" href="editar_producto.php?id=<?php echo $producto->id; ?>">Actualizar</a>
                                </td>
                                <td>
                                    <div class="boton-modal"><label class="btnEliminar" for="btn-modal">Eliminar</label></div>
                                </td>
                            </tr>
                            <input type="checkbox" name="" id="btn-modal">
                            <div class="container-modal">
                                <div class="content-modal">
                                    <h3>¿Estás seguro que deseas eliminar este registro?</h3>
                                    <div class="btn-cerrar">
                                        <a class="btnEliminar"
                                            href="./../controlador/eliminar.php?id=<?php echo $producto->id; ?>">Eliminar</a>
                                        <label for="btn-modal">Cancelar</label>
                                    </div>
                                </div>
                                <label for="btn-modal" class="cerrar-modal"></label>
                            </div>

                            <?php
                        }
    }

    public function mostrar_proveedores()
    {
        ?> <select name="proveedor" id="">
                            <?php
                            $MODEL = new Producto();

                            $MODEL->obtener_proveedor(); ?>

                        </select><?php

    }

    public function mostrar_zapatos()
    {
        ?> <select name="productos" id="productos">
                            <?php
                            $MODEL = new Producto();

                            $MODEL->obtener_producto(); ?>

                        </select>
                        <?php

    }

}

?>