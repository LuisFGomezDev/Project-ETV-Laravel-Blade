    <div class="EstiloDivExternoMenu"><!--=== INICIO  Div EXTERNO     #COLOR GRIS OSCURO FUERTE===-->

        <div class="EstiloDivContenedorGeneralMenu"><!--=== INICIO CONTENEDOR GENERAL    #COLOR FUCSIA APLICATVO UNO27, PUNTAS REDONDAS===-->
           
          <!--===<div class="background"><!--=== INICIO DIV IMAGEN FONDO===--> 
             
             <div class="EstiloDivContenedorCabeceraMenu2"><!--=== INICIO CONTENEDOR CABECERA MENU    #COLOR NEGRO LOGO OSCURO, PUNTAS REDONDAS CON EFECTO SOMBRA===-->
               
               <div class="EstiloDivLogoMenu"><!--=== INICIO DIV LOGO, PUNTA REDONDA, BORDE FUCSIA LOGO===-->
               </div><!--=== FIN DIV LOGO===-->

               <div class="EstiloDivTituloMenu"><!--=== INICIO DIV TITULO APP, PUNTA REDONDA, BORDE FUCSIA LOGO===-->
                    <label for="Titulo">MENU PRINCIPAL  <br/> SAN VICENTE FUNDACION </label>
               </div><!--=== FIN DIV TITULO APP===-->

               <div class="EstiloDivIconosMenu"><!--=== INICIO DIV ICONOS MENU, PUNTA REDONDA, BORDE FUCSIA LOGO===-->
               <div id="navigation">

<ul>
<?PHP
$tempCarp="";

while(list($key,$datoMen)=each($menuRow))
{
    
    if($tempCarp!=$datoMen['idPadre'])//Si $datoMen NO esta vacio Entonces
    {
        if($tempCarp!="")
            echo "</ul></li>";
?>

         <li>
                <span <?PHP if($_GET['carp'] == $datoMen['idPadre']){echo 'class="current"';} ?>><a href="<?PHP echo $datoMen['linkPadre']; ?>" class="current"><?PHP echo $datoMen['nomPadre']; ?></a></span>
                
<ul>
        <?PHP
        
        $tempCarp=$datoMen['idPadre'];
    }
    
        //En esta seccion dibujara los hijos por cada padre idPadre
        ?>
               
         <li><a href="<?PHP echo $datoMen['hijoLink']."&carp=".$datoMen['idPadre']; ?>"><?PHP echo $datoMen['hijoNombre']; ?></a></li>
        <?PHP
    
    
}
        
echo "</ul></li>";

?>
            <li>
                <span <?PHP if($_GET['carp'] == "usuarios"){echo 'class="current"';} ?>>
                    <?PHP
                     if(!empty($_SESSION['usuario_url']))
                     {
                    ?>
                    
                    <a href="./index2.php?<?PHP echo $_SESSION['usuario_url']; ?>" id="link-salir">Salir Sistema</a>
                          
                    <?PHP   
                     }
                    ?>
                    
                    <?PHP
                        if($_SESSION['Grupo_Menu']==1)
                        {
                    ?>
                            <a href="./index2.php?cerrar_s=Okay" id="link-salir">Salir</a>
                    <?PHP
                        }
                        else
                        {
                    ?>
                            <a href="./index2.php" id="link-salir">MENU ANTERIOR</a>
                    <?PHP
                        }
                    ?> 
                </span>
            </li>	
</ul>
             
           </div>
           </div><!--=== FIN DIV ICONOS MENU===-->
           </div><!--=== FIN CONTENEDOR CABECERA MENU===-->
    
    
        </div><!--=== FIN CONTENEDOR GENERAL===-->
    
    </div><!--=== FIN  Div EXTERNO===-->
             