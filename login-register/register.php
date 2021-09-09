
<?php

session_start();


if(isset($_SESSION['usuario'])){
  switch($varsession['tipo']){
    case 0:
        header("Location: ../pagesuser/medicamentos.php");
        break;
    case 1:
        header("Location: ../pages/dashboard.php");
        break;
    default:
        header("Location: login.php");
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css_main/styleregister.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <title>Registro</title>
</head>

<body>
    <div class="register_container">
        <div class="img_container">
            <img src="../assets/imgregister.jpg" alt="">
        </div>
        <div class="form_container">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/LogoPattyFarma.png" alt="">
                </a>

            </div>
            <div class="form_boxcontainer">

            </div>
            <div class="form_box">
                <h2>Crear cuenta</h2>
                <form id="Register" action="" name="formregister" class="form_content">
                    <div class="input_content input_complete input_sep">
                        <div class="input_flex">
                            <span class="input_title">Nombre</span>
                            <div class="input_style">
                                <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="input">
                                    <input name="nombre" class="input_ip" type="text">                                                 
                                </div>
                            </div>
                        </div>

                        <div class="input_flex">
                            <span class="input_title">Apellido</span>
                            <div class="input_style">
                                <span class="icon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="input">
                                    <input name="apellido" class="input_ip" type="text">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="input_content input_complete input_email">
                        <span class="input_title">Correo Electrónico</span>
                        <div class="input_style">
                            <span class="icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <div class="input">
                                <input name="email" class="input_ip" type="email">
                            </div>
                        </div>
                        
                    </div>

                    <div class="input_content input_complete input_sep">
                        <div class="input_flex">
                            <span class="input_title">Contraseña</span>
                            <div class="input_style">
                                <span class="icon">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <div class="input">
                                    <input name="pass" class="input_ip" type="password" id="password">
                                </div>
                                <span class="clear" onclick="MostrarOcultar();">
                                    <i class="fas fa-eye-slash" id="eye"></i>
                                </span>
                            </div>
                        </div>
                        <div class="input_flex">
                            <span class="input_title">Confirmar contraseña</span>
                            <div class="input_style">
                                <span class="icon">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <div class="input">
                                    <input name="confpass" class="input_ip" type="password" id="passwordconf">
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <div class="input_content">
                        <span class="input_title">Sexo</span>
                        <br>
                        <div class="input_select">
                            <div class="box_select">
                                <select name="sexo" id="">
                                    <option selected disabled>Elija una opción</option>
                                    <option value="Hombre" selected>Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                </select>
                            </div>
                           
                        </div>
                       
                    </div>

                    <center><div id="respuesta"></div></center>

                    <div class="input_content input_button">
                        <button type="button" id="btnRegister">Registrarse</button>
                    </div>

                  <!--   <div class="input_content redes_content">
                        <p class="title_addredes">O registrate con</p>
                        <div class="addredes_content">
                            <a class="button_addred" href="#">
                                <div class="addred">
                                    <i class="fab fa-google"></i>
                                    <p>Google</p>
                                </div>
                            </a>
                            <a class="button_addred" href="#">
                                <div class="addred">
                                    <i class="fab fa-facebook"></i>
                                    <p>Facebook</p>
                                </div>
                            </a>
                            
                            
                        </div>

                    </div> -->

                    <div class="input_content text_register">
                        <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar Sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>


    $('#btnRegister').click(function () {

        $.ajax({
            url: 'procesoregister.php',
            type: 'POST',
            data: $('#Register').serialize(),

        })
        .done(function (res) {
            $('#respuesta').html(res);
        })
        .fail(function () {
            console.log('Error');
        })
        .always(function () {
            console.log("complete");
        });


    });

    function MostrarOcultar(){
        let tipo = document.getElementById("password");
        let tipoconf = document.getElementById("passwordconf");
        let eye = document.getElementById("eye");

        if(tipo.type == 'password'){
            tipo.type = 'text';
            tipoconf.type = 'text';
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
        }else{
            tipo.type = 'password';
            tipoconf.type = 'password';
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
        }
    }

</script>

</html>