<?php

require_once('./../model/conexion.php');
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte_usuarios.xls");
?>

<style>
  table {
    margin-top: 25px;
    margin-left: auto;
    margin-right: auto;
    width: 80%;
    border-collapse: collapse;
    color: #1c1c1c;
    text-align: center;
    
}

td,th {
    padding-left: 12px;
    padding-right: 12px;
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: center;
    
}

thead {
    background-color: #ff944e;
    border-bottom: solid 3px #000;
    color: #1c1c1c;
}
</style>
<table  id= "table_id">

                   
<thead>    
<tr>
<th>ID</th>
<th>NOMBRE</th>
<th>CONTRASEÑA</th>
<th>ROL</th>



</tr>
</thead>
<tbody>

<?php

    $data = new conexion();
   $conexion = $data->conectar();
   $resul = $conexion->prepare("SELECT * FROM t_usuario");
   $resul->execute();
   $data = $resul->fetchall(PDO::FETCH_ASSOC);

   
   /* TABLA */
   for($i=0;$i<count($data);$i++)
   { ?>
    
    <tr>
    <td><?php echo $data[$i]['id_usuario']; ?></td>
    <td><?php echo $data[$i]['nombre_usu']; ?></td>
    <td><?php echo $data[$i]['password_usu']; ?></td>

    <?php if ($data[$i]['rol'] === 1) $rol = "Administrador"; else $rol = "Vendedor"; ?>
    <td><?php echo $rol; ?></td>
  
      
      
      <?php }


?>