
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
    <title>Medicamentos | Usuario</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/styledashgeneral.css">
    <link rel="stylesheet" href="../css/stylemedicamentos.css">
    <link rel="stylesheet" href="../css/styletable.css">
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
                    <span class="links_name">Cerrar Sesi??n</span>
                </a>
                <span class="tooltip">Cerrar sesi??n</span>
            </li>

        </ul>
    </div>


      <?php
            include("con_db.php");
            $sql = "SELECT * FROM tabla_medicamentos";
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
                <h1 class="text">Medicamentos</h1>

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

        <div class="cards_container">
      
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
                <p>Aument?? en un 15%</p>
              </div>
            </div>
      
        </div>

        <div class="medicament_container">

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

        <div class="medicaments_container">

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

    <script src="../js/searchmeduser.js"></script>
    <script src="../js/script.js"></script>


</body>

</html>