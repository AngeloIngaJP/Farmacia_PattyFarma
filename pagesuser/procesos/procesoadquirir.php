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


$codigocomprador = $_SESSION['usuario']['codigo'];

$codigo = $_REQUEST['codigo'];
$sql = "SELECT * FROM tabla_medicamentos WHERE codigo = '$codigo'";
$resultado = mysqli_query($connect, $sql);
$row=mysqli_fetch_array($resultado);


$cantidad = $_POST['cantidad'];
$precio = $row['precio'];
$preciooriginal = $row['precioori'];


$nombre = $row['nombre'];
$preciototal = $precio*$cantidad;
$descuentototal = $preciooriginal*$cantidad - $preciototal;


$foto = base64_encode($row['foto']);


$query = "INSERT INTO miscompras(comprador,codigoproducto,nombre,cantidad,preciototal,descuentototal,foto) VALUES ('$codigocomprador','$codigo','$nombre','$cantidad','$preciototal','$descuentototal','$foto')";

$result = mysqli_query($connect, $query);

if($result){

    header("Location: ../miscompras.php");
}else{
    echo "Ocurrió un error";
}



    
?>