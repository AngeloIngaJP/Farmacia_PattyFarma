<?php

session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css_main/css_catalogo/styleallcatagolos.css">
    <link rel="stylesheet" href="../../css_main/stylenavegator-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Medicinas</title>
</head>
<body>
    
    <nav class="hero_navegator">
        <a class="hero_logo" href="../../index.php">
            <img class="hero_imglogo" src="../../assets/LogoPattyFarma.png" alt="Logo">
        </a>

        <div class="hero_logsing">

            <?php
                
                if(isset($_SESSION['usuario'])){

                    include("../../pages/con_db.php");
        
                    $vacod = $_SESSION['usuario']['codigo'];
                    $queryvar = "SELECT * FROM tabla_usuarios WHERE codigo='$vacod'";
                    $resulvar = mysqli_query($connect, $queryvar);
                    $rowa= $resulvar->fetch_array();
                    $varsession = $rowa['nombre']." ".$rowa['apellido'];
                
                    ?>

                    <div class="user_wrapper">


                    <?php if($rowa['foto']==null){?>

                            <img class="profile_imghead" src="../../assets/avataradmin.png" alt="">

                    <?php }else{ ?>

                            <img class="profile_imghead" src="data:image/jpg;base64,<?php echo base64_encode($rowa['foto']);?>" alt="">
                            
                     <?php } ?>

                    <div>
                        <h4 class="name_user"><?php echo $varsession;?></h4>
                        <?php if($_SESSION['usuario']['tipo']==0){ ?>
                            <small>Usuario</small>
                        <?php }else{ ?>    
                            <small>Administrador</small>
                            <?php } ?>
                    </div>

                    <div class="buttons_options">
                        <?php if($_SESSION['usuario']['tipo']==0){ ?>
                            <a class="inbutton buttondashin" href="../../pagesuser/miperfil.php">Dashboard</a>
                        <?php }else{ ?>
                            <a class="inbutton buttondashin" href="../../pages/dashboard.php">Dashboard</a>   
                         <?php } ?>   
                        <a class="inbutton buttonsesionin" href="../../pages/cerrarsesion.php">Cerrar Sesi??n</a>
                    </div>
                </div>
                        
            <?php }else{ ?>
            <a class="hero_button" href="../../login-register/register.php">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Registrarse
            </a>
            <a class="hero_button" href="../../login-register/login.php">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Ingresar</a>

            <?php } ?>  
        </div>
    </nav>

    <main>

        <div class="nav_opciones">

            <div class="single_button">
                <a class="op_button" href="../catalogo.php">
                    <i class="fas fa-th-large icon_button"></i>Cat??logo</a>
            </div>

            <div class="single_button">
                <a class="op_button" href="../ofertas.php">
                    <i class="fas fa-percentage icon_button"></i>Ofertas</a>
            </div>

            <div class="single_button">
                <a class="op_button" href="../nosotros.php">
                    <i class="fas fa-network-wired icon_button"></i>Quienes somos</a>
            </div>

            <div class="single_button">
                <a class="op_button" href="../equipo.php">
                    <i class="fas fa-users icon_button"></i>Equipo de trabajo</a>
            </div>
            
            

        </div>


        <h2 class="containerofert_title">Productos disponibles | Categor??a: Medicinas</h2>
        <div class="ofert_container">


            <div class="cards_ofert">

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/aguaoxigenada.png" alt="">
                        <p class="ofert_title">Agua oxigenada</p>
                        <p class="description_cat">Agente antimicrobiano, ??til para limpiar las heridas.</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 6.50</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/Alcoholboreal" alt="">
                        <p class="ofert_title">Alcohol boreal</p>
                        <p class="description_cat">Alcohol et??lico de pH neutro y agradablemente perfumado</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 13.00</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/BayerAspirina" alt="">
                        <p class="ofert_title">Bayer Aspirina</p>
                        <p class="description_cat">Para el alivio de dolores de cabeza y m??sculos</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 14.00</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/aci tip.jpg" alt="">
                        <p class="ofert_title">Aci tip</p>
                        <p class="description_cat">Neutralizante de la secreci??n ??cida g??strica</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 19.50</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/bismutol jarabe.jpg" alt="">
                        <p class="ofert_title">Bismutol jarabe</p>
                        <p class="description_cat">Para el trato de diarrea y malestares digestivos</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 16.00</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert lastcard">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/bismutol pastilla.jpg" alt="">
                        <p class="ofert_title">Bismutol pastilla</p>
                        <p class="description_cat">Para el trato de diarrea y malestares digestivos</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 15.50</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>
         
            </div>

            
            <div class="cards_ofert cards_ofertsec">
               
                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/Ibuprofeno.jpg" alt="">
                        <p class="ofert_title">Ibuprofeno</p>
                        <p class="description_cat">Antipir??tico, analg??sico y antiinflamatorio.</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 15.00</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/Panadol.png" alt="">
                        <p class="ofert_title">Panadol</p>
                        <p class="description_cat">Trata la fiebre y el dolor leve y moderado de cabeza</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 22.00</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/Paracetamol.png" alt="">
                        <p class="ofert_title">Paracetamol</p>
                        <p class="description_cat">Analg??sicos utilizado principalmente para tratar la fiebre y malestares</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 18.00</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/prospan.jpg" alt="">
                        <p class="ofert_title">Prospan</p>
                        <p class="description_cat">Medicamento a base de plantas utilizado como expectorante</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 23.70</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/vic miel.jpg" alt="">
                        <p class="ofert_title">Vic miel</p>
                        <p class="description_cat">Ayuda a aliviar la tos con flemas y utilizado como expectorante</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 17.00</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>

                <div class="cardofert lastcard">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/medicinas/vic nyquil.jpg" alt="">
                        <p class="ofert_title">Vic nyquil</p>
                        <p class="description_cat">Ayuda a aliviar la tos con flemas y utilizado como expectorante</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 15.60</b></p>
                            <a class="cart_button" href="../../login-register/login.php">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                        </div>
                    </div> 
                </div>
         
            </div>

        </div>


    </main>


    <footer>

        <div class="footer_content">

            <div class="footer_location">
                <p class="title_location">Nuestra ubicaci??n</p>
                <iframe class="frame_location" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15607.44211809954!2d-76.98549318754237!3d-12.053115730624059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c666c92e3e77%3A0xb680b42a1c459c66!2sMall%20Aventura%20Santa%20Anita!5e0!3m2!1ses!2spe!4v1630193996694!5m2!1ses!2spe" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="footer_information">
                <p class="title_information">M??s informaci??n</p>
                <p class="text_information">
                Horarios: 
                <b>Lunes</b>: 8:00 am- 8:00 pm
                <b>Martes</b>: 8:00 am- 8:00 pm 
                <b>Mi??rcoles</b>: 8:00 am- 8:00 pm
                <b>Jueves</b>: 8:00 am- 8:00 pm
                <b>Viernes</b>: 8:00 am- 8:00 pm
                <b>S??bado</b>: 8:00 am- 6:00 pm
                <b>Domingo</b>: 8:00 am- 3:00 pm
                </p>
                <div class="image_flex">
                    <img class="img_information" src="../../assets/img_footer.svg" alt="">
                </div>
                
            </div>
            <div class="footer_ref">
                <div class="medios_de_pago">
                    <p class="title_medios">Medios de pago</p>
                    <img class="img_pago" src="../../assets/visa.png" alt="">
                    <img class="img_pago" src="../../assets/mastercard.png" alt="">
                    <img class="img_pago" src="../../assets/diners-club-international.png" alt="">
                </div>
                <div class="ref_links">
                    <p class="title_links">Nuestras redes sociales</p>
                    <a href="#" class="social_link">
                        <i class="fab fa-whatsapp-square link_icons"></i>
                    </a>
                    <a href="#" class="social_link">
                        <i class="fab fa-facebook-square link_icons"></i>
                    </a>
                    <a href="#" class="social_link">
                        <i class="fab fa-twitter-square link_icons"></i>
                    </a>
                    <a href="#" class="social_link">
                        <i class="fab fa-instagram-square link_icons"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="copyright">
            <hr>
            <p>Todos los derechos reservados &copy 2021 | <b>Angelo Inga, Edith Monta??ez, Eduardo Ishara</b></p>
        </div>

    </footer>

</body>
</html>