
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css_main/stylelogin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="login_container">
        <div class="img_container">
                <img src="../assets/imglog.jpg" alt="">
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
                <h2>Iniciar Sesión</h2>
                <form action="#" class="form_content" id="Login">
                    <div class="input_content input_complete">
                        <span class="input_title">Correo Electrónico</span>
                        <div class="input_style">
                            <span class="icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <div class="input">
                                <input class="input_ip" type="email" name="email">
                            </div>
                        </div>
                        
                    </div>
                    <div class="input_content input_complete">
                        <span class="input_title">Contraseña</span>
                        <div class="input_style">
                            <span class="icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <div class="input">
                                <input class="input_ip" type="password" id="password" name="pass">
                            </div>
                            <span class="clear" onclick="MostrarOcultar();">
                                <i class="fas fa-eye-slash" id="eye"></i>
                            </span>
                        </div>
                    </div>

                    <center><div id="respuestah"></div></center>

                    <div class="input_content input_button">
                        <button type="button" id="btnLogin">Ingresar</button>
                    </div>

                   <!--  <div class="input_content redes_content">
                        <p class="title_addredes">O inicia sesión con</p>
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
                        <p>¿Aún no tienes una cuenta? <a href="register.php">Registrarse</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>

    $('#btnLogin').click(function () {

        $.ajax({
            url: 'procesologin.php',
            type: 'POST',
            data: $('#Login').serialize(),

        })
        .done(function (res) {
            $('#respuestah').html(res);
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
        let eye = document.getElementById("eye");

        if(tipo.type == 'password'){
            tipo.type = 'text';
            eye.classList.remove('fa-eye-slash');
            eye.classList.add('fa-eye');
        }else{
            tipo.type = 'password';
            eye.classList.remove('fa-eye');
            eye.classList.add('fa-eye-slash');
        }
    }

</script>

</html>