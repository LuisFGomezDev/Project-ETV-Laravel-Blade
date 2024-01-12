<form method="post" action="sessiones/pagina_logeo.php">

<div class="EstiloDivExterno"><!--INICIO DIV EXTERNO-->

        <div class="EstiloDivContenedorGeneral"><!--INICIO CONTENEDOR GENERAL-->
             <div class="EstiloDivContenedorCabeceraMenu"><!--INICIO CONTENEDOR CABECERA MENU-->

               <div class="EstiloDivTitulo"> 
                    <label for="Titulo">INICIO DE SESION</label>
               </div>

  <?PHP 
  if(!empty($_GET['error_login']))
  {
  ?>
                 <!--
                 <table width="500" height="162" border="0" class="table1">
                    <tr>
                    <td colspan="2" align=center >
                  -->
                 
                 <div class="EstiloDiv_ERROR"><!--INICIO DIV ERROR-->
                           <?PHP
                          // Mostrar error de Autentificaci�n.
                          include ("aut_mensaje_error.inc.php");
                          if (isset($_GET['error_login'])){
                              $error=$_GET['error_login'];
        		      echo "<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#AB3998'>Error: $error_login_ms[$error]";
                          }
                         ?>	
                <!--
                     &nbsp;</td>
                    </tr>
                </table>                 
                -->
                
                 </div><!--FIN DIV ERROR-->
  <?PHP
  }
  else
      
//********************************************************************************
  ?>
<!--//********************************************************************************-->
   

<!--===GRUPO BOTONES INICIO SESION===-->
 
    <div class="LabelInicioSesionUser"> 
        <label for="Usuario">USUARIO</label>
    </div>

    <div class="TextInicioSesionUser">
        <input class="Input_Text" type="text" name="user" id="user"/>
    </div>
    
    <div class="ImagenUser">
    </div>
    
    

    <div class="LabelInicioSesionClave"> 
        <label for="Clave">CLAVE </label>
    </div>

    <div class="TextInicioSesionClave">
        <input class="Input_Text" type="password" name="pass" id="pass"/>
    </div>


    <!--===INICIO DIV SLIDER===-->
	<div id="main-content">
		<div id="templatemo">
		
			<div class="main-slider">
				<div class="flexslider">

					&nbsp;<ul class="slides">
						 <li>
							<div class="slider-caption">
							</div>
							<img src="./CapaVista/Imagenes/LOGO_VIRUS_ZIKA2.jpg" alt=""/>
						</li>
                        
						<li>
							<div class="slider-caption">
							</div>
							<img src="./CapaVista/Imagenes/Logo_Territorial_Caldas_M.png" alt=""/>
						</li>
                        
                                                <li>
							<div class="slider-caption">
							</div>
 							<img src="./CapaVista/Imagenes/Foto_chicos_Cuidate_e5.jpg" alt="" />
						</li>
					</ul>
		 		</div>
			</div>
		</div>
	</div>
    <!--===FIN DIV SLIDER===-->

            </div><!--=== FIN CONTENEDOR CABECERA MENU===-->

        </div><!--=== FIN CONTENEDOR GENERAL===-->
    
</div><!--=== FIN  Div EXTERNO===-->

    <div id="Boton1" class="BotonIngresar"> 
        <input name="ingresar" id="ingresar" class="Boton_Input_Ingresar" type="submit" value="INGRESAR"/>
    </div>
    
</form>