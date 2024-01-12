
<form method="post" action="sessiones/pagina_logeo.php">

  <?PHP 
  if(!empty($_GET['error_login'])){
  ?>
    <tr>
    <td colspan="2" align=center >
                           <?PHP
                          // Mostrar error de Autentificaci�n.
                          include ("aut_mensaje_error.inc.php");
                          if (isset($_GET['error_login'])){
                              $error=$_GET['error_login'];
                                echo "<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='#FF0000'>Error: $error_login_ms[$error]";
                          }
                         ?>	
    &nbsp;</td>
  </tr>
  <?PHP
  }
  else
      //********************************************************************************
 ?>   

<!DOCTYPE html>
<html lang="en">
     <head>
     <title>Home</title>
     <meta charset="utf-8">
     <meta name = "format-detection" content = "telephone=no" />
     <link rel="icon" href="./images/favicon.ico" >
     <link rel="shortcut icon" href="./images/favicon.ico"  />
     <link  rel="stylesheet" media="screen" href="./css/style.css">
     <link  rel="stylesheet" href="./css/camera.css">
     <link  rel="stylesheet" href="./css/carousel.css">
     <link  rel="stylesheet" href="./css/font-awesome.css">
     <script src="./js/jquery.js"></script>
     <script src="./js/jquery-migrate-1.1.1.js"></script>
     <script src="./js/script.js"></script> 
     <script src="./js/jquery.equalheights.js"></script>
     <script src="./js/superfish.js"></script>
     <script  src="./js/jquery.responsivemenu.js"></script>
     <script  src="./js/jquery.mobilemenu.js"></script>
     <script  src="./js/jquery.easing.1.3.js"></script>
     <script src="./js/camera.js"></script>
     <!--[if (gt IE 9)|!(IE)]><!-->
     <script  src="./js/jquery.mobile.customized.min.js"></script>
     <!--<![endif]-->
      <script src="./js/jquery.carouFredSel-6.1.0-packed.js"></script>
     <script  src="./js/jquery.touchSwipe.min.js"></script>
     <script>
     	$(document).ready(function(){
      jQuery('#camera_wrap').camera({
        loader: false,
        pagination: false,
        thumbnails: false,
        height: '45%',
        caption: false,
        navigation: true,
        fx: 'simpleFade'
      });   
			});
   
          $(window).load (
    function(){$('.carousel1').carouFredSel({auto: false, prev: '.prev1',next: '.next1', width: 940, items: {
      visible : {min: 1,
       max: 1
},
height: 'auto',
 width: 940,

    }, responsive: true, 
    
    scroll: 1, 
    
    mousewheel: false,
    
    swipe: {onMouse: true, onTouch: true}});
    
    } ); 

  
     </script>
     <!--[if lt IE 8]>
   <div style=' clear: both; text-align:center; position: relative;'>
     <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
       <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
    </a>
  </div>
<![endif]-->
     <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>

    	<link  type="text/css" media="screen" href="css/ie.css">
    <![endif]-->
     </head>
     <body>
<!--==============================header=================================-->
<header>
<div class="container_12">
    <div class="grid_12">
           <h1><a href="index.html"><img src="./images/logo.png" alt="Prospect best opportunity to succeed"></a> </h1>
        <div class="menu_block">
               <nav>
            <ul class="sf-menu">
                   <li class="current"><a href="./index.html">Home</a>  <ul>
                       <li><a href="#">Lorem ipsum</a></li>
                       
                       <li><a href="#">Corporis </a>
                    <ul>
                           <li><a href="#">Ratione dicta</a></li>
                           <li><a href="#">Quaerat maiores</a></li>
                           <li><a href="#">Exercitationem</a></li>
                         </ul>
                  </li>
                  <li><a href="#">Maiores ipsum</a></li>

                     </ul></li>
                   <li><a href="index-1.html">About</a> </li>
                   <li><a href="index-2.html">Services</a> </li>
                   <li><a href="index-3.html">Projects</a> </li>
                   <li><a href="index-4.html">Contacts</a> </li>
                 </ul>
          </nav>
               <div class="clear"></div>
             </div>
        
         </div>
  </div>
</header>
<div class="clear"></div>
<div class="bg1">
<div class="container_12">
  <div class="grid_12">
    <div class="slider_wrapper">
      <div>
      <div id="camera_wrap" class="">
               <div data-src="./images/slide.jpg">
                 <div class="caption fadeIn">
                   <h2>We will help 
you to 
protect 
your rights! </h2>
                 </div>
               </div>
                 <div data-src="./images/slide1.jpg">
                   <div class="caption fadeIn">
                     <h2>Applying  </h2>appropriate market
research solutions
                   </div>
                 </div>
                 <div data-src="./images/slide2.jpg">
                   <div class="caption fadeIn">
                     <h2>Helping</h2>your business 
get back on its 
feet 
                     
                   </div>
                 </div>
               </div>
        </div></div>
      </div>
    </div>

<div class="page1_block">
</div>
<!--=======content================================-->
<!--==============================footer=================================-->

  
</body>
</html>
<?PHP
//********************************************************************************
?> 

<br>
        <?PHP
        echo submit_field("ingresar","Ingresar",array("id"=>"ingresar"));
        ?>
</form>
