<?php

session_start();

if(isset($_SESSION['usuario'])){

  if($_SESSION['usuario']['tipo']!=0){
    header("Location: ../../pages/dashboard.php");
  }
}else{
  header("Location: ../../login-register/login.php");
  die();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adquirir | Usuario</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../../css/styledashgeneral.css">
    <link rel="stylesheet" href="../../css/styletable.css">
    <link rel="stylesheet" href="../css_user/styleadquirir.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>  

    <div class="sidebar">
        <div class="logo-details">
            <a href="../../index.php" class="link_index">
                <i class='bx bxl-c-plus-plus icon'></i>
                <div class="logo_name">PattyFarma</div>
            </a>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="../miperfil.php">      
                    <i class="fas fa-user"></i>
                    <span class="links_name">Mi Perfil</span>
                </a>
                <span class="tooltip">Mi Perfil</span>
            </li>

            <li>
                <a href="../medicamentos.php">
                    <i class="fas fa-capsules"></i>
                    <span class="links_name">Medicamentos</span>
                </a>
                <span class="tooltip">Medicamentos</span>
            </li>
            <li>
                <a href="../descuentos.php">
                    <i class="fas fa-percent"></i>
                    <span class="links_name">Descuentos</span>
                </a>
                <span class="tooltip">Descuentos</span>
            </li>
            <li>
                <a href="../miscompras.php">
                    <i class="fas fa-shopping-basket"></i>
                    <span class="links_name">Mis Compras</span>
                </a>
                <span class="tooltip">Mis Compras</span>
            </li>
            <li>
                <a href="../mispedidos.php">
                    <i class="fas fa-indent"></i>
                  <span class="links_name">Mis Pedidos</span>
                </a>
                <span class="tooltip">Mis Pedidos</span>
              </li>
              <li>
            <li>
                <a href="../cerrarsesion.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="links_name">Cerrar Sesión</span>
                </a>
                <span class="tooltip">Cerrar sesión</span>
            </li>

        </ul>
    </div>


      <?php
            include("../con_db.php");
            $codigo = $_REQUEST['codigo'];
            $sql = "SELECT * FROM tabla_medicamentos WHERE codigo = '$codigo'";
            $resultado = mysqli_query($connect, $sql);
            $row=mysqli_fetch_array($resultado);
            $desc = number_format($row['precioori'],2)-number_format($row['precio'],2);

            $vacod = $_SESSION['usuario']['codigo'];
            $queryvar = "SELECT * FROM tabla_usuarios WHERE codigo='$vacod'";
            $resulvar = mysqli_query($connect, $queryvar);
            $rowa= $resulvar->fetch_array();
            $varsession = $rowa['nombre']." ".$rowa['apellido'];
    ?> 

    <main class="home-section">

        <div class="header_main">
            <div class="header_content">
                <h1 class="text">Adquirir Medicamento</h1>

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

        <div class="medicaments_container">

            <div class="medicaments">
                <div class="card_table">
                    <div class="card-header">
                        <h3>Proceso</h3>

                    </div>

                    <form action="procesoadquirir.php?codigo=<?php echo $row['codigo'];?>" method="POST" enctype="multipart/form-data" class="Formcantidad" id="Formcantidad">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id='tablita' width='100%'>
                                    <thead>
                                        <tr>
                                            <td>Producto</td>
                                            <td>Precio Actual</td>
                                            <td>Cantidad</td>
                                            <td>Detalles</td>
                                        </tr>
                                    </thead>
                                        <tbody class='body_user'>
                                            <tr class='tr_medicament'>
                                                <td>
                                                    <div class="container_productimg">
                                                        <div class="img_product">
                                                            <img src="data:image/jpg;base64,<?php echo base64_encode($row['foto']);?>" alt="">
                                                        </div>
                                                        <div class="content_product">
                                                            <p class="nombre"><b>Nombre: </b> <?php echo $row['nombre'];?></p>
                                                            <p class="precioori"><b>Precio Original: </b> S/ <?php echo number_format($row['precioori'],2)?></p>
                                                            <p class="preciodesc"><b>Precio Oferta: </b> S/ <?php echo number_format($row['precio'],2)?></p>
                                                            <p class="descuento"><b>Descuento: </b> <?php echo $row['descuento']?></p>
                                                            <p class="nomtitular"><b>Titular: </b> <?php echo $row['nomtitular']?></p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    S/ <span id="totalprice" name="precio" id="precioactual"><?php echo number_format($row['precio'],2)?></span>
                                                </td>
                                                
                                                <td>
                                                    <select class="cantidadSelect" name="cantidad" id="Selectcant" onchange="Seleccionado(<?php echo number_format($row['precio'],2)?>, <?php echo number_format($row['precioori'],2)?>);">
                                                        <option value="1" selected>1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </td>
                                                
                                                <td> 
                                                    <div class="detalles_content">
                                                        <div class="monto_content">Monto a pagar: 
                                                            <span class="SolesTotal">S/ </span>
                                                            <span id="resultado1"><?php echo number_format($row['precio'],2)?></span>
                                                        </div>      

                                                        <div class="descuento_content">Descuento total: 
                                                        <span class="SolesDesc">S/ </span>
                                                            <span id="resultado2"><?php echo number_format($desc,2)?></span>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </td>
                                            
                                            </tr>
                                    
                                        </tbody>
                                </table>

                                <div class="input_comprar">
                                    <input class="imput_submitcompra" type="submit" value="Hacer compra">
                                </div>

                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>   

        
    

    </main>

    <script src="../js/Select.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>