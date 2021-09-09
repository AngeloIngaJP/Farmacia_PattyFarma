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
    <title>Mi Perfil | Usuario</title>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="../css/styledashgeneral.css">
    <link rel="stylesheet" href="css_user/stylemiperfil.css">
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
        
        $vacod = $_SESSION['usuario']['codigo'];
        $queryvar = "SELECT * FROM tabla_usuarios WHERE codigo='$vacod'";
        $resulvar = mysqli_query($connect, $queryvar);
        $rowa= $resulvar->fetch_array();
        $varsession = $rowa['nombre']." ".$rowa['apellido'];
        
    ?>


    <main class="home-section">

        <div class="header_main">
            <div class="header_content">
                <h1 class="text">Mi Perfil</h1>

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


        <div class="container_photodetails">


            <div class="miperfiL_container">

                <p class="title_fotoperfil">Foto de perfil</p>

                <form class="form_fotoperfil" action="procesos/procesomodificarfotouser.php?codigo=<?php echo $_SESSION['usuario']['codigo'];?>" method="POST" enctype="multipart/form-data">

                    <div class="fotoperfil_container">

                        <div class="premod_photo">

                            <div class="preview" id="preview">
                                <?php if($rowa['foto']==null){?>
                                    <span>
                                    
                                        <img id="img_default" class="img_default" src="../assets/avataruser.png" alt="">
                                    </span>
                                <?php }else{
                                    ?>
                                    <span>
                                    <img class="img_default" src="data:image/jpg;base64,<?php echo base64_encode($rowa['foto']);?>" alt="">

                                    </span>
                                <?php } ?>
                            </div>

                        

                            <div class="modify_container">
                                <div class="content_modify">
                                    <input REQUIRED type="file" name="foto" id="real-file" hidden="hidden" />
                                    <button class="button_actualizar" type="button" id="custom-button">Actualizar foto</button>
                                
                                </div>

                                <input class="submit_actualizar" type="submit" value="Guardar">
                                                
                            </div>

                                
                        </div>

                    </div>


                            <script>

                                const realFileBtn = document.getElementById("real-file");
                                const customBtn = document.getElementById("custom-button");
                            

                                customBtn.addEventListener("click", function() {
                                    realFileBtn.click();
                                });

                                document.getElementById("real-file").onchange = function (e) {
                                    let reader = new FileReader();

                                    reader.readAsDataURL(e.target.files[0]);

                                    reader.onload = function () {
                                        let preview = document.getElementById('preview'),
                                            image = document.createElement('img');

                                        image.src = reader.result;

                                        image.classList.add("img_modify");

                                        preview.innerHTML = '';
                                        preview.append(image);
                                    };
                                }
                            </script>

                </form>  

                <form class="form_deletefoto" action="procesos/procesoeliminarfotouser.php?codigo=<?php echo $_SESSION['usuario']['codigo'];?>" method="POST" enctype="multipart/form-data">
                    
                    <input class="delete_foto" type="submit" value="Eliminar foto">

                </form>
            </div>


            <div class="misdetalles_container">

                <div class="title_misdetalles">
                    <p class="header_textdetalles">Detalles de usuario</p>
                    <i class="fas fa-edit icondetalles"></i>
                </div>

                <hr>

                <div class="container_inputs">

                    <form class="form_inputsdetails" action="procesos/procesomodificardetalles.php?codigo=<?php echo $_SESSION['usuario']['codigo'];?>" method="POST">

                        <div class="input_details">
                            <p>Nombre</p>
                            <input required type="text" name="nombre" value="<?php echo $rowa['nombre']?>">
                        </div>

                        <div class="input_details">
                            <p>Apellido</p>
                            <input required type="text" name="apellido" value="<?php echo $rowa['apellido']?>">
                        </div>

                        <div class="input_details">
                            <p>Correo electrónico</p>
                            <input required type="email" name="email" value="<?php echo $rowa['email']?>" readonly>
                        </div>

                        <div class="input_details">
                            <p>Edad</p>
                            <input type="number" name="edad" value="<?php echo $rowa['edad']?>">
                        </div>

                        <div class="input_details">
                            <p>Teléfono</p>
                            <input type="number" name="telefono" value="<?php echo $rowa['telefono']?>">
                        </div>

                        <div class="input_details">
                            <p>Sexo</p>
                            <div class="input_metdate">
                                <div class="box_select">
                                    <select name="sexo" id="">
                                        <option value="Hombre" <?php if($rowa['sexo']=="Hombre"){ echo "selected"; }?>>Hombre</option>
                                        <option value="Mujer" <?php if($rowa['sexo']=="Mujer"){ echo "selected"; }?>>Mujer</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="inputs_formdetails">
                            <div class="submit_detailguard">
                                <input class="submitdetailsform inputsubmit_saved" type="submit" value="Guardar">
                            </div>         
                        </div>

                    </form>



                </div>



            </div>


        </div>              
        

     

    </main>

    <script src="../js/script.js"></script>


</body>

</html>