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
    <title>Nutricion</title>
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


        <h2 class="containerofert_title">Productos disponibles | Categor??a: Nutrici??n</h2>
        <div class="ofert_container">


            <div class="cards_ofert">

                <div class="cardofert">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="glass_card">
                        <img src="../../assets/categorias/nutricion/Centrum.jpg" alt="">
                        <p class="ofert_title">Centrum</p>
                        <p class="description_cat">Nutrientes para mantenerse siempre activos</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 17.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/Pastillasdecalcio.jpg" alt="">
                        <p class="ofert_title">Pastilla de calcio</p>
                        <p class="description_cat">Pastillas de calcio para un mejor rendimiento personal</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 12.50</b></p>
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
                        <img src="../../assets/categorias/nutricion/Pastillasdehierro.jpg" alt="">
                        <p class="ofert_title">Pastilla de hierro</p>
                        <p class="description_cat">Pastillas de hierro para un mejor rendimiento personal</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 9.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/levadura de cerveza.png" alt="">
                        <p class="ofert_title">Levadura de cerveza</p>
                        <p class="description_cat">La levadura de cerveza ayuda a mantener la tonicidad muscular</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 52.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/vitamina c inyectable.png" alt="">
                        <p class="ofert_title">Vitamina C inyectable</p>
                        <p class="description_cat">Medicamento de vitamina C de venta bajo receta m??dica</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 60.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/hidrolageno q10.png" alt="">
                        <p class="ofert_title">Hidrol??geno Q10</p>
                        <p class="description_cat">Suplemento alimenticio cuya formulaci??n contiene antioxidantes</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 73.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/Pastillasdemaca" alt="">
                        <p class="ofert_title">Pastilla de maca</p>
                        <p class="description_cat">Pastilla de maca cuyo contenido es de vitaminas A y C</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 9.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/Pastillasdemagnesio.jpg" alt="">
                        <p class="ofert_title">Pastilla de magnesio</p>
                        <p class="description_cat">Pastillas de magnesio para un mejor rendimiento personal</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 11.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/Vitathon.jpg" alt="">
                        <p class="ofert_title">Vitathon</p>
                        <p class="description_cat">Capsulas multivitam??nicas, minerales y ginseng</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 30.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/ensoy nf lata.jpg" alt="">
                        <p class="ofert_title">Ensoy NF lata</p>
                        <p class="description_cat">Complemento nutricional en polvo para preparar bebida</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 57.00</b></p>
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
                        <img src="../../assets/categorias/nutricion/nepro ap lata.jpg" alt="">
                        <p class="ofert_title">Nepro AP lata</p>
                        <p class="description_cat">F??rmula balanceada para suplir las necesidades nutricionales</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 17.50</b></p>
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
                        <img src="../../assets/categorias/nutricion/glucerna triple care.jpg" alt="">
                        <p class="ofert_title">Glucerna triple care</p>
                        <p class="description_cat">Ayuda a los pacientes a manejar sus niveles de az??car</p>
                        <div class="pre_button">
                            <p class="price_product"><b>S/ 80.00</b></p>
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