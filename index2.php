 <?PHP
include "./inc/header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-co" lang="es-co" > 
<head>
<title><-- Inicio Sesion ETV --></title>



<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'/>


<!--<link rel="stylesheet" type="text/css" href="./Styles/bootstrap.min.css"/>-->	
<link rel="stylesheet" type="text/css" href="./css/bootstrap/css/bootstrap.min.css"/>

<link rel="stylesheet" type="text/css" href="./Styles/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="./Styles/templatemo_misc.css"/>
<link rel="stylesheet" type="text/css" href="./Styles/templatemo_style.css"/>

<link rel="stylesheet" type="text/css" media="all" href="./App_Themes/HojaEstiloLogin.css"/>

<!--<link rel="stylesheet" href="./css/bootstrap/css/bootstrap.css" type="text/css" /><!-- Se usa solo para los BOTONES-->

<link rel="stylesheet" href="./css/jquery.ui.css" type="text/css" /><!-- Para autocompletar-->

<!--<link rel="stylesheet" type="text/css" media="all" href="./css/style_acordeon.css" /><!-- Se usa para los cajones del Menu -->

<!-- Se usa para el manejo de las fechas--> 
<link type="text/css" rel="stylesheet" href="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"/>

<!--
<link rel="stylesheet" href="./css/dialogo.css" type="text/css" /><!-- NO se esta usando para nada -->

<script type="text/javascript" src="./js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="./js/jquery.singlePageNav.js"></script>
<script type="text/javascript" src="./js/jquery.flexslider.js"></script>
<script type="text/javascript" src="./js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="./js/custom.js"></script>

<script type="text/javascript" src="./js/jquery.ui.1.8.16.js"></script><!-- Para autocompletar--> 
<script language="javascript" src="./js/jquery.form.js"></script>
<script type="text/javascript" src="./js/buscador.js"></script><!-- Para autocompletar--> 
<script language="javascript" src="./css/bootstrap/js/bootstrap.min.js"></script>


<script type="text/javascript" src="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script language="javascript" src="./js/dialogo.js"></script>
<script language="javascript" src="./js/venta.js"></script>

<script type="text/javascript">

