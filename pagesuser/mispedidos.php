

<?php

session_start();

if(isset($_SESSION['usuario'])){

  if($_SESSION['usuario']['tipo']!=0){
    header("Location: ../pages/dashboard.php");
  }
}else{
  header("Location: ../login-register/login.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos | Usuario</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/styletable.css">
    <link rel="stylesheet" href="../css/styledashgeneral.css">
    <link rel="stylesheet" href="css_user/stylemedicamentos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>  

    <div class="sidebar">
        <div class="logo-details">
            <a href="../index.php" class="link_index">
                <i class='bx bxl-c-plus-plus icon'></i>
                <div class="logo_name">PattyFarma</div>
            </a>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">

            <li>
                <a href="miperfil.php">      
                    <i class="fas fa-user"></i>
                    <span class="links_name">Mi Perfil</span>
                </a>
                <span class="tooltip">Mi Perfil</span>
            </li>

            <li>
                <a href="medicamentos.php">
                    <i class="fas fa-capsules"></i>
                    <span class="links_name">Medicamentos</span>
                </a>
                <span class="tooltip">Medicamentos</span>
            </li>
            <li>
                <a href="descuentos.php">
                    <i class="fas fa-percent"></i>
                    <span class="links_name">Descuentos</span>
                </a>
                <span class="tooltip">Descuentos</span>
            </li>
            <li>
                <a href="miscompras.php">
                    <i class="fas fa-shopping-basket"></i>
                    <span class="links_name">Mis Compras</span>
                </a>
                <span class="tooltip">Mis Compras</span>
            </li>
            <li>
                <a href="mispedidos.php">
                    <i class="fas fa-indent"></i>
                  <span class="links_name">Mis Pedidos</span>
                </a>
                <span class="tooltip">Mis Pedidos</span>
              </li>
              <li>
            <li>
                <a href="cerrarsesion.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="links_name">Cerrar Sesión</span>
                </a>
                <span class="tooltip">Cerrar sesión</span>
            </li>

        </ul>
    </div>


      <?php
            include("con_db.php");
            $usuario = $_SESSION['usuario']['codigo'];
            $sql = "SELECT * FROM mispedidos WHERE comprador='$usuario' ORDER BY id DESC";
            $resultado = mysqli_query($connect, $sql);
            $num_consultas = mysqli_num_rows($resultado);

            $vacod = $_SESSION['usuario']['codigo'];
            $queryvar = "SELECT * FROM tabla_usuarios WHERE codigo='$vacod'";
            $resulvar = mysqli_query($connect, $queryvar);
            $rowa= $resulvar->fetch_array();
            $varsession = $rowa['nombre']." ".$rowa['apellido'];
    ?> 

    <main class="home-section">

        <div class="header_main">
            <div class="header_content">
                <h1 class="text">Mis Pedidos</h1>

                <div class="user_wrapper">
                    
                    <?php if($rowa['foto']==null){?>

                    <img class="profile_imghead" src="../assets/avataruser.png" alt="">

                    <?php }else{ ?>

                    <img class="profile_imghead" src="data:image/jpg;base64,<?php echo base64_encode($rowa['foto']);?>" alt="">

                    <?php } ?>
                    <div>
                        <h4><?php echo $varsession;?></h4>
                        <small>Usuario</small>
                    </div>
                </div>
            </div>

        </div>

     
        <div class="mispedidos_container">

            <div class="medicaments">
                <div class="card_table">
                <div class="card-header">
                    <h3>Historial de pedidos</h3>
            </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                    <tr>
                                        <td>N°</td>
                                        <td>Productos</td>
                                        <td>Cantidades</td>
                                        <td>Monto total</td>
                                        <td>Descuento total</td>
                                        <td>Método de pago</td>
                                        <td>Fecha de registro</td>
                                        <td>Fecha de recojo</td>
                                        <td>Estado</td>
                                    </tr>
                                </thead>
                                <tbody class="body_medicament">

                                    <?php
                                        for ($i=0;$i<$num_consultas;$i++){
                                            $row=mysqli_fetch_array($resultado);
                                            $productos = $row['productos_each'];
                                            $arrProductos=explode(",",$productos);
                                            $cantidades = $row['cantidad_each'];
                                            $arrCantidades=explode(",",$cantidades);
                                                            
                                    ?>
                                
                                    <tr class="tr_medicament">
                                        <td><?php echo ($i+1); ?></td>
                                        <td>
                                            <?php

                                                for($j=0;$j<sizeof($arrProductos)-1;$j++){
                                                    echo $arrProductos[$j];
                                                    echo "<br>";
                                                }
                                                
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                 for($j=0;$j<sizeof($arrCantidades)-1;$j++){
                                                    echo $arrCantidades[$j];
                                                    echo "<br>";
                                                }
                                            ?>
                                        </td>
                                        <td>S/ <?php echo number_format($row['montototal'],2);?></td>
                                        <td>S/ <?php echo number_format($row['descuentototal'],2) ;?></td>
                                        <td><?php echo $row['metodo_pago'] ;?></td>
                                        <td><?php 
                                        $datemet = $row['fechareg'];
                                        $newDatemet = date("d-m-Y", strtotime($datemet));
                                        echo $newDatemet;
                                        ?></td>
                                        <td><?php 
                                        $date = $row['fecharecojo'];
                                        $newDate = date("d-m-Y", strtotime($date));
                                        echo $newDate;
                                        ?></td>
                                        <td>
                                            <?php 
                                            if($row['estado']=='Pendiente'){
                                            ?>
                                                <span class='status yellow'></span>Pendiente
                                            <?php }else{ ?>   
                                                <span class='status green'></span>Atendido    
                                            <?php } ?>    

                                        </td>
                                    </tr>

                                    <?php
                                            
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

         


        </div>


    </main>

    <script src="../js/script.js"></script>


</body>

</html>