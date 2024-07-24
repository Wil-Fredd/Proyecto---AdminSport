<?php

require_once('./../model/conexion.php');
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte_productos.xls");
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
<th>CODIGO</th>
<th>NOMBRE</th>
<th>PRECIO COMPRA</th>
<th>PRECIO VENTA</th>
<th>EXISTENCIA</th>
<th>PROVEEDOR</th>


</tr>
</thead>
<tbody>

<?php

    $data = new conexion();
   $conexion = $data->conectar();
   $resul = $conexion->prepare("SELECT * FROM productos p1 INNER JOIN proveedores p2 ON p1.cod_proveedor = p2.cod_proveedor");
   $resul->execute();
   $data = $resul->fetchall(PDO::FETCH_ASSOC);

   
   /* TABLA */
   for($i=0;$i<count($data);$i++)
   { ?>
    
    <tr>
    <td><?php echo $data[$i]['codigo']; ?></td>
    <td><?php echo $data[$i]['nombre']; ?></td>
    <td><?php echo $data[$i]['pcompra']; ?></td>
    <td><?php echo $data[$i]['pventa']; ?></td>
    <td><?php echo $data[$i]['existencia']; ?></td>
    <td><?php echo $data[$i]['proveedor']; ?></td>
      
      
      <?php }


?>