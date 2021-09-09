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



$salida = "";
$consulta = "SELECT * FROM tabla_medicamentos ORDER BY id DESC";

if(isset($_POST['consulta'])){
    $q = $connect->real_escape_string($_POST['consulta']);
    $consulta = "SELECT * FROM tabla_medicamentos WHERE nombre LIKE '%".$q."%'";
}

$resultado = mysqli_query($connect, $consulta);
$num_resultados = mysqli_num_rows($resultado);

if($num_resultados > 0){

    echo "
    <table id='tablita' width='100%'>
        <thead>
            <tr>
                <td>Código</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Stock</td>
                <td>Descuento</td>
                <td>Fecha Registro</td>
                <td>Nombre del titular</td>
                <td>Foto</td>
                <td>Acciones</td>
            </tr>
        </thead>
            <tbody class='body_user'>";

            for ($i=0;$i<($num_resultados);$i++){
                $row= $resultado->fetch_array();
                $date = $row['fechareg'];
                $newDate = date("d-m-Y", strtotime($date));
                echo "
                <tr class='tr_medicament'>
                    <td>".$row['codigo']."</td>
                    <td>".$row['nombre']."</td>
                    <td>S/ ".number_format($row['precio'],2)."</td>
                    <td>".$row['stock']."</td>
                    <td>".$row['descuento']."</td>
                    <td>".$newDate."</td>
                    <td>".$row['nomtitular']."</td>
                    <td><img class='img_medicament' src='data:image/jpg;base64,".base64_encode($row['foto'])."' alt=''></td>
                    <td>
                    <a href='crudphp/modificar.php?codigo=".$row['codigo']."'>Modificar</a>
                                                <a href='crudphp/eliminar.php?codigo=".$row['codigo']."'>Eliminar</a>
                    </td>
                </tr>";
            }
    echo    "</tbody>
    </table>";
    

} else{
    echo "
    <div class='container_noresults'>

        <div class='noresults_img'>
            <img class='img_noresults' src='../assets/Noresults_med.png' alt='Dont found'>
        </div>

        <div class='noresults_text'>
            <p class='text_noresults'>No se encontró resultados :(</p>
        </div>

    </div>
    ";
}

mysqli_close($connect);

?>
