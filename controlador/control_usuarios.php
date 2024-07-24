<?php 

    include_once("./../model/usuario.php");

    $usuario = new Control_Usuario();

    if(isset($_POST['registrar_usuario']))
    {
            $usuario->guardar();
    }

    if(isset($_POST['editar_usuario']))
    {
        $usuario->editar();
    }

    if(isset($_POST['cancelar_usuario']))
    {
        header("Location:./../vista/usuarios.php");
    }

    
    class Control_Usuario
    {
        
        public $USUARIO;


        public function __construct()
        {
            $this->USUARIO = new Usuario();
        }
        
        public function guardar()
        {
            if (trim($_POST['txtNombre']) === '' || /*trim($_POST['txtRol']) === '' ||*/ trim($_POST['txtContraseña']) === '') 
		    {
			    print '<div class="error"><h4>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h4></div>'; 
    		    return;
		    }
        else 
            {
            $usuario = new Usuario();
            $usuario->nombre = $_POST['txtNombre'];
            $usuario->contraseña = $_POST['txtContraseña'];
            $usuario->rol = $_POST['roles'];
            
            $this->USUARIO->registrar($usuario);

            print '<div class="correcto"><h4>¡Registro exitoso, recargue la página para ver los resultados!</h4></div>';
            }
        }

        public function editar()
        {
            if (trim($_POST['txtNombre']) === '' || /*trim($_POST['txtRol']) === '' ||*/ trim($_POST['txtContraseña']) === '') 
		    {
			    print '<div class="error"><h4>¡Debes completar todos los datos, no puedes dejar campos vacíos!</h4></div>'; 
    		    return;
		    }
        else 
            {
            $usuario = new Usuario();
            $usuario->nombre = $_POST['txtNombre'];
            $usuario->contraseña = $_POST['txtContraseña'];
            //$usuario->rol = $_POST['txtRol'];
            $usuario->rol = $_POST['roles'];
            $usuario->id_usuario = $_POST['txtID'];
            
            $this->USUARIO->actualizar($usuario);

            print '<div class="correcto"><h4>¡Registro actualizado, recargue la página para ver los resultados!</h4></div>';
            }
        }
        
        public function mostrar_usuarios()
        {
            ?><div class="tabla-productos">
    		<table>
                <thead>
            <tr>
				<td>ID</td>
				<td>Nombre</td>
				<td>Contraseña</td>
                <td>Rol</td>
				<td>Actualizar</td>
				<td>Eliminar</td>
			</tr>
                </thead>
			
            <?php $USUARIO = new Usuario();
			
				 foreach ($USUARIO->listar() as $k):?> 
					<tr>
						<td><?php echo $k->id_usuario;?></td>
						<td><?php echo $k->nombre_usu;?></td>
						<td><?php echo $k->password_usu;?></td>
                        <?php if ($k->rol === 1) $rol = "Administrador"; else $rol = "Vendedor"; ?>
						<td><?php echo $rol;?></td>
						<td><a  class="btnEditar" href="editar_usuario.php?id_usuario=<?php echo $k->id_usuario;?>">Actualizar</a></td>
                		<td><div class="boton-modal"><label for="btn-modal">Eliminar</label></div></td>
					</tr>
        <input type="checkbox" name="" id="btn-modal">
        <div class="container-modal">
            <div class="content-modal">
                <h4>¿Estás seguro que deseas eliminar este registro?</h4>
                <div class="btn-cerrar">

                <a class="btnEliminar" href="./../controlador/eliminar_usuario.php?id_usuario=<?php echo $k->id_usuario; ?>">Eliminar</a>
                    <label for="btn-modal">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal" class="cerrar-modal"></label>
        </div>
						
				<?php endforeach; 
            }
        
        public function buscar_usuarios()
        {
        
        $consulta = "SELECT * FROM t_usuario";
        
        $busqueda = null;
        if (isset($_POST["busqueda"]))
        {    
            $busqueda = $_POST["busqueda"];
            $consulta = "SELECT * FROM t_usuario WHERE nombre_usu LIKE ?";
        }

        $resultado = $this->USUARIO->CNX->prepare($consulta);


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
                    <td>Nombre</td>
                    <td>Contraseña</td>
                    <td>Rol</td>
                    <td>Actualizar</td>
                    <td>Eliminar</td>
    			    </tr>
                    </thead>
    			 <?php
            while ($usuario = $resultado->fetchObject()) {?>
            <tr>
            <td><?php echo $usuario->id_usuario ?></td>
            <td><?php echo $usuario->nombre_usu ?></td>
            <td><?php echo $usuario->password_usu ?></td>
            <?php if ($usuario->rol === 1) $rol = "Administrador"; else $rol = "Vendedor"; ?>
            <td><?php echo $rol ?></td>
            <td><a  class="btnEditar" href="editar_usuario.php?id_usuario=<?php echo $usuario->id_usuario;?>">Actualizar</a></td>
            <td><div class="boton-modal"><label for="btn-modal">Eliminar</label></div></td>
					</tr>
        <input type="checkbox" name="" id="btn-modal">
        <div class="container-modal">
            <div class="content-modal">
                <h4>¿Estás seguro que deseas eliminar este registro?</h4>
                <div class="btn-cerrar">
                <a class="btnEliminar" href="./../controlador/eliminar_usuario.php?id_usuario=<?php echo $usuario->id_usuario; ?>">Eliminar</a>
                    <label for="btn-modal">Cancelar</label>
                </div>
            </div>
            <label for="btn-modal" class="cerrar-modal"></label>
        </div>
            <?php }
        }
    }

    

    
?>