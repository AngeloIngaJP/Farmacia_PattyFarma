<?php

include("../con_db.php");

session_start();
$comprador = $_SESSION['usuario']['codigo'];

$metodo_pago = $_POST['metodo_pago'];
$fecha_recojo = $_POST['fecha_recojo'];

$consulta = "SELECT * FROM miscompras";




$resultado = mysqli_query($connect, $consulta);
$num_resultados = mysqli_num_rows($resultado);

$all_product = ' ';

for ($i=0;$i<($num_resultados);$i++){
    $row= $resultado->fetch_array();
    if($row['comprador']==$comprador){
        $all_product = $all_product.$row['nombre'].","; 
    }
}

$resultado2 = mysqli_query($connect, $consulta);
$num_resultados2 = mysqli_num_rows($resultado2);

$all_amount = ' ';

for ($i=0;$i<($num_resultados2);$i++){
    $row= $resultado2->fetch_array();
    if($row['comprador']==$comprador){
        $all_amount = $all_amount.$row['cantidad'].","; 
    }
}

$total_precio = 0;

$resultado3 = mysqli_query($connect, $consulta);
$num_resultados3 = mysqli_num_rows($resultado3);

for ($i=0;$i<($num_resultados3);$i++){
    $row= $resultado3->fetch_array();
    if($row['comprador']==$comprador){
        $total_precio = $total_precio + $row['preciototal'];
    } 
}

$total_descuento = 0;

$resultado4 = mysqli_query($connect, $consulta);
$num_resultados4 = mysqli_num_rows($resultado4);

for ($i=0;$i<($num_resultados4);$i++){
    $row= $resultado4->fetch_array();
    if($row['comprador']==$comprador){
        $total_descuento = $total_descuento + $row['descuentototal'];
    }
}

date_default_timezone_set('America/Lima');
$fechareg = date("Y-m-d");

$varsession = $_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellido'];

$codigo_pedido = rand(1000000, 9999999);

$query = "INSERT INTO mispedidos(cod_pedido, comprador, nombres, productos_each, cantidad_each, montototal, descuentototal, metodo_pago, fechareg, fecharecojo) 
VALUES ('$codigo_pedido','$comprador','$varsession','$all_product','$all_amount','$total_precio','$total_descuento','$metodo_pago','$fechareg','$fecha_recojo')";

$lastresultado = mysqli_query($connect, $query);



$resultadoeli = mysqli_query($connect, $consulta);
$num_resultadoseli = mysqli_num_rows($resultadoeli);

$codigocomprador = $_SESSION['usuario']['codigo'];
$eliminacion = "DELETE FROM miscompras WHERE comprador='$codigocomprador'";

for($i=0;$i<$num_resultadoseli;$i++){
    $result_eliminacion = mysqli_query($connect, $eliminacion);
}




if($lastresultado && $result_eliminacion){
    header("Location: ../confirmacion.php");
}else{
    echo "Ocurrió un error";
}


?>