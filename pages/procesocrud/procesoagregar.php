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


$nombre = $_POST['nombre'];
$preciooriginal = $_POST['precio'];
$stock = $_POST['stock'];
$descuento = $_POST['descuento'];
$titular = $_POST['titular'];
$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

date_default_timezone_set('America/Lima');

$codigo = rand(1000000, 9999999);
$fechareg = date("Y-m-d");


if($descuento=='Aplica'){
    $preciodescuento = round(number_format(($preciooriginal*0.8),2),1);
}else{
    $preciodescuento = $preciooriginal;
}


$query = "INSERT INTO tabla_medicamentos(codigo, nombre, precio, precioori, stock, descuento, fechareg, nomtitular, foto) 
VALUES ('$codigo','$nombre','$preciodescuento','$preciooriginal','$stock','$descuento','$fechareg','$titular','$foto')";

$resultado = mysqli_query($connect, $query);

if($resultado){
    header("Location: ../medicamentos.php");
}else{
    echo "Ocurrió un error";
}

?>