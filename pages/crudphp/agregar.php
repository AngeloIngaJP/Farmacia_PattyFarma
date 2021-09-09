
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
    <link rel="stylesheet" href="csscrud/styleagregar.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Agregar Medicamento</title>
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

        <div class="form_container">
                
            <div class="form_box">
                <h2>Rellenar el formulario</h2>

                <form class="form_content" action="../procesocrud/procesoagregar.php" method="POST" enctype="multipart/form-data">
                    <div class="input_content input_complete input_sep">
                        <div class="input_flex">
                            <span class="input_title">Nombre</span>
                            <div class="input_style">
                                <span class="icon">
                                        <i class="fas fa-user"></i>
                                </span>
                                <div class="input">
                                    <input type="text" REQUIRED name="nombre">                                            
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
                                <input type="number" step="any" REQUIRED name="precio">                                         
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input_content input_sep">
                        <div class="input_flex inputselectbox">
                            <span class="input_title">Descuento</span>
                            <br>
                            <div class="input_select">
                                <div class="box_select">
                                    <select name="descuento" id="">
                                        <option selected disabled>Elija una opción</option>
                                        <option value="Aplica" selected>Aplica</option>
                                        <option value="No aplica">No aplica</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input_flex inputselectbox">
                            <span class="input_title">Nombre del Titular</span>
                            <br>
                            <div class="input_select">
                                <div class="box_select">
                                    <select name="titular" id="">
                                        <option selected disabled>Elija una opción</option>
                                        <option value="Medifarma" selected>Medifarma</option>
                                        <option value="Farmindustria">Farmindustria</option>
                                        <option value="Novax">Novax</option>
                                        <option value="Mega Labs">Mega Labs</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input_content input_sep">
                        <div class="input_flex laterinputfile">
                            <span class="input_title">Stock</span>
                            <div class="input_style">
                                <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="input">
                                    <input type="number" REQUIRED name="stock">                                       
                                </div>
                            </div>
                        </div>
                        
                        <div class="input_flex inputselectbox">
                            <span class="input_title">Foto</span>

                            <br>

                                <!-- <input type="file" id="btn-file"> -->
                            <input REQUIRED type="file" name="foto" id="real-file" hidden="hidden" />
                            <button type="button" id="custom-button">Seleccionar archivo</button>
                            <span id="custom-text">Seleccione imagen</span>
                            

                        
                            <div id="preview">
                                <span>Sin imagen</span>
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
                                   /*  customTxt.innerHTML = realFileBtn.value.match(
                                    /[\/\\]([\w\d\s\.\-\(\)]+)$/
                                    )[1]; */
                                } else {
                                    customTxt.innerHTML = "Seleccione imagen";
                                }
                                });




                                document.getElementById("real-file").onchange = function (e) {
                                // Creamos el objeto de la clase FileReader
                                let reader = new FileReader();

                                // Leemos el archivo subido y se lo pasamos a nuestro fileReader
                                reader.readAsDataURL(e.target.files[0]);

                                // Le decimos que cuando este listo ejecute el código interno
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

                        <input class="inputsubmit" type="submit" value="Registrar">
                    </div>


                </form>

                

            </div>


        </div>

    </main>


    <script src="../../js/script.js"></script>
</body>
</html>