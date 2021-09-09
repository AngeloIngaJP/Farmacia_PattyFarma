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

$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));


$query = "UPDATE tabla_medicamentos SET foto='$foto' WHERE codigo = '$codigo'";

$resultado = mysqli_query($connect, $query);

if($resultado){
    header("Location: ../medicamentos.php");
}else{
    echo "Ocurrió un error";
}

?>