
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
    <title>Mis Compras | Usuario</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="../css/styledashgeneral.css">
    <link rel="stylesheet" href="css_user/stylemiscompras.css">

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
            $sql = "SELECT * FROM miscompras WHERE comprador='$usuario' ORDER BY id DESC";
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
                <h1 class="text">Mis Compras</h1>

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

     
        <div class="miscompras_container">

            <h2 class="miscompras_title">Los siguientes productos son los seleccionados a comprar</h2>

            <div class="cardscompras_container">

                <?php 
                
                
                if($num_consultas>0){
                    for ($i=0;$i<($num_consultas);$i++){
                        $row= $resultado->fetch_array(); 
                        
                        ?>
    
                        <div class="single_carddesc">
    
                            <div class="img_desc">
                                <img src="data:image/jpg;base64,<?php echo $row['foto'];?>" alt="" class="descimg">
                            </div>
                            <p class="med_title"><?php echo $row['nombre'] ?></p>
                            <div class="precioori">
                                <p class="textori">Cantidad: </p>
                                <p class="priceori"><b><?php echo $row['cantidad']?></b></p>   
                            </div>
                            <div class="precioori">
                                <p class="textori">Monto a pagar: </p>
                                <p class="priceori"><b>S/ <?php echo number_format($row['preciototal'],2)?></b></p>   
                            </div>
                            <div class="preciodesc">
                                <p class="textdesc">Descuento total: </p>
                                <p class="pricedesc"><b>S/ <?php echo number_format($row['descuentototal'],2)?></b></p>   
                            </div>
    
    
    
                            <a class='cart_button' href="procesos/procesocancelar.php?codigo=<?php echo $row['codigoproducto'];?>">
                                Cancelar
                            </a>
    
                        </div>
    
                    <?php 
                        
                        
                    }
                }else{ ?>
                    <div class="noproducts_container">
                        <h1 class="title_noproducts">No hay productos seleccionados</h1>
                        <img class="noproducts_img" src="https://img.icons8.com/fluency/452/add-shopping-cart.png"/>
                    </div>
                
                <?php }     ?>  
                
                
                
            </div>


            <?php if($num_consultas>0){ ?>
            <div class="miscompras_details">

                <div class="totalproductos">
                    <p class="totalproductos_text">Total de productos seleccionados: </p>
                    <p class="totalproductos_value">
                        
                        <?php 

                            $totalproductos = 0;
                            $totalcosto = 0;
                            $totaldescuento = 0;
                        
                        $resultado = mysqli_query($connect, $sql);
                        $num_consultas = mysqli_num_rows($resultado);
                        
                        for ($i=0;$i<($num_consultas);$i++){
                            $row= $resultado->fetch_array(); 
                           
                                $totalproductos = $totalproductos + $row['cantidad'];
                                  
                        }?>
                        <?php echo $totalproductos;?>
                    </p>
                </div>

                <div class="montototal">
                    <p class="montototal_text">Monto total a pagar: </p>
                    <p class="montototal_value">S/ 
                        <?php 
                        
                        $resultado = mysqli_query($connect, $sql);
                        $num_consultas = mysqli_num_rows($resultado);

                        for ($i=0;$i<($num_consultas);$i++){
                            $row= $resultado->fetch_array(); 
                           
                                $totalcosto = $totalcosto + $row['preciototal'];
                                    
                        }?>
                        <?php echo number_format($totalcosto,2);?>
                    </p>
                </div>

                <div class="descuentototal">
                    <p class="descuentototal_text">Monto total de descuento: </p>
                    <p class="descuentototal_value">S/ 
                        <?php 
                        
                        $resultado = mysqli_query($connect, $sql);
                        $num_consultas = mysqli_num_rows($resultado);
                        
                        for ($i=0;$i<($num_consultas);$i++){
                            $row= $resultado->fetch_array(); 
                            
                                $totaldescuento = $totaldescuento + $row['descuentototal'];
                                
                        }?>
                        <?php echo number_format($totaldescuento,2);?>
                    </p>
                </div>        

            </div>

            <div class="metodofecha_container">

                <form class="form_metdate" action="procesos/procesofinalizarcompra.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="container_metdate">

                        <div class="container_metodo">

                            <p class="title_metodo">Método de pago: </p>

                            <div class="input_metdate">
                                <div class="box_select">
                                    <select name="metodo_pago" id="">
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta de Debito">Tarjeta de Debito</option>
                                        <option value="Tarjeta de Credito">Tarjeta de Credito</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        

                        <div class="container_fecharecojo">
                            <p class="title_recharecojo">
                                Fecha de recojo: 
                            </p>
                        
                            <div class="inputdate_content">
                                
                                <input name="fecha_recojo" class="input_date" type="date" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?>>
                                
                            </div>

                        </div>

                    </div>


                    <div class="container_submitcompras">
                      
                        <input type="submit" class="submit_compras" value="Finalizar compra">

                        <a href="medicamentos.php" class="submit_compras submit_seguir">Seguir comprando</a>
                        
                    </div>
                    
                    

                </form>

            </div>

            <?php }else{ ?>
                
                <div class="noinfo_container">
                    <a href="medicamentos.php" class="submit_compras submit_seguir">Seguir comprando</a>
                </div>

                
                <?php } ?>

        </div>


    </main>

    <script src="../js/script.js"></script>


</body>

</html>