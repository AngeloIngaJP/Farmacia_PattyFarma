<?php

session_start();

if(isset($_SESSION['usuario'])){
  $varsession = $_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellido'];

  if($_SESSION['usuario']['tipo']!=1){
    header("Location: ../pagesuser/medicamentos.php");
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
    <title>Bajo Stock</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/styledashgeneral.css">
    <link rel="stylesheet" href="../css/stylemedicamentos.css">
    <link rel="stylesheet" href="../css/styletable.css">

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
                <a href="dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="medicamentos.php">
                    <i class="fas fa-capsules"></i>
                    <span class="links_name">Medicamentos</span>
                </a>
                <span class="tooltip">Medicamentos</span>
            </li>
            <li>
                <a href="usuarios.php">
                    <i class="fas fa-user"></i>
                    <span class="links_name">Usuarios</span>
                </a>
                <span class="tooltip">Usuarios</span>
            </li>
            <li>
                <a href="stock.php">
                  <i class="fas fa-sort-amount-down"></i>
                  <span class="links_name">Bajo Stock</span>
                </a>
                <span class="tooltip">Bajo stock</span>
            </li>
            <li>
                <a href="pedidos.php">
                    <i class="fas fa-layer-group"></i>
                    <span class="links_name">Pedidos</span>
                </a>
                <span class="tooltip">Pedidos</span>
            </li>
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
            $sql = "SELECT * FROM tabla_medicamentos ORDER BY id DESC";
            $resultado = mysqli_query($connect, $sql);
            $num_consultas = mysqli_num_rows($resultado);
            $contador=0;
            for ($i=0;$i<$num_consultas;$i++){
                $row2=mysqli_fetch_array($resultado);
                if($row2['stock']<=10){
                    $contador++;
                }
            }

            $resultado2 = mysqli_query($connect, $sql);
            $num_consultas2 = mysqli_num_rows($resultado2);

    ?> 
    <main class="home-section">

        <div class="header_main">
            <div class="header_content">
                <h1 class="text">Medicamentos con  bajo stock</h1>

                <div class="user_wrapper">
                    <img src="../assets/avataradmin.png" width="50px" height="50px" alt="">
                    <div>
                        <h4><?php echo $varsession;?></h4>
                        <small>Administrador</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="cards_container">
      
            <div class="single_card">
              <div class="card_icon">
                <span class='fas fa-sort-amount-down icon_card'></span>
              </div>
              <div class="value_card">
                <span class="text_card">Medicamentos con bajo stock</span>
                <h1 class="number_card"><?php echo $contador;?></h1>
              </div>
              <div class="increased">
                <i class="fas fa-chart-line"></i>
                <p>Aumentó en un 15%</p>
              </div>
            </div>
      
        </div>

        <div class="medicaments_container stock_container">

            <div class="medicaments">
                <div class="card_table">
                    <div class="card-header">
                        <h3>Lista de medicamentos con bajo stock</h3>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%">
                                <thead>
                                <tr>
                                    <td>Código</td>
                                    <td>Nombre</td>
                                    <td>Stock</td>
                                    <td>Foto</td>
                                </tr>
                                </thead>
                                <tbody class="body_user">
                                    <?php
                                        for ($i=0;$i<$num_consultas2;$i++){
                                        $row=mysqli_fetch_array($resultado2);
                                        if($row['stock']<=10){
                    
                                    ?>
                                    <tr class="tr_medicament">
                                        <td><?php echo $row['codigo']?></td>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['stock'] ?></td>
                                        <td><img class="img_medicament" src="data:image/jpg;base64,<?php echo base64_encode($row['foto']) ?>" alt=""></td>
                                    </tr>
                                    <?php
                                        }
                                } ?>

                                </tbody>
                            </table>



                        </div>
                    </div>

                </div>

            </div>
        </div>   


    </main>

    <script src="../js/script.js"></script>


</body>

</html>