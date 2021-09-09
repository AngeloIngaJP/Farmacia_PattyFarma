<?php

include("../pages/con_db.php");


$email = $_POST['email'];
$pass = $_POST['pass'];

if (!empty($email) && !empty($pass)) {

    $consulta = "SELECT * FROM tabla_usuarios WHERE email = '$email' and activo = '1'";
    $resultado = mysqli_query($connect, $consulta);
    $coincidencia = mysqli_num_rows($resultado);
    $buscarpass = mysqli_fetch_array($resultado);

    

    if ( ($coincidencia > 0) && (password_verify($pass, $buscarpass['pass'])) ){

        session_start();

        $query = "SELECT * FROM tabla_usuarios WHERE email = '$email'";
        $result = mysqli_query($connect, $query);
        $row= $result->fetch_array();

        /* $_SESSION['usuario'] = $row['nombre']." ".$row['apellido']; */
        $_SESSION['usuario'] = $row;
        

        if($row['tipo']==0){
            echo "<script>location.href='../pagesuser/medicamentos.php';</script>";
        }else if($row['tipo']==1){
            echo "<script>location.href='../pages/dashboard.php';</script>";
        }else{
            echo "<script>location.href='login.php';</script>";
        }
        

    }else{
        $consultasec = "SELECT * FROM tabla_usuarios WHERE email = '$email' and activo = '0'";
        $resultadosec = mysqli_query($connect, $consultasec);
        $coincidenciasec = mysqli_num_rows($resultadosec);
        $buscarpassw = mysqli_fetch_array($resultadosec);

        if (($coincidenciasec > 0) && (password_verify($pass, $buscarpassw['pass'])) ){
            echo "<div class=container-message>
        <h3 class=noact><center>Su cuenta no ha sido activada</center></h3>
        <h3 class=noact>Por favor, haga clic en el enlace que se envío a su correo</h3>
        </div>";
        }     
        else{
            echo "<div class=container-message>
            <h3 class=uso>Los datos introducidos no pertenecen a una cuenta</h3>
            </div>";
        }

    }

} else {

    echo "<div class=container-message>
    <h3 class=med>¡Por favor, complete los campos!</h3>
    </div>";

}

mysqli_close($connect);

?>