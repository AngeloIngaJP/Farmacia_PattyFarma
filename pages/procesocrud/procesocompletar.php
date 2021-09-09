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
  

$codigo_pedido = $_REQUEST['codigo'];

$insertarup = "UPDATE mispedidos SET estado='Atendido' WHERE cod_pedido='$codigo_pedido'";
$resultadoup = mysqli_query($connect, $insertarup);

if($resultadoup){
    header("Location: ../pedidos.php");
}else{
    echo "Ocurrió un error";
}


?>