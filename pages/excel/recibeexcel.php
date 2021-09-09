<?php
require('../con_db.php');

session_start();

if(isset($_SESSION['usuario'])){

  if($_SESSION['usuario']['tipo']!=1){
    header("Location: ../../pagesuser/medicamentos.php");
  }
  
}else{
    header("Location: ../../login-register/login.php");
  die();
}



$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);

$i = 0;
$modificados = 0;
$nuevos = 0;
$resultado = 0;
$resultadoup = 0;

date_default_timezone_set('America/Lima');
$fechareg = date("Y-m-d");;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        

        $datos = explode(";", $linea);
       
        $codigo                = !empty($datos[0])  ? ($datos[0]) : '';
		$nombre                = !empty($datos[1])  ? ($datos[1]) : '';
        $preciooriginal                = !empty($datos[2])  ? ($datos[2]) : '';
        $stock                = !empty($datos[3])  ? ($datos[3]) : '';
        $descuento                = !empty($datos[4])  ? ($datos[4]) : '';
        $nomtitular                = !empty($datos[5])  ? ($datos[5]) : '';

        if( !empty($codigo) ){
            $checkemail_duplicidad = ("SELECT codigo FROM tabla_medicamentos WHERE codigo='".($codigo)."' ");
            $ca_dupli = mysqli_query($connect, $checkemail_duplicidad);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
        }

        if($cant_duplicidad==0){

            if($descuento=="Aplica"){
                $preciodescuento = round(number_format(($preciooriginal*0.8),2),1);
            }else{
                $preciodescuento = $preciooriginal;
            }

            $insertar = "INSERT INTO tabla_medicamentos(codigo, nombre, precio, precioori, stock, descuento, fechareg, nomtitular) 
            VALUES('$codigo','$nombre','$preciodescuento','$preciooriginal','$stock','$descuento','$fechareg','$nomtitular')";
            $resultado=mysqli_query($connect, $insertar);
            $nuevos++;
            $preciodescuento=0;

        }else{
            if($descuento=='Aplica'){
                $preciodescuento = round(number_format(($preciooriginal*0.8),2),1);
            }else{
                $preciodescuento = $preciooriginal;
            }    

            $insertarup =  ("UPDATE tabla_medicamentos SET 
            nombre='$nombre',
            precio='$preciodescuento',
            precioori='$preciooriginal',
            stock='$stock',
            descuento='$descuento',
            fechareg='$fechareg',
            nomtitular='$nomtitular'  
            WHERE codigo='$codigo'");

            $resultadoup=mysqli_query($connect, $insertarup);
            $modificados++;
        }

       
        
    }

    
      echo '<div>'. $i. "). " .$linea.'</div>';
    $i++;
}


  echo '<p>Total de Registros nuevos agregados: '. $nuevos .'</p>';
  echo '<p>Total de Registros repetidos o modificados: '. $modificados .'</p>';

  if($resultado || $resultadoup){
    echo "Todo bien, todo correcto :D";
}else{
    echo "Ocurrió un error";
}


?>

<a href="../medicamentos.php">Regresar a la tabla medicamentos</a>



