<?php
session_start();
include('ligacao_bd.php');
$status = "";
if (isset($_POST['codigo']) && $_POST['codigo'] != "") {
    $code = $_POST['codigo'];
    $result = mysqli_query($link, "SELECT * FROM `produto` WHERE `codigo`='$code'");
    $row = mysqli_fetch_assoc($result);
    $name = $row['nome'];
    $code = $row['codigo'];
    $price = $row['preco'];
    $image = $row['image'];

    $cartArray = array(
        $code => array(
            'nome' => $name,
            'codigo' => $code,
            'preco' => $price,
            'quantity' => 1,
            'image' => $image)
    );

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Produto adicionado ao carrinho!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Produto ja foi adicionado ao carrinho!</div>";
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Produto adicionado ao carrinho!</div>";
	}

	}
}
?>
<html>
<head>
<title>Computadores</title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
    <!--   ICON  https://favicomatic.com/-->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/ico/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="assets/ico/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/ico/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/ico/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/ico/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="assets/ico/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="assets/ico/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="assets/ico/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="assets/ico/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="assets/ico/favicon-128.png" sizes="128x128" />


    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

    <title>Computadores</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sublime project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <style>
    </style>
</head>
<header class="header">
    <div class="header_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header_content d-flex flex-row align-items-center justify-content-start">
                        <div class="logo"><a href="#"><img height="40%" src="images/exe1.png" width="60%" alt=""></a></div>
                        <nav class="main_nav">
                            <ul>
                                <li><li><a href="/exercicio15/index.php">Inicio</a></li>

                                </li>
                                <!-- computadores -->
                                <li class="hassubs">
                                    <a href="computador.php">Computadores</a>
                                    <ul>
                                        <li><a href="categories.html">Portáteis</a></li>
                                        <li><a href="categories.html">MAC</a></li>
                                    </ul>
                                </li>
                                <!-- telemoveis -->
                                <li class="hassubs">
                                    <a href="categories.html">Telemovéis</a>
                                    <ul>
                                        <li><a href="categories.html">Android</a></li>
                                        <li><a href="categories.html">IOS</a></li>
                                    </ul>
                                </li>

                                <!-- tablets -->

                                <li class="hassubs">
                                    <a href="categories.html">Tablets</a>
                                    <ul>
                                        <li><a href="categories.html">IOS</a></li>
                                        <li><a href="categories.html">Android</a></li>
                                    </ul>
                                </li>


                                <!-- acessorios -->
                                <li class="hassubs">
                                    <a href="categories.html">Acessorios</a>
                                    <ul>
                                        <li><a href="categories.html">Teclados</a></li>
                                        <li><a href="categories.html">Ratos</a></li>
                                        <li><a href="categories.html">Headphones</a></li>
                                        <li><a href="categories.html">Smartwatches</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html">Contacto</a></li>
                            </ul>
                        </nav>
                        <div class="header_extra ml-auto">
                            <?php
                            if(!empty($_SESSION["shopping_cart"])) {
                                $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                                ?>
                                <div class="cart_div">
                                    <a href="cart.php">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 489 489" style="enable-background:new 0 0 489 489;" xml:space="preserve">
											<g>
                                                <path d="M440.1,422.7l-28-315.3c-0.6-7-6.5-12.3-13.4-12.3h-57.6C340.3,42.5,297.3,0,244.5,0s-95.8,42.5-96.6,95.1H90.3
													c-7,0-12.8,5.3-13.4,12.3l-28,315.3c0,0.4-0.1,0.8-0.1,1.2c0,35.9,32.9,65.1,73.4,65.1h244.6c40.5,0,73.4-29.2,73.4-65.1
													C440.2,423.5,440.2,423.1,440.1,422.7z M244.5,27c37.9,0,68.8,30.4,69.6,68.1H174.9C175.7,57.4,206.6,27,244.5,27z M366.8,462
													H122.2c-25.4,0-46-16.8-46.4-37.5l26.8-302.3h45.2v41c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h139.3v41
													c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h45.2l26.9,302.3C412.8,445.2,392.1,462,366.8,462z"/>
                                            </g>
										</svg> Carrinho<span>
<?php echo $cart_count; ?></span></a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="search">
                            <div class="search_icon">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 475.084 475.084" style="enable-background:new 0 0 475.084 475.084;"
                                     xml:space="preserve">
										<g>
                                            <path d="M464.524,412.846l-97.929-97.925c23.6-34.068,35.406-72.047,35.406-113.917c0-27.218-5.284-53.249-15.852-78.087
												c-10.561-24.842-24.838-46.254-42.825-64.241c-17.987-17.987-39.396-32.264-64.233-42.826
												C254.246,5.285,228.217,0.003,200.999,0.003c-27.216,0-53.247,5.282-78.085,15.847C98.072,26.412,76.66,40.689,58.673,58.676
												c-17.989,17.987-32.264,39.403-42.827,64.241C5.282,147.758,0,173.786,0,201.004c0,27.216,5.282,53.238,15.846,78.083
												c10.562,24.838,24.838,46.247,42.827,64.234c17.987,17.993,39.403,32.264,64.241,42.832c24.841,10.563,50.869,15.844,78.085,15.844
												c41.879,0,79.852-11.807,113.922-35.405l97.929,97.641c6.852,7.231,15.406,10.849,25.693,10.849
												c9.897,0,18.467-3.617,25.694-10.849c7.23-7.23,10.848-15.796,10.848-25.693C475.088,428.458,471.567,419.889,464.524,412.846z
												 M291.363,291.358c-25.029,25.033-55.148,37.549-90.364,37.549c-35.21,0-65.329-12.519-90.36-37.549
												c-25.031-25.029-37.546-55.144-37.546-90.36c0-35.21,12.518-65.334,37.546-90.36c25.026-25.032,55.15-37.546,90.36-37.546
												c35.212,0,65.331,12.519,90.364,37.546c25.033,25.026,37.548,55.15,37.548,90.36C328.911,236.214,316.392,266.329,291.363,291.358z
												"/>
                                        </g>
									</svg>
                            </div>
                        </div>
                        <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Search Panel -->
    <div class="search_panel trans_300">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="search_panel_content d-flex flex-row align-items-center justify-content-end">
                        <form action="#">
                            <input type="text" class="search_input" placeholder="Search" required="required">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social -->
    <div class="header_social">
        <ul>
            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</header>
<body>

<div style="width:700px; margin:50 auto;">

<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>

<?php
}

