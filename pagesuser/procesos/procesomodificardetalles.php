<?php

include("../con_db.php");

session_start();

if(isset($_SESSION['usuario'])){

  if($_SESSION['usuario']['tipo']!=0){
    header("Location: ../../pages/dashboard.php");
  }
  
}else{
  header("Location: ../../login-register/login.php");
  die();
}



$codigo_usuario = $_REQUEST['codigo'];


$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$telefono = $_POST['telefono'];
$sexo = $_POST['sexo'];

if(strlen($edad)==0 && strlen($telefono)==0){
    $query = "UPDATE tabla_usuarios SET nombre='$nombre', apellido='$apellido', edad=null, telefono=null, sexo='$sexo' WHERE codigo='$codigo_usuario'";
}else if(strlen($edad)!=0 && strlen($telefono)==0){
    $query = "UPDATE tabla_usuarios SET nombre='$nombre', apellido='$apellido', edad='$edad', telefono=null, sexo='$sexo' WHERE codigo='$codigo_usuario'";
}else if(strlen($edad)==0 && strlen($telefono)!=0){
    $query = "UPDATE tabla_usuarios SET nombre='$nombre', apellido='$apellido', edad=null, telefono='$telefono', sexo='$sexo' WHERE codigo='$codigo_usuario'";
}else{
    $query = "UPDATE tabla_usuarios SET nombre='$nombre', apellido='$apellido', edad='$edad', telefono='$telefono', sexo='$sexo' WHERE codigo='$codigo_usuario'";   
}

$namecompleto = $nombre." ".$apellido;

$queryuser = "UPDATE mispedidos SET nombres='$namecompleto' WHERE comprador='$codigo_usuario'";
$resuluser = mysqli_query($connect, $queryuser);

$resultado = mysqli_query($connect, $query);

if($resultado && $resuluser){
    header("Location: ../miperfil.php");
}else{
    echo "Ocurrió un error";
}

?>