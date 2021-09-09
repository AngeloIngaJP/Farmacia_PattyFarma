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
  <title>Usuarios</title>
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <link rel="stylesheet" href="../css/styledashgeneral.css">
  <link rel="stylesheet" href="../css/stylemedicamentos.css">
  <link rel="stylesheet" href="../css/styleusuarios.css">
  <link rel="stylesheet" href="../css/styletable.css">
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
            $sql = "SELECT * FROM tabla_usuarios";
            $resultado = mysqli_query($connect, $sql);
            $num_consultas = mysqli_num_rows($resultado);
            $cont1 = 0;
            $cont2 = 0;
            for ($i=0;$i<$num_consultas;$i++){
              $row2=mysqli_fetch_array($resultado);
              if($row2['activo']==1 && $row2['tipo']==0){
                $cont1++;
              }else if($row2['activo']==0 && $row2['tipo']==0){
                $cont2++;
              }
          }


    ?> 

  <main class="home-section">

    <div class="header_main">
      <div class="header_content">
        <h1 class="text">Usuarios</h1>

        <div class="user_wrapper">
          <img src="../assets/avataradmin.png" width="50px" height="50px" alt="">
          <div>
            <h4><?php echo $varsession;?></h4>
            <small>Administrador</small>
          </div>
        </div>
      </div>
    </div>

    <div class="cards_userprimary">
      
      <div class="single_card single_cardprimary">
        <div class="card_icon">
          <span class='fas fa-user-plus icon_card'></span>
        </div>
        <div class="value_card">
          <span class="text_card">Total de usuarios activos</span>
          <h1 class="number_card"><?php echo $cont1;?></h1>
        </div>
        <div class="increased">
          <i class="fas fa-chart-line"></i>
          <p>Aumentó en un 15%</p>
        </div>
      </div>

      <div class="single_card single_cardprimary">
        <div class="card_icon">
          <span class='fas fa-user-minus icon_card'></span>
        </div>
        <div class="value_card">
          <span class="text_card">Total de usuarios inactivos</span>
          <h1 class="number_card"><?php echo $cont2;?></h1>
        </div>
        <div class="increased">
          <i class="fas fa-chart-line"></i>
          <p>Aumentó en un 15%</p>
        </div>
      </div>

  </div>

    <div class="user_container">

     <!--  <h1 class="title">Tabla de usuarios</h1> -->

      <div class="search active">

        <span class="icon">
          <i class="fas fa-search"></i>
        </span>

        <div class="input">
          <input type="text" name="caja_busqueda" id="caja_busqueda" placeholder="Nombre"></input>
        </div>
        <span class="clear" onclick="Clear();">
          <i class="fas fa-times"></i>
        </span>

      </div>
    </div>

    <div class="users_container">

      <div class="medicaments">
        <div class="card_table">
          <div class="card-header">
            <h3>Lista de medicamentos</h3>

          </div>

          <div class="card-body">
            <div class="table-responsive">
              <div id="respuesta">

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

    




  </main>

  <script src="../js/searchuseradm.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>