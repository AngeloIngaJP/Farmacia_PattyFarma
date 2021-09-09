
<?php

session_start();

if(isset($_SESSION['usuario'])){
  $varsession = $_SESSION['usuario']['nombre']." ".$_SESSION['usuario']['apellido'];

  if($_SESSION['usuario']['tipo']!=1){
    header("Location: ../../pagesuser/medicamentos.php");
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
    <link rel="stylesheet" href="../../css/styledashgeneral.css">
    <link rel="stylesheet" href="csscrud/stylemodificar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Modificar Detalles</title>
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
                <a href="../dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="../medicamentos.php">
                    <i class="fas fa-capsules"></i>
                    <span class="links_name">Medicamentos</span>
                </a>
                <span class="tooltip">Medicamentos</span>
            </li>
            <li>
                <a href="../usuarios.php">
                    <i class="fas fa-user"></i>
                    <span class="links_name">Usuarios</span>
                </a>
                <span class="tooltip">Usuarios</span>
            </li>
            <li>
                <a href="../stock.php">
                  <i class="fas fa-sort-amount-down"></i>
                  <span class="links_name">Bajo Stock</span>
                </a>
                <span class="tooltip">Bajo stock</span>
            </li>
            <li>
                <a href="../pedidos.php">
                    <i class="fas fa-layer-group"></i>
                    <span class="links_name">Pedidos</span>
                </a>
                <span class="tooltip">Pedidos</span>
            </li>
            <li>
                <a href="../cerrarsesion.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="links_name">Cerrar Sesión</span>
                </a>
                <span class="tooltip">Cerrar sesión</span>
            </li>

        </ul>
    </div>

    <main class="home-section">

        <div class="header_main">
            <div class="header_content">
                <h1 class="text">Agregar Medicamento</h1>

                <div class="user_wrapper">
                    <img src="../../assets/avataradmin.png" width="50px" height="50px" alt="">
                    <div>
                        <h4><?php echo $varsession;?></h4>
                        <small>Administrador</small>
                    </div>
                </div>
            </div>

        </div>

        <?php
            include("../con_db.php");
            $codigo = $_REQUEST['codigo'];
            $sql = "SELECT * FROM tabla_medicamentos WHERE codigo = '$codigo'";
            $resultado = mysqli_query($connect, $sql);
            $row=mysqli_fetch_array($resultado);
        ?>  

        <div class="form_container">
            <div class="title_formcontainer">
                <h2>Modificar los campos</h2>
            </div>
        
            <div class="form_box">
                

                <form class="form_content" action="../procesocrud/procesomodificar.php?codigo=<?php echo $row['codigo'];?>" method="POST" enctype="multipart/form-data">
                    <div class="input_content input_complete input_sep">
                        <div class="input_flex">
                            <span class="input_title">Nombre</span>
                            <div class="input_style">
                            <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="input">
                                <input type="text" REQUIRED name="nombre" value="<?php echo $row['nombre']?>">                                            
                                </div>
                            </div>
                        </div>

                        <div class="input_flex">
                        <span class="input_title">Precio</span>
                            <div class="input_style">
                            <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="input">
                                <input type="number" step="any" REQUIRED name="precio" value="<?php echo $row['precio'] ?>">                                         
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input_content input_sep">
                        <div class="input_flex">
                            <span class="input_title">Descuento</span>
                            <br>
                            <div class="input_select">
                                <div class="box_select">
                                    <select name="descuento" id="">
                                        <option selected disabled>Elija una opción</option>
                                        <option value="Aplica" <?php if($row['descuento']=="Aplica"){ echo "selected";}?>>Aplica</option>
                                        <option value="No aplica" <?php if($row['descuento']=="No aplica"){ echo "selected";}?>>No aplica</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input_flex">
                            <span class="input_title">Nombre del Titular</span>
                            <br>
                            <div class="input_select">
                                <div class="box_select">
                                    <select name="titular" id="">
                                        <option selected disabled>Elija una opción</option>
                                        <option value="Medifarma" <?php if($row['nomtitular']=="Medifarma" || $row['nomtitular'][1]=='e'){ echo "selected";}?>>Medifarma</option>
                                        <option value="Farmindustria" <?php if($row['nomtitular']=="Farmindustria" || $row['nomtitular'][1]=='a'){ echo "selected";}?>>Farmindustria</option>
                                        <option value="Novax" <?php if($row['nomtitular']=="Novax" || $row['nomtitular'][2]=='v'){ echo "selected";}?>>Novax</option>
                                        <option value="Mega Labs" <?php if($row['nomtitular']=="Mega Labs" || $row['nomtitular'][2]=='g'){ echo "selected";}?>>Mega Labs</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input_content">
                        <div class="input_flex">
                            <span class="input_title">Stock</span>
                            <div class="input_style">
                                <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="input">
                                    <input type="number" REQUIRED name="stock" value="<?php echo $row['stock'] ?>">                                       
                                </div>
                            </div>
                        </div>
                        

                    </div>

                    <div class="input_content input_button">
                        <input class="inputsubmit" type="submit" value="Modificar">
                    </div>

                    

                </form>

                <form class="form_content form_content_input_file" action="../procesocrud/procesomodificarfoto.php?codigo=<?php echo $row['codigo'];?>" method="POST" enctype="multipart/form-data">

                    <div class="input_content input_fileflex">
                        <div class="input_flex mod_foto">
                                <div class="fotoactual">
                                    <span class="input_title">Foto actual</span>
                                    <img class="img_medicament" src="data:image/jpg;base64,<?php echo base64_encode($row['foto']);?>" alt="">
                                </div>
                                
                                <div class="input_file">
                                    <div class="modify_container">
                                        <span class="input_title">Foto modificada</span>
                                        <div class="content_modify">
                                            <input REQUIRED type="file" name="foto" id="real-file" hidden="hidden" />
                                            <button type="button" id="custom-button">Seleccionar archivo</button>
                                            <span id="custom-text">Seleccione imagen</span>
                                        </div>
                                        
                                    </div>


                                    <div id="preview">
                                        <span>Sin imagen</span>
                                    </div>
                                </div>
                        </div>

                        <script>

                            const realFileBtn = document.getElementById("real-file");
                            const customBtn = document.getElementById("custom-button");
                            const customTxt = document.getElementById("custom-text");

                            customBtn.addEventListener("click", function() {
                            realFileBtn.click();
                            });

                            realFileBtn.addEventListener("change", function() {
                            if (realFileBtn.value) {
                                customTxt.innerHTML = "Imagen adjuntada";
                            } else {
                                customTxt.innerHTML = "Seleccione imagen";
                            }
                            });




                            document.getElementById("real-file").onchange = function (e) {
                            let reader = new FileReader();

                            reader.readAsDataURL(e.target.files[0]);

                            reader.onload = function () {
                                let preview = document.getElementById('preview'),
                                    image = document.createElement('img');

                                image.src = reader.result;

                                preview.innerHTML = '';
                                preview.append(image);
                            };
                            }
                        </script>

                    </div>

                    <div class="input_content input_button">
                        <input class="inputsubmit" type="submit" value="Modificar">
                    </div>

                

                </form>

            </div>


        </div>

    </main>

    <script src="../../js/script.js"></script>
</body>
</html>