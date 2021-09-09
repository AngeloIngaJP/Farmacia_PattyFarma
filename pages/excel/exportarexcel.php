<?php

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= Tabla_de_productos.xls");



?>

<?php 

include("../con_db.php");


$consulta = "SELECT * FROM tabla_medicamentos ORDER BY id DESC";
$resultado = mysqli_query($connect, $consulta);
$num_resultados = mysqli_num_rows($resultado);

?>


<table>
        <thead>
            <tr>
                <td>Código</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Stock</td>
                <td>Descuento</td>
                <td>Fecha Registro</td>
                <td>Nombre del titular</td>
            </tr>
        </thead>
        <tbody class='body_user'>
            <?php
             for ($i=0;$i<($num_resultados);$i++){
                $row= $resultado->fetch_array();
                $date = $row['fechareg'];
                $newDate = date("d-m-Y", strtotime($date));

            ?>
            <tr class='tr_medicament'>
                <td><?php echo $row['codigo']?></td>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo number_format($row['precio'],2)?></td>
                <td><?php echo $row['stock']?></td>
                <td><?php echo $row['descuento']?></td>
                <td><?php echo $newDate ?></td>
                <td><?php echo $row['nomtitular']?></td>
            </tr>
            <?php } ?>
        </tbody>
</table>