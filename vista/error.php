<?php 
    session_start();
	if (!isset($_SESSION['nombre'])) header('Location: ./../vista/login.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./../CSS/error.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="./../CSS/oscuro.css?v=<?php echo time(); ?>"/>
    <link rel="shortcut icon" href="./../img/error.png">
    <title>ERROR - AdminSport</title>
</head>
<body>
        
<div class="contenido">
        
        <div class="form-datos">
            
            <h3>¡No se puede acceder a este sitio web!</h3>
            <p>Estás intentando acceder a un sitio de Administradores.</p>
            <br>
            <form action="" method="post">
                <div class="botones">
                <input type="submit" name="ventas" id="ventas" value="IR A GESTIÓN DE VENTAS">
              <input type="submit" name="clientes" id="clientes" value="IR A GESTIÓN DE CLIENTES">
                </div>
               
                    
            </form>

            <?php include_once("./../controlador/control_rutas.php"); ?>
            
            
            
            

    </div>


	
</body>
</html>