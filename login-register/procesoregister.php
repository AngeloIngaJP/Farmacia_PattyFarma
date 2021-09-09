<?php
include("../pages/con_db.php");


session_start();

if(isset($_SESSION['usuario'])){

  if($_SESSION['usuario']['tipo']==0){
    header("Location: ../pagesuser/medicamentos.php");
  }else{
    header("Location: ../pages/dashboard.php");
  }
  
}else{
  header("Location: register.php");
  die();
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email =  $_POST['email'];
$pass = $_POST['pass'];
$confpass = $_POST['confpass'];
$sexo =  $_POST['sexo'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PhpMailer/Exception.php';
require '../PhpMailer/PHPMailer.php';
require '../PhpMailer/SMTP.php';


$hash = md5(rand(0,1000));

$mail = new PHPMailer(true);


if (!empty($nombre) && !empty($apellido) && !empty($email)
    && !empty($pass) && !empty($confpass) && !empty($sexo)) {

        if($pass==$confpass){

            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        
                $verificar_email= mysqli_query($connect, "SELECT * FROM tabla_usuarios WHERE email = '$email'");
    
                if (mysqli_num_rows($verificar_email) > 0){
        
                    echo "<div class=container-message>
                    <h3 class=uso>El correo ya está registrado</h3>
                    </div>";   
                    
                }else{

                    date_default_timezone_set('America/Lima');
                    $fechareg = date("Y-m-d");;
        
                    $codigo = rand(1000000, 9999999);
                    $passw = password_hash($pass, PASSWORD_BCRYPT);
                    $consulta = "INSERT INTO tabla_usuarios(codigo, nombre, apellido, sexo, email, fechareg, pass, hash_) VALUES ('$codigo','$nombre','$apellido','$sexo','$email','$fechareg','$passw','$hash')";
                    $result = mysqli_query($connect, $consulta);
        
                    if ($result) {
        
                        try {
        
                            $body = "
                            <div class=entradamsg>¡Hola <b>".$nombre." ".$apellido."</b>! Te damos la bienvenida a la familia de<b> PattyFarma</b></div>
                            <div>Tu cuenta ha sido creada, ahora puedes ingresar con los siguientes datos una vez que actives tu cuenta con el link que está abajo.</div>
                            <br>
                            <div>----------------------------------------------------------------</div>
                            <br>
                            <div>Correo electrónico: ".$email."</div>
                            <div>Contraseña: ".$pass."</div>
                            <br>
                            <div>----------------------------------------------------------------</div>
                            <br>
                            <div>Por favor, haz clic en el siguiente enlace para activar tu cuenta:</div>
                            <br>
                            <div>http://http://localhost:8080/Proyecto%20Final%20DSW/login-register/activar.php?email=".$email."&hash=".$hash."</div>
                            <br>
                            <br>
                            <br>
                            <div>Santa Anita, Berrocales, Palmasa Cabral, Edificio # 27</div>
                            <div>Teléfono contacto: (01) 417-0630<div>
                            <div>PattyFarma | Todos los derechos reservados</div>";
        
        
                                         
        
                            $myemail = 'animalandia.venterinaria0@gmail.com';
                            $mypassword = 'animalandiaveterinaria123';
                            //Server settings
                            $mail->SMTPDebug = 0;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = $myemail;                     //SMTP username
                            $mail->Password   = $mypassword;                               //SMTP password
                            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
                            //Recipients
                            $mail->setFrom($myemail, 'PattyFarma');
                            $mail->addAddress($email);     //Add a recipient
        
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Te damos la bienvenida';
                            $mail->Body    = $body;
                            $mail->Charset = 'UTF-8';
                            $mail->send();
                            //echo 'Mensaje enviado correctamente';
                        } catch (Exception $e) {
                            echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
                        }
        
                        echo "<div class=container-message>
                        <h3 class=ok>Su cuenta ha sido creada exitosamente, verifique su cuenta.</h3>
                        </div>";
                        echo "<SCRIPT language='JavaScript' type='text/javascript'>parent.document.formregister.reset();</SCRIPT>"; 
                        
                    } else {
                
                        echo "<div class=container-message>
                        <h3 class=bad>Ha ocurrido un error</h3>
                        </div>";
        
                    }
                }
        
            }else{
        
                echo "<div class=container-message>
                <h3 class=bad>Por favor, coloque un email válido</h3>
                </div>";
        
            }

        }else{
            echo "<div class=container-message>
            <h3 class=bad>Las contraseñas no coinciden</h3>
            </div>";
        }




}else{

    echo "<div class=container-message>
    <h3 class=med>Por favor, complete los campos</h3>
    </div>";

}

mysqli_close($connect);


?>