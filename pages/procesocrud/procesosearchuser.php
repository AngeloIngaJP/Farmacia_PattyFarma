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
$consulta = "SELECT * FROM tabla_usuarios ORDER BY id DESC";

if(isset($_POST['consulta'])){
    $q = $connect->real_escape_string($_POST['consulta']);
    $consulta = "SELECT * FROM tabla_usuarios WHERE nombre LIKE '%".$q."%'";
}

$resultado = mysqli_query($connect, $consulta);
$num_resultados = mysqli_num_rows($resultado);

if($num_resultados > 0){

    echo "
    <table id='tablita' width='100%'>
        <thead>
            <tr>
                <td>Código</td>
                <td>Nombres</td>
                <td>Apellidos</td>
                <td>Sexo</td>
                <td>Correo Electrónico</td>
                <td>Estado</td>
                <td>Fecha Registro</td>
                <td>Acciones</td>
            </tr>
        </thead>
            <tbody class='body_user'>";

            for ($i=0;$i<($num_resultados);$i++){
                $row= $resultado->fetch_array();
                if($row['tipo']==0){
                $date = $row['fechareg'];
                $newDate = date("d-m-Y", strtotime($date));
                echo "
                <tr class='tr_medicament'>
                    <td>".$row['codigo']."</td>
                    <td>".$row['nombre']."</td>
                    <td>".$row['apellido']."</td>
                    <td>".$row['sexo']."</td>
                    <td>".$row['email']."</td>
                    <td>";
                    if($row['activo']==1){
                       echo "<span class='status green'></span>Activo";
                    }else{
                       echo " <span class='status red'></span>Inactivo ";
                    }
                    echo "</td>
                    <td>".$newDate."</td>
                    <td>
                    <a class='delete_user' href='crudphp/eliminaruser.php?codigo=".$row['codigo']."'>Eliminar</a>
                    </td>
                </tr>";
                }
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