$(function(){

function siRespuesta(r){

 // Crear HTML con las respuestas del servidor
 $("#mensaje_server").html(r.texto);
 $("#loader_gif").fadeOut("slow");
}
 
 function siError(e){
 
	alert('Ocurrio un error al realizar la peticion: '+e.statusText);
 	$("#loader_gif").fadeOut("slow");
 }

 function peticion(e){

 // Realizar la petici�n
 $("#loader_gif").fadeIn("slow");
 
 var parametros = 
 {
    /*
	Gnombre: $('#Gnombre').val(),    			
    GtelContacto: $('#GtelContacto').val(),
    Gtelefono: $('#Gtelefono').val(),
    producto: 0,
	Gapellidos: $('#Gapellidos').val(),
	GtelContacto2: $('#GtelContacto2').val(),		
    gestion_comprobar: $('#gestion_comprobar').val(),
    tipo_envio: "json",
    noprocesar: "noprocesar"*/
	estadoSabana: $('#estadoSabana').val(),	
	nombreArchivo: $('#nombreSabana').val()	
	
 };
 
 var post = $.post("./controlador/reporteSabanaGeneralC.php", parametros, siRespuesta, 'json');
 
 /* Registrar evento de la petici�n (hay mas)
 (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
 
 post.error(siError);         
 // Si ocurrio un error al ejecutar la petici�n se ejecuta "siError"
  
 }
 
 $('#descargarSabana').click(peticion); // Registrar evento al boton 
 
 });


$(document).ready(function(){

	//Menu desplegable
	$("#menu ul li ul").hide();	
	$("#menu ul li span.current").addClass("open").next("ul").show();
	$("#menu ul li span").click(function(){	
		$(this).next("ul").slideToggle("slow").parent("li").siblings("li").find("ul:visible").slideUp("slow");
		$("#menu ul li").find("span").removeClass("open");
		$(this).addClass("open");
	});

});
</script>

<script type="text/javascript">

function validarCadena(e,tipo) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
	if (tecla==0) return true; // no se que es cero. pero dejo que ingrese. Me permite usar Tab
	
	patron =/[A-Za-z\d\s\.\,\#\(\)\@\-\;\:\/]/; // 4
	if(tipo==1)	//Numerico
	 patron =/[\d]/; // Solo numeros
	else
	 if(tipo==2)
	  patron =/[\d\,]/; // Solo numeros con coma

    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
</script>

</head>
    
    
<body>
<?PHP
 
if(empty($_SESSION['usuario_nombre']) || empty($_SESSION['usuario_id']))
{
    include "./sessiones/p1_logeo.php";	
    exit;	
}

?>
<div id="pagina">

<?PHP
                 $Menu_Grupo = 1;
                 $_SESSION['Grupo_Menu']=1;

                 include "./modelos/menuM.php";
                 $clas_menu=new Menu();
                 
                 
                 if(($_GET['p'])=='CargaOtrosModulos')
                 {
                     $Menu_Grupo = 2;
                     $_SESSION['Grupo_Menu']=2;  
                 }

                    if($_SESSION['usuario_perfil']=='M')
                        $menuRow=$clas_menu->menuAdmin($Menu_Grupo);
                    else
                        $menuRow=$clas_menu->menuUsuario($_SESSION['usuario_perfil'],$Menu_Grupo);  

if(count($menuRow)>0)
{ //Perfil de usuario
?>


    <div id="menu">
		<?PHP
                        include "./vista/Menu_Principal_V.php";
                        //include "./vista/menu2.php";
		?>	
    </div>
    <!--/menu-->
    <div id="contenido">       
        <?PHP
		if ($p=='')
                {
			include "vista/pagina_inicioV.php";
		}
		 else
		 
                   switch($_GET['p'])
                     {
                         case 'captura_datos_Atencion':
			 	include "vista/Detalle_Cargue_AtencionV.php";
                                 //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;	
                     

                         case 'captura_datos_Prevencion':
			 	include "vista/Detalle_Cargue_PrevencionV.php";
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;	

                     
                         case 'captura_datos_Promocion':
			 	include "vista/Detalle_Cargue_PromocionV.php";
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;	
                     
                     
                         case 'captura_datos_Contingencia':
			 	include "vista/Detalle_Cargue_ContingenciaV.php";
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;	
                     
                         case 'captura_datos_Inteligencia':
			 	include "vista/Capturar_Datos_InteligenciaV.php";
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;	

                         case 'captura_datos_Conocimiento':
			 	include "vista/Capturar_Datos_ConocimientoV.php";
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;	
                     
                         case 'nuevo_usuario':
 			 	//include "controlador/nuevo_usuarioC.php";			 
                                echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;			
			 
                         case 'Reinicializar_usuarios':
			 	//include "controlador/Reinicializar_agentesC.php";//**********IMPLEMENTAR                             
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;
                     
                         case 'Listar_Datos':
			 	//include "controlador/Procesar_Lista_NovedadesC.php";
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;				
                         
                         case 'Exportar_Datos':
			 	include "controlador/Procesar_Reportes_ETV_ExcelC.php";
                                //echo mensaje_respuesta (array("Esta Opcion aun No esta Disponible !!!"),'error');
			 break;	

//****************************************************
                    }
		
}//fin si es usuario administrador
else
echo mensaje_respuesta(array("No tienes permiso para Ingresar a esta Aplicacion. <A href=".$_SERVER['PHP_SELF']."?cerrar_s=cerrar>Intentar de nuevo</A>"),'error');
?>              
    </div>
        <div id="output"></div>    
        <div id="overlay" class="web_dialog_overlay"></div>    
        <div id="dialog" class="web_dialog"></div>
            
</div>
<!--/pagina-->

</body>
</html>
<?PHP
include "./inc/fin_pagina.php";
?>