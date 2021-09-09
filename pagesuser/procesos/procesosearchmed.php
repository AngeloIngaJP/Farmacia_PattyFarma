<?php


include("../con_db.php");

session_start();

$salida = "";
$consulta = "SELECT * FROM tabla_medicamentos ORDER BY nombre ASC";

if(isset($_POST['consulta'])){
    $q = $connect->real_escape_string($_POST['consulta']);
    $consulta = "SELECT * FROM tabla_medicamentos WHERE nombre LIKE '%".$q."%'";
}

$resultado = mysqli_query($connect, $consulta);
$num_resultados = mysqli_num_rows($resultado);



$query = "SELECT * FROM miscompras";


if($num_resultados > 0){

    echo "
    <table id='tablita' width='100%'>
        <thead>
            <tr>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Descuento</td>
                <td>Foto</td>
                <td>Acciones</td>
            </tr>
        </thead>
            <tbody class='body_user'>";

            for ($i=0;$i<($num_resultados);$i++){
                $temp=0;
                $row= $resultado->fetch_array();
                $queryresultado = mysqli_query($connect, $query);
                echo "
                <tr class='tr_medicament'>
                    <td>".$row['nombre']."</td>
                    <td>S/ ".number_format($row['precio'],2)."</td>
                    <td>".$row['descuento']."</td>
                    <td><img class='img_medicament' src='data:image/jpg;base64,".base64_encode($row['foto'])."' alt=''></td>";
                        
                        
                        
                        $query_consultas = mysqli_num_rows($queryresultado);
                        for ($j=0;$j<$query_consultas;$j++){
                            $rowquery=$queryresultado->fetch_array();
                            

                            if($row['codigo']==$rowquery['codigoproducto'] && $rowquery['comprador']==$_SESSION['usuario']['codigo']){
                                $temp=1;
                                $j=$query_consultas;
                            }

                        }

                        if($temp==1){
                            echo "<td><button type='button' class='button_adquiridotemp'>Adquirido</button> </td>";
                            
                            
                        }else{
                            echo "<td><a class='button_adquirir' href='procesos/adquirir.php?codigo=".$row['codigo']."'>Adquirir</a></td>";
                        }
                       

                    echo"
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