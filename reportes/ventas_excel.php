<?php

require_once('./../model/conexion.php');
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte_ventas.xls");
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
<th>FECHA</th>
<th>USUARIO</th>
<th>CLIENTE</th>
<th>ZAPATO</th>
<th>PRECIO</th>
<th>CANTIDAD</th>
<th>TOTAL</th>


</tr>
</thead>
<tbody>

<?php

    $data = new conexion();
   $conexion = $data->conectar();
   $resul = $conexion->prepare("SELECT * FROM factura f1 INNER JOIN t_usuario u1 ON f1.id_usuario = u1.id_usuario INNER JOIN clientes c1 ON f1.id_cliente = c1.id_cliente
   INNER JOIN productos p1 ON f1.id = p1.id");
   $resul->execute();
   $data = $resul->fetchall(PDO::FETCH_ASSOC);

   
   /* TABLA */
   for($i=0;$i<count($data);$i++)
   { ?>
    
    <tr>
    <td><?php echo $data[$i]['fecha']; ?></td>
    <td><?php echo $data[$i]['nombre_usu']; ?></td>
    <td><?php echo $data[$i]['nombre_cliente']; ?></td>
    <td><?php echo $data[$i]['nombre']; ?></td>
    <td><?php echo $data[$i]['precio']; ?></td>
    <td><?php echo $data[$i]['cantidad']; ?></td>
    <td><?php echo $data[$i]['totalfactura']; ?></td>
      
      
      <?php }


?>