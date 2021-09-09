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
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../css/styledashgeneral.css">
  <link rel="stylesheet" href="../css/styledashboard.css">
  <link rel="stylesheet" href="../css/styletable.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
          <i class="fas fa-th-large"></i>
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

            $sql2 = "SELECT * FROM tabla_usuarios ORDER BY id DESC";
            $resultado2 = mysqli_query($connect, $sql2);
            $num_consultas2 = mysqli_num_rows($resultado2);

            $resultuser = mysqli_query($connect, $sql2);
            $num_users = mysqli_num_rows($resultuser);
            $numusers = 0;
            for ($i=0;$i<$num_users;$i++){
              $row=mysqli_fetch_array($resultuser);
              if($row['tipo']==0){
                $numusers++;
              }
            }

            $sql3 = "SELECT * FROM mispedidos";
            $resultado3 = mysqli_query($connect, $sql3);
            $num_consultas3 = mysqli_num_rows($resultado3);
            $numpedidos = 0;
            for ($i=0;$i<$num_consultas3;$i++){
              $row=mysqli_fetch_array($resultado3);
              if($row['estado']=="Pendiente"){
                $numpedidos++;
              }
            }
  ?> 

  <main class="home-section">

    <div class="header_main">
      <div class="header_content">
        <h1 class="text">Dashboard</h1>

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
          <span class='fas fa-users icon_card'></span>
        </div>
        <div class="value_card">
          <span class="text_card">Total de usuarios</span>
          <h1 class="number_card"><?php echo $numusers;?></h1>
        </div>
        <div class="increased">
          <i class="fas fa-chart-line"></i>
          <p>Aumentó en un 54%</p>
        </div>
      </div>

      <div class="single_card">
        <div class="card_icon">
          <span class='fas fa-prescription-bottle-alt icon_card'></span>
        </div>
        <div class="value_card">
          <span class="text_card">Total de medicamentos</span>
          <h1 class="number_card"><?php echo $num_consultas;?></h1>
        </div>
        <div class="increased">
          <i class="fas fa-chart-line"></i>
          <p>Aumentó en un 15%</p>
        </div>
      </div>

      <div class="single_card">
        <div class="card_icon">
          <span class="fas fa-layer-group icon_card"></span>
        </div>
        <div class="value_card">
          <span class="text_card">Total de pedidos</span>
          <h1 class="number_card"><?php echo $numpedidos;?></h1>
        </div>
        <div class="increased">
          <i class="fas fa-chart-line"></i>
          <p>Aumentó en un 25%</p>
        </div>
      </div>

    </div>

    <div class="recent-grid">
      <div class="medicaments">
        <div class="card_table">
          <div class="card-header">
            <h3>Medicamentos recientes</h3>

          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table width="100%">
                <thead>
                  <tr>
                    <td>Código</td>
                    <td>Nombre</td>
                    <td>Precio</td>
                    <td>Stock</td>
                    <td>Fecha Registro</td>
                  </tr>
                </thead>
                <tbody class="body_medicament">
                  <?php
                    for ($i=0;$i<$num_consultas;$i++){
                    $row=mysqli_fetch_array($resultado);
                    if($i==10){
                      $i=$num_consultas;
                    }else{

                    
                  ?>
                  <tr class="tr_medicament">
                    <td><?php echo $row['codigo']?></td>
                    <td><?php echo $row['nombre'] ?></td>
                    <td>S/ <?php echo number_format($row['precio'],2) ?></td>
                    <td><?php echo $row['stock'] ?></td>
                    <td><?php echo $row['fechareg'] ?></td>
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

      <div class="users">

        <div class="card_table">
          <div class="card-header">
            <h3>Nuevos usuarios</h3>

          </div>

          <div class="card-body">

            <div class="table-responsive">
              <table width="100%">
                <thead>
                  <tr>
                    <td class="tr_name">Nombre</td>
                    <td class="tr_state">Estado</td>
                  </tr>
                </thead>
                <tbody class="body_user">
                  <?php
                    for ($i=0;$i<$num_consultas2;$i++){
                    $row=mysqli_fetch_array($resultado2);
                    if($i==10){
                      $i=$num_consultas2;
                    }else{

                      if($row['tipo']==0){

                  ?>
                    <tr>
                      <td>
                        <div class="user_content">
                          <img class="img_profile" src="../assets/avataruser.png" width="40px" height="40px" alt="">
                          <div class="user_contact">
                            <h4><?php echo $row['nombre']; echo " "; echo $row['apellido']?></h4>
                            <small>Usuario</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php 
                          if($row['activo']==1){
                        ?>
                        <span class="status green"></span>Activo
                        <?php } else { ?>

                          <span class="status red"></span>Inactivo 
                          <?php }?>
                      </td>
                    </tr>

                  <?php
                        }
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