$result = mysqli_query($link, 'SELECT * FROM `produto`where Categoria_id = 1');
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper' style='color: black'>
			  <form method='post' action=''>
			  <input type='hidden' name='codigo' value=" . $row['codigo'] . " />
			  <div class='image'><img src='" . $row['image'] . "' /></div>
			  <div class='name'>" . $row['nome'] . "</div>
		   	  <div class='price' style='color: black'>€" . $row['preco'] . "</div>
			  <button type='submit' class=\"btn btn-primary\">Adicionar ao Carrinho</button>
			  </form>
		   	  </div>";
        }
mysqli_close($link);
?>

<div style="clear:both;"></div>



</div>
<!-- Icon Boxes -->

<div class="icon_boxes">
    <div class="container">
        <div class="row icon_box_row">

            <!-- Icon Box -->
            <div class="col-lg-4 icon_box_col">
                <div class="icon_box">
                    <div class="icon_box_image"><img src="images/entrega.jpg" weight="20%" alt=""></div>
                    <div class="icon_box_title">Entregas Gratuitas</div>
                    <div class="icon_box_text">
                        <p>A Bit.Estig disponibiliza um serviço de entregas gratuitas em todos os produtos. <p></p>
                        As entregas de artigos são efetuadas para Portugal Continental e Ilha da Madeira de segunda a sábado das 8h às 20h.</p>
                    </div>
                </div>
            </div>

            <!-- Icon Box -->
            <div class="col-lg-4 icon_box_col">
                <div class="icon_box">
                    <div class="icon_box_image"><img src="images/devolucoes.jpg" alt=""></div>
                    <div class="icon_box_title">Devoluções Grátis</div>
                    <div class="icon_box_text">
                        <p>As condições da devolução são as seguintes:<p></p>
                        Artigos sem sinal de uso;<p></p>
                        Devolução do artigo completo, com todos os seus componentes e acessórios, manual de instruções e embalagens originais em perfeito estado;<p></p>
                        Prazo de Devolução: Até ao 14º dia consecutivo, a partir do dia da entrega.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Icon Box -->
            <div class="col-lg-4 icon_box_col">
                <div class="icon_box">
                    <div class="icon_box_image"><img src="images/suporte.jpg" alt=""></div>
                    <div class="icon_box_title">Serviço de apoio ao cliente</div>
                    <div class="icon_box_text">
                        <p>Precisa de ajuda?<p></p>
                        Respondemos a todas as suas perguntas.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_border"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="newsletter_content text-center">
                    <div class="newsletter_title">Subscreve, e recebe as nossas noticias</div>
                    <div class="newsletter_text"><p>bitestig@ipb.pt</p></div>
                    <div class="newsletter_form_container">
                        <form action="#" id="newsletter_form" class="newsletter_form">
                            <input type="email" class="newsletter_input" required="required">
                            <button class="newsletter_button trans_200"><span>Subscreve</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>