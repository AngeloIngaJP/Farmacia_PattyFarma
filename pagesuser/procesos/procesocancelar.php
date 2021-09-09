<?php

include("../con_db.php");

session_start();

$codigocomprador = $_SESSION['usuario']['codigo'];

$codigo = $_REQUEST['codigo'];

$query = "DELETE FROM miscompras WHERE codigoproducto = '$codigo' AND comprador='$codigocomprador'";

$resultado = mysqli_query($connect, $query);

if($resultado){
    header("Location: ../miscompras.php");
}else{
    echo "Ocurrió un error";
}

?>