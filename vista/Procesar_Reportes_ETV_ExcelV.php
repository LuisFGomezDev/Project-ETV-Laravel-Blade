<?PHP
include "./inc/header.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-co" lang="es-co" > 
<head>
<title><-- GENERACION REPORTES ARCHIVO EXCEL -ETV--></title>


<link rel="stylesheet" href="./css/bootstrap/css/bootstrap.css" type="text/css" /><!-- Se usa solo para los BOTONES-->
<link rel="stylesheet" href="./css/jquery.ui.css" type="text/css" /><!-- Para autocompletar-->

<!-- <link rel="stylesheet" type="text/css" media="all" href="./css/style_acordeon.css" /><!-- Se usa para los cajones del Menu -->

<!-- Se usa para el manejo de las fechas -->
<link type="text/css" rel="stylesheet" href="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"/>


<link rel="stylesheet" href="./css/dialogo.css" type="text/css" /><!-- NO se esta usando para nada -->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'/>
	
<link rel="stylesheet" type="text/css" href="./App_Themes/HojaEstiloLogin.css"/>

<script type="text/javascript" src="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script language="javascript" src="./js/dialogo.js"></script>
<script language="javascript" src="./js/venta.js"></script>

<script language="javascript">
    function Confirmacion_Cargue(opc,Tipo_Cargue)
    {
       if((opc==1)&&(Tipo_Cargue==1))
       {
           $("#Combo_Munic").hide();
       }
       else

       if((opc==2)&&(Tipo_Cargue==1))
       {
           $("#Combo_Munic").show();
       }
    //*******************************************   
    }
    
    //*******************************************   
    //*******************************************   
    //*******************************************   
    
    function Cargue_Inicial(opc)
    {
       if((opc==1))
       {
            $("#Combo_Munic").hide();
       }
    //*******************************************   
    }

</script>

</head>
    
<body onload="Cargue_Inicial(1)">
<?PHP
$GLOBALS['db']->SetFetchMode(ADODB_FETCH_NUM); 

 
    if(empty($_POST['fecha2']))
    {
        $_POST['fecha1']=date("Y/m/d");
        $_POST['fecha2']=$_POST['fecha1'];
    }
?>

<!--*************************************************************************-->
<form name="datos" action="" method="post"> 

    <!-- INICIO CONTENEDOR CUERPO CENTRAL -->
         <div class="EstiloDivContenedorCuerpoCentral_Form">
            
            <div>
                <div class="LabelTituloFormulario"> 
                    <label for="LabelTituloFormulario">GENERACION REPORTES A EXCEL</label>
                </div>

               <div class="LabelGrupo1_Fechas"> 
                   
                  <div class="CampoLabel1">
                    <label for="CampoLabel1">ELIJA DE CUAL MODULO:</label>
                  </div>   

                   <div class="CampoText_Combo">
                        <?PHP
                            echo radio_field("Modulo","A","Atencion","")."&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
                            echo radio_field("Modulo","P","Prevencion","")."&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
                            echo radio_field("Modulo","R","Promocion","")."&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
                            echo radio_field("Modulo","K","Contingencia","")."&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
                            echo radio_field("Modulo","I","Inteligencia","")."&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
                            echo radio_field("Modulo","C","Conocimiento","");
                        ?>
                  </div>   
               </div>
            

               <div class="LabelGrupo2_TipoReporte"> 
                  <div class="CampoLabel1">
                    <label for="CampoLabel1">ELIJA TIPO REPORTE:</label>
                  </div>   

                   <div class="CampoText_Combo">
                        <?PHP
                            echo radio_field("opcion", "F", "General por Fecha de Captura", "$valueTipoReporte", array("id" => "opcion","onclick"=>"Confirmacion_Cargue(1,1)")); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo radio_field("opcion", "M", "Especifico por Municipio entre fechas", "$valueTipoReporte", array("id" => "opcion","onclick" => "Confirmacion_Cargue(2,1)")); 
                        ?>
                  </div> 
               </div>
                
               <div class="LabelGrupo3_Municipio"  id="Combo_Munic"> 
                   
                  <div class="CampoLabel1">
                    <label for="CampoLabel1">ELIJA EL MUNICIPIO:</label>
                  </div>  

                  <div class="CampoText1">
                     <?PHP
                            echo table_row("",db_select_field("Municipio","MUNICIPIOS","MUN_NOMMUNICIPIO","MUN_NOMMUNICIPIO","MUN_IDMUNIC",$datos['Municipio'],""));
                     ?>
                  </div>   
                </div>
                
               <div class="LabelGrupo4_Fechas"> 
                  <div class="CampoLabel1">
                    <label for="CampoLabel1">FECHA DESDE:</label>
                  </div>   
                   
                  <div class="CampoText1">
                     <?PHP echo text_field("fecha1",$_POST['fecha1'],"","10","RO",array("id"=>"fecha1","onclick"=>"displayCalendar(document.datos.fecha1,'yyyy/mm/dd',this)"),"contact_input2"); ?>
                  </div>   
                   
                  <div class="CampoLabel2">
                    <label for="CampoLabel2">FECHA HASTA:</label>
                  </div>   
                   
                  <div class="CampoText2">
                     <?PHP echo text_field("fecha2",$_POST['fecha2'],"","10","RO",array("id"=>"fecha2","onclick"=>"displayCalendar(document.datos.fecha2,'yyyy/mm/dd',this)"),"contact_input2"); ?>
                  </div>   
               </div>
           </div>
             
                <div id="Boton1" class="BotonIngresar_Form"> 
                    <input name="ingresar" id="ingresar" size="40" class="Boton_Enviar_Form" type="submit" value="EXPORTAR"/>
                </div>
        
  </div>
 <!--=== FIN CONTENEDOR CUERPO CENTRAL===-->
</form>

</body>
</html>