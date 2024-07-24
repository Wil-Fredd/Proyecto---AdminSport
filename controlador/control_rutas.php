<?php 
    
    include_once("./../controlador/control_productos.php");
    
    $control = new Control();
    
        if(isset($_POST['registrar']))
        {
            $control->guardar();
        }

        if(isset($_POST['eliminar']))
        {
            $control->eliminar();
        }

        if(isset($_POST['editar']))
        {
            $control->editar();
        }

        if(isset($_POST['iniciar']))
        {
            $control->iniciar_sesion();
        }

        if(isset($_POST['cancelar']))
        {
            header("Location:./../vista/productos.php");
        }

        if(isset($_POST['ventas']))
        {
            header("Location:./../vista/ventas.php");
        }

        if(isset($_POST['clientes']))
        {
            header("Location:./../vista/clientes.php");
        }

?>