<?php

require_once('./../model/conexion.php');
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte_clientes.xls");
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
<th>CEDULA</th>
<th>NOMBRE</th>
<th>TELEFONO</th>
<th>DIRECCION</th>



</tr>
</thead>
<tbody>

<?php

    $data = new conexion();
   $conexion = $data->conectar();
   $resul = $conexion->prepare("SELECT * FROM clientes");
   $resul->execute();
   $data = $resul->fetchall(PDO::FETCH_ASSOC);

   
   /* TABLA */
   for($i=0;$i<count($data);$i++)
   { ?>
    
    <tr>
    <td><?php echo $data[$i]['id_cliente']; ?></td>
    <td><?php echo $data[$i]['cedula']; ?></td>
    <td><?php echo $data[$i]['nombre_cliente']; ?></td>
    <td><?php echo $data[$i]['telefono']; ?></td>
    <td><?php echo $data[$i]['direccion']; ?></td>
  
      
      
      <?php }


?>