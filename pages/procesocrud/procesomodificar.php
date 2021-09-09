<?php

include("../con_db.php");

session_start();

if(isset($_SESSION['usuario'])){

  if($_SESSION['usuario']['tipo']!=1){
    header("Location: ../../pagesuser/medicamentos.php");
  }
  
}else{
  header("Location: ../../login-register/login.php");
  die();
}


$codigo = $_REQUEST['codigo'];
$sql = "SELECT * FROM tabla_medicamentos WHERE codigo = '$codigo'";
$resultado = mysqli_query($connect, $sql);
$row=mysqli_fetch_array($resultado);

if($row['descuento']=='Aplica'){
    $preciooriginal = $row['precioori'];
}

$nombre = $_POST['nombre'];
$precioactual = $_POST['precio'];
$stock = $_POST['stock'];
$descuento = $_POST['descuento'];
$titular = $_POST['titular'];

if($row['descuento']=='Aplica'){
    $preciooriginal = $row['precioori'];
}else{
    $preciooriginal = $precioactual;
}


if($descuento=='Aplica'){
    $preciodescuento = round(number_format(($preciooriginal*0.8),2),1);
}else{
    $preciodescuento = $preciooriginal;
}    


$query = "UPDATE tabla_medicamentos SET nombre='$nombre', precio='$preciodescuento', precioori='$preciooriginal', stock='$stock', descuento='$descuento',
 nomtitular='$titular' WHERE codigo = '$codigo'";

$resultado = mysqli_query($connect, $query);

if($resultado){
    header("Location: ../medicamentos.php");
}else{
    echo "Ocurrió un error";
}

?>