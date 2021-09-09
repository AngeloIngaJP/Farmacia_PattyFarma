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

$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));


$query = "UPDATE tabla_usuarios SET foto='$foto' WHERE codigo = '$codigo_usuario'";

$resultado = mysqli_query($connect, $query);


if($resultado){
    header("Location: ../miperfil.php");
}else{
    echo "Ocurrió un error";
}

?>