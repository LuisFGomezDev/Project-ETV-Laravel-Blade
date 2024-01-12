<?PHP
include "./inc/header.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-co" lang="es-co" > 
<head>
<title><-- Detalle Cargue Actividades - ETV --></title>

<!--
<link rel="stylesheet" href="./css/bootstrap/css/bootstrap.css" type="text/css" /><!-- Se usa solo para los BOTONES
<link rel="stylesheet" href="./css/jquery.ui.css" type="text/css" /><!-- Para autocompletar

<link rel="stylesheet" type="text/css" media="all" href="./css/style_acordeon.css" /><!-- Se usa para los cajones del Menu -->

<!-- Se usa para el manejo de las fechas -->
<link type="text/css" rel="stylesheet" href="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"/>

<!--
<link rel="stylesheet" href="./css/dialogo.css" type="text/css" /><!-- NO se esta usando para nada -->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'/>
	
<link rel="stylesheet" type="text/css" media="all" href="./App_Themes/HojaEstiloLogin.css"/>

<script type="text/javascript" src="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script language="javascript" src="./js/dialogo.js"></script>
<script language="javascript" src="./js/venta.js"></script>

<script language="javascript">
    function Confirmacion_Cargue(opc,Tipo_Cargue)
    {
       if((opc==1)&&(Tipo_Cargue==1))
       {
            $("#Cargue1").show();  
       }
       else

       if((opc==2)&&(Tipo_Cargue==1))
       {
            $("#Cargue1").hide();  
       }
    //*******************************************   
       if((opc==1)&&(Tipo_Cargue==2))
       {
            $("#Cargue2").show();  
       }
       else

       if((opc==2)&&(Tipo_Cargue==2))
       {
            $("#Cargue2").hide();  
       }
    //*******************************************   
       if((opc==1)&&(Tipo_Cargue==3))
       {
            $("#Cargue3").show();  
       }
       else

       if((opc==2)&&(Tipo_Cargue==3))
       {
            $("#Cargue3").hide();  
       }
    //*******************************************   
       if((opc==1)&&(Tipo_Cargue==4))
       {
            $("#Cargue4").show();  
       }
       else

       if((opc==2)&&(Tipo_Cargue==4))
       {
            $("#Cargue4").hide();  
       }
    }
    
    //*******************************************   
    //*******************************************   
    //*******************************************   

    function Tipo_Resultado(opc)
    {
       if((opc==1))
       {
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            $("#LabelRadioButton2_1").show();
            $("#LabelRadioButton2_2").hide();
            $("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").hide();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
            
       }
       
       else
       if((opc==2))
       {
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            $("#LabelRadioButton2_1").hide();
            $("#LabelRadioButton2_2").show();
            $("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").hide();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").hide();
            
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
       }

       else
       if((opc==3))
       {
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            $("#LabelRadioButton2_1").hide();
            $("#LabelRadioButton2_2").hide();
            $("#LabelRadioButton2_3").show();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").hide();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").hide();
            
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
       }
	   
    }
    
    //*******************************************   
    //*******************************************   
    //*******************************************   

    function Tipo_Indicador(opc)
    {
       if((opc==1))
       {
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").hide();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").show();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").hide();
            
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
       }
       
       else
       if((opc==2))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").hide();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
             $("#LabelRadioButton3_1").hide();
             $("#LabelRadioButton3_2").show();
             $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").hide();
             
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
       }
       
       else
       if((opc==3))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").hide();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").hide();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").show();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").hide();
            
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();

			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
       }
       
       
       else
       if((opc==4))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").hide();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").hide();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").show();
            $("#LabelRadioButton3_5").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
       }
       
       
       else
       if((opc==5))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").hide();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").hide();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").show();
			
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
       }
    }

    //*******************************************   
    //*******************************************   
    //*******************************************   

    function Tipo_Actividad(Indicador,Actividad)
    {
       //*****************************************PLANTILLAS DEL RESULTADO AP-R1 
        
       if((Indicador==1) && (Actividad==1))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").show();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").show();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").show();
            $("#Radio_ConfirmaI3").hide();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }

       else
       if((Indicador==1) && (Actividad==2))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").show();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").show();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").show();
            $("#Radio_ConfirmaI3").hide();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }
       else
       
       if((Indicador==1) && (Actividad==3))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").show();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").show();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").show();
            $("#Radio_ConfirmaI3").show();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }
       else

       if((Indicador==1) && (Actividad==4))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").show();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").show();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").hide();
            $("#Radio_ConfirmaI3").hide();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }
	   
    //*******************************************   
	//   ACA COMIENZAN LOS EVENTOS DEL RESULTADO PM-R2
    //*******************************************   
	   else

       if((Indicador==2) && (Actividad==1))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").show();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").show();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").show();
            $("#Radio_ConfirmaI3").hide();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }
	   
	   else

       if((Indicador==2) && (Actividad==2))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").show();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").show();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").hide();
            $("#Radio_ConfirmaI3").hide();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }


	   else

       if((Indicador==3) && (Actividad==1))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").show();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").show();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").show();
            $("#Radio_ConfirmaI3").hide();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }
       else

       if((Indicador==3) && (Actividad==2))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").show();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").show();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").show();
            $("#Radio_ConfirmaI3").show();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }


       else

       if((Indicador==3) && (Actividad==3))
       { 
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
			
            //$("#LabelRadioButton2_1").show();
            //$("#LabelRadioButton2_2").hide();
            //$("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            //$("#LabelRadioButton3_1").show();
            //$("#LabelRadioButton3_2").hide();
            //$("#LabelRadioButton3_3").hide();
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").show();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").show();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").show();
			
            //GRUPO CONFIRMA
            $("#Radio_ConfirmaI1").show();
            $("#Radio_ConfirmaI2").show();
            $("#Radio_ConfirmaI3").show();
            $("#Radio_ConfirmaI4").hide();
            
            //OCULTAMOS LOS 4 CONTROLES DE CARGUE DE ARCHIVOS
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
            
			
       }



    }
    //*******************************************   
    //*******************************************   
    //*******************************************   
    //*******************************************   

    function Cargue_Inicial(opc)
    {
       if((opc==1))
       {
            //GRUPO RADIOBUTTONS INICIALES
            //GRUPO INDICADORES 
            $("#LabelRadioButton1").show();
		
            $("#LabelRadioButton2_1").hide();
            $("#LabelRadioButton2_2").hide();
            $("#LabelRadioButton2_3").hide();


            //GRUPO ACTIVIDADES DE CADA INDICADOR
            $("#LabelRadioButton3_1").hide();
            $("#LabelRadioButton3_2").hide();
            $("#LabelRadioButton3_3").hide();
            $("#LabelRadioButton3_4").hide();
            $("#LabelRadioButton3_5").hide();
            
            
			
            //GRUPO TABLAS
            $("#TableActs_PM_R1_I1").hide();
            $("#TableActs_PM_R2_I1").hide();
			
            $("#TableActs_PM_R3_I1").hide();
            $("#TableActs_PM_R3_I2").hide();
            $("#TableActs_PM_R3_I3").hide();
			
            //GRUPO ELEMENTOS CUERPO MEDIO
            $("#AP-R1-I1-A1").hide();
			
            //GRUPO ELEMENTOS INDICADORES DE CADA ACTIVIDAD
            $("#INDICADORES_PM-R1-I1-A1").hide();
            $("#INDICADORES_PM-R1-I1-A2").hide();
            $("#INDICADORES_PM-R1-I1-A3").hide();
            $("#INDICADORES_PM-R1-I1-A4").hide();
			
            $("#INDICADORES_PM-R2-I1-A1").hide();
            $("#INDICADORES_PM-R2-I1-A2").hide();

            $("#INDICADORES_PM-R3-I1-A1").hide();
            $("#INDICADORES_PM-R3-I2-A1").hide();

            $("#INDICADORES_PM-R3-I3-A1").hide();
			
            //GRUPO CONFIRMA
            $("#Cargue1").hide();
            $("#Cargue2").hide();
            $("#Cargue3").hide();
            $("#Cargue4").hide();
       }
    //*******************************************   
    }

</script>

</head>
<body onload="Cargue_Inicial(1)">
<!--*************************************************************************-->

<form name="OTRO" action="./controlador/Capturar_Datos_PromocionC.php" method="POST" enctype="multipart/form-data">

    <!-- INICIO CONTENEDOR CUERPO CENTRAL -->
         <div class="EstiloDivContenedorCuerpoCentral_Form">
            
            <div>
                <div class="LabelTituloFormulario"> 
                    <label for="LabelTituloFormulario">CARGUE DOCUMENTOS ACTIVIDADES - ETV</label>
                </div> 

                <div id="LabelSubTitulo1" name="LabelSubTitulo1" class="LabelSubTitulo_Resultados"> 
                    <label for="LabelTituloFormulario1">RESULTADOS --></label>
                </div>

                <div id="LabelSubTitulo2" name="LabelSubTitulo2" class="LabelSubTitulo_Indicadores"> 
                    <label for="LabelTituloFormulario2">INDICADORES --></label>
                </div>
                
                <div id="LabelSubTitulo3" name="LabelSubTitulo3" class="LabelSubTitulo_Actividades"> 
                    <label for="LabelTituloFormulario3">ACTIVIDADES:</label>
                </div>
                
                
                <!--ZONA DE RADIOBUTTONS AP-R1   RESULTADOS, INDICADORES Y ACTIVIDADES-->
                <div id="LabelRadioButton1" name="LabelRadioButton1" class="LabelGrupo_RadioButton1"> 
                     <?PHP 
                            echo radio_field("Id_Resultado", "1", "PM-R1", "$valueId_Resultado", array("id" => "Id_Resultado","onclick" => "Tipo_Resultado(1)")); 
                     ?>
                    
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     
                     <?PHP 
                            echo radio_field("Id_Resultado", "2", "PM-R2", "$valueId_Resultado", array("id" => "Id_Resultado","onclick" => "Tipo_Resultado(2)")); 
                     ?>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     
                     <?PHP 
                            echo radio_field("Id_Resultado", "3", "PM-R3", "$valueId_Resultado", array("id" => "Id_Resultado","onclick" => "Tipo_Resultado(3)")); 
                     ?>
                </div>

                
                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - BOTON 2 - INDICADORES PM-R1 / PM-R2 / PM-R3-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton2_1" name="LabelRadioButton2_1" class="LabelGrupo_RadioButton2"> 
                     <?PHP echo radio_field("Id_Indicador", "1", "PM-R1-I1", "$valueId_Indicador", array("id" => "Id_Indicador","onclick" => "Tipo_Indicador(1)")); ?>                
                </div>

                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - BOTON 2 - INDICADORES PM-R1 / PM-R2 / PM-R3-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton2_2" name="LabelRadioButton2_2" class="LabelGrupo_RadioButton2"> 
                     <?PHP echo radio_field("Id_Indicador", "1", "PM-R2-I1", "$valueId_Indicador", array("id" => "Id_Indicador","onclick" => "Tipo_Indicador(2)")); ?>                
                </div>

                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - BOTON 2 - INDICADORES PM-R1 / PM-R2 / PM-R3-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton2_3" name="LabelRadioButton2_3" class="LabelGrupo_RadioButton2"> 
                     <?PHP echo radio_field("Id_Indicador", "1", "PM-R3-I1", "$valueId_Indicador", array("id" => "Id_Indicador","onclick" => "Tipo_Indicador(3)")); ?>                
                     <?PHP echo radio_field("Id_Indicador", "2", "PM-R3-I2", "$valueId_Indicador", array("id" => "Id_Indicador","onclick" => "Tipo_Indicador(4)")); ?>                
                     <?PHP echo radio_field("Id_Indicador", "3", "PM-R3-I3", "$valueId_Indicador", array("id" => "Id_Indicador","onclick" => "Tipo_Indicador(5)")); ?>                
                </div>
                
                
                
                
                
                
                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - ACTIVIDAD PARA EL INDICADOR PM-R1-I1***-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton3_1" name="LabelRadioButton3_1" class="LabelGrupo_RadioButton3"> 
                     <?PHP echo radio_field("Id_Actividad", "1", "PM-R1-I1-A1", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(1,1)")); ?>&nbsp;
                     <?PHP echo radio_field("Id_Actividad", "2", "PM-R1-I1-A2", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(1,2)")); ?>&nbsp;
                     <?PHP echo radio_field("Id_Actividad", "3", "PM-R1-I1-A3", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(1,3)")); ?>&nbsp;
                     <?PHP echo radio_field("Id_Actividad", "4", "PM-R1-I1-A4", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(1,4)")); ?>
                </div>
                <!--****************************************************************************-->   

                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - ACTIVIDAD PARA EL INDICADOR PM-R2-I1***-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton3_2" name="LabelRadioButton3_2" class="LabelGrupo_RadioButton3"> 
                     <?PHP echo radio_field("Id_Actividad", "5", "PM-R2-I1-A1", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(2,1)")); ?>&nbsp;
                     <?PHP echo radio_field("Id_Actividad", "6", "PM-R2-I1-A2", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(2,2)")); ?>&nbsp;
                </div>
                <!--****************************************************************************-->   
                
                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - ACTIVIDAD PARA EL INDICADOR PM-R3-I1***-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton3_3" name="LabelRadioButton3_3" class="LabelGrupo_RadioButton3"> 
                     <?PHP echo radio_field("Id_Actividad", "7", "PM-R3-I1-A1", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(3,1)")); ?>&nbsp;
                </div>
                <!--****************************************************************************-->   

                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - ACTIVIDAD PARA EL INDICADOR PM-R3-I1***-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton3_4" name="LabelRadioButton3_4" class="LabelGrupo_RadioButton3"> 
                     <?PHP echo radio_field("Id_Actividad", "8", "PM-R3-I2-A1", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(3,2)")); ?>&nbsp;
                </div>
                <!--****************************************************************************-->   

                
                <!--****************************************************************************-->   
                <!--****************GRUPO RADIOBUTTONS - ACTIVIDAD PARA EL INDICADOR PM-R3-I1***-->   
                <!--****************************************************************************-->   
                <div id="LabelRadioButton3_5" name="LabelRadioButton3_5" class="LabelGrupo_RadioButton3"> 
                     <?PHP echo radio_field("Id_Actividad", "9", "PM-R3-I3-A1", "$valueId_Actividad", array("id" => "Id_Actividad","onclick" => "Tipo_Actividad(3,3)")); ?>&nbsp;
                </div>
                <!--****************************************************************************-->   
                
                
                
                
                
                <!--*****ZONA PARA DECLARACION DE LAS TABLAS DE CADA ACTIVIDAD**************-->
                <!--Esta Tabla se activa si es elegido PM-R1-I1 -->
                <!--****************************************************************************-->    
                <!--****************************************************************************-->    
                <div id="TableActs_PM_R1_I1" name="TableActs_PM_R1_I1" class="Estilo_Div_Tabla">
                    <?PHP  
                      echo start_table(array("width"=>"98%","class"=>"Estilo_Tabla")); 

                            echo table_row_th
                            (
                                //table_cell_th("INDICADOR",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("MEDIO VERIFICACION",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("SUPUESTO",array("class"=>"Estilo_th_Tit"))
                                //table_cell_th("ACTIVIDADES",array("class"=>"Estilo_th_Tit"))
                            );

                            echo table_row_th
                            (            
                                //table_cell("AP-R1-I1",array("class"=>"Estilo_th")),
                                table_cell("*Documentos-Actas"." <br> "."*Informes de actividades",array("class"=>"Estilo_th")),
                                table_cell("***Voluntad Politica",array("class"=>"Estilo_th"))
                                //table_cell("1)"."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos."</A>" ." <br> ". "2)" ."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=Cargue_Actividades_V'>" .$Resultado1."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=Cargue_Actividades_V_I2'>" .$Resultado2."</A>",array("class"=>"Estilo_th"))
                            );

                      echo end_table();
                      ?>
                </div>

                
              <!--****************************************************************************-->    
                <!--Esta Tabla se activa si es elegido PM-R2-I1 -->
                <!--****************************************************************************-->    
                <div id="TableActs_PM_R2_I1" name="TableActs_PM_R2_I1" class="Estilo_Div_Tabla">
                    <?PHP  
                      echo start_table(array("width"=>"98%","class"=>"Estilo_Tabla")); 

                            echo table_row_th
                            (
                                //table_cell_th("INDICADOR",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("MEDIO VERIFICACION",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("SUPUESTO",array("class"=>"Estilo_th_Tit"))
                                //table_cell_th("ACTIVIDADES",array("class"=>"Estilo_th_Tit"))
                            );

                            echo table_row_th
                            (            
                                //table_cell("AP-R1-I1",array("class"=>"Estilo_th")),
                                table_cell("*Informes",array("class"=>"Estilo_th")),
                                table_cell("***Buena Capacidad de Concertacion y convocatoria",array("class"=>"Estilo_th"))
                                //table_cell("1)"."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos."</A>" ." <br> ". "2)" ."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=Cargue_Actividades_V'>" .$Resultado1."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=Cargue_Actividades_V_I2'>" .$Resultado2."</A>",array("class"=>"Estilo_th"))
                            );

                      echo end_table();
                      ?>
                </div>
              <!--****************************************************************************-->    
                
              
              
                <!--PM-R3-I1
                <!--****************************************************************************-->    
                <!--Esta Tabla se activa si es elegido PM-R3-I1 -->
                <!--****************************************************************************-->    
                <div id="TableActs_PM_R3_I1" name="TableActs_PM_R3_I1" class="Estilo_Div_Tabla">
                    <?PHP  
                      echo start_table(array("width"=>"98%","class"=>"Estilo_Tabla")); 

                            echo table_row_th
                            (
                                //table_cell_th("INDICADOR",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("MEDIO VERIFICACION",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("SUPUESTO",array("class"=>"Estilo_th_Tit"))
                                //table_cell_th("ACTIVIDADES",array("class"=>"Estilo_th_Tit"))
                            );

                            echo table_row_th
                            (            
                                //table_cell("AP-R1-I1",array("class"=>"Estilo_th")),
                                table_cell("*Informes de actividades",array("class"=>"Estilo_th")),
                                table_cell("***Lineamiento elaborado y difundido",array("class"=>"Estilo_th"))
                                //table_cell("1)"."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos."</A>" ." <br> ". "2)" ."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=Cargue_Actividades_V'>" .$Resultado1."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=Cargue_Actividades_V_I2'>" .$Resultado2."</A>",array("class"=>"Estilo_th"))
                            );

                      echo end_table();
                      ?>
                </div>
                
                
                <!--****************************************************************************-->    
                <!--Esta Tabla se activa si es elegido PM-R3-I2 -->
                <!--****************************************************************************-->    
                <div id="TableActs_PM_R3_I2" name="TableActs_PM_R3_I2" class="Estilo_Div_Tabla">
                    <?PHP  
                      echo start_table(array("width"=>"98%","class"=>"Estilo_Tabla")); 

                            echo table_row_th
                            (
                                //table_cell_th("INDICADOR",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("MEDIO VERIFICACION",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("SUPUESTO",array("class"=>"Estilo_th_Tit"))
                                //table_cell_th("ACTIVIDADES",array("class"=>"Estilo_th_Tit"))
                            );

                            echo table_row_th
                            (            
                                //table_cell("AP-R1-I1",array("class"=>"Estilo_th")),
                                table_cell("*Voluntad y Capacidad de Concertacion",array("class"=>"Estilo_th")),
                                table_cell("***Plan Combi",array("class"=>"Estilo_th"))
                                //table_cell("1)"."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos."</A>" ." <br> ". "2)" ."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=Cargue_Actividades_V'>" .$Resultado1."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=Cargue_Actividades_V_I2'>" .$Resultado2."</A>",array("class"=>"Estilo_th"))
                            );

                      echo end_table();
                      ?>
                </div>
                
                
                <!--****************************************************************************-->    
                <!--Esta Tabla se activa si es elegido PM-R3-I3 -->
                <!--****************************************************************************-->    
                <div id="TableActs_PM_R3_I3" name="TableActs_PM_R3_I3" class="Estilo_Div_Tabla">
                    <?PHP  
                      echo start_table(array("width"=>"98%","class"=>"Estilo_Tabla")); 

                            echo table_row_th
                            (
                                //table_cell_th("INDICADOR",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("MEDIO VERIFICACION",array("class"=>"Estilo_th_Tit")),
                                table_cell_th("SUPUESTO",array("class"=>"Estilo_th_Tit"))
                                //table_cell_th("ACTIVIDADES",array("class"=>"Estilo_th_Tit"))
                            );

                            echo table_row_th
                            (            
                                //table_cell("AP-R1-I1",array("class"=>"Estilo_th")),
                                table_cell("*Documentos-Actas",array("class"=>"Estilo_th")),
                                table_cell("***Capacidad de Liderazgo",array("class"=>"Estilo_th"))
                                //table_cell("1)"."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos."</A>" ." <br> ". "2)" ."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos2."</A>")
                                //table_cell("1)"."<A href='./index2.php$url&opc2=Cargue_Actividades_V'>" .$Resultado1."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=Cargue_Actividades_V_I2'>" .$Resultado2."</A>",array("class"=>"Estilo_th"))
                            );

                      echo end_table();
                      ?>
                </div>
                
                
                
                
                <!--Este Div se activa si es elegido AP-R1-I1-A1 -->
              <div class="" id="AP-R1-I1-A1" name="AP-R1-I1-A1"><!--Para Determinar Los indicadores pertenecientes al resultado:AP-R1-I1-A1  -->

              <!--<div class="LabelGrupo1_AP-R1-I1-A1"> -->
              <div class="LabelGrupo1_AP-R1-I1-A1"> 
              <!--****************************************************************************-->    
                  <div class="CampoLabel1_i1">
                    <label for="CampoLabel1_i1">INDICADOR ACTIVIDAD</label>
                  </div>   
                  <div class="CampoLabel2_i1">
                    <label for="CampoLabel2_i1">MEDIO VERIFICACION</label>
                  </div>
                  <div class="CampoLabel3_i1">  
                    <label for="CampoLabel3_i1">CONFIRMAR CARGUE</label>
                  </div> 
                  <div class="CampoLabel4_i1">  
                    <label for="CampoLabel4_i1">ELEGIR ARCHIVO Tipos:.docx,.xlsx,.zip,.rar,.pdf,.txt</label>
                  </div> 
              <!--****************************************************************************--> 



                    <!--SECCION PARA LOS BLOQUES DE INDICADORES DE AMBAS ACTIVIDADES  PM-R1 ----PM-R1-I1-A1-->
                    <!--****************************************************************************-->
                   <div class="" id="INDICADORES_PM-R1-I1-A1" name="INDICADORES_PM-R1-I1-A1"><!--Inicio Bloque Indicadores de la Actividad = PM-R1-I1-A1-->
                        <div class="CampoText1_i1">
                            <label  value="" for="CampoLabel1_i1">PM-R1-I1-A1-i1</label>
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">INFORME TECNICO</label>
                        </div>  
                       
                        <div class="CampoText1_i2">
                            <label for="CampoLabel1_i2">PM-R1-I1-A1-i2</label>
                        </div>   
                        <div class="CampoText2_i2">
                          <label id="Guias_Actualizadas">INFORME DE ACTIVIDADES</label>
                        </div> 
                       
                    </div><!--Cierre Bloque Indicadores de la Actividad = AP-R1-I1-A1--> 
                    <!--****************************************************************************-->

                    
                    <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R1-I1-A2" name="INDICADORES_PM-R1-I1-A2"><!--Inicio Bloque Indicadores de la Actividad = PM-R1-I1-A2-->
                        <div class="CampoText1_i1">
                            <label  value="" for="CampoLabel1_i1">PM-R1-I1-A2-i1</label>
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">ACTA</label>
                        </div>  
                       
                        <div class="CampoText1_i2">
                            <label for="CampoLabel1_i2">PM-R1-I1-A2-i2</label>
                        </div>   
                        <div class="CampoText2_i2">
                          <label id="Guias_Actualizadas">INFORME DE ACTIVIDADES</label>
                        </div> 
                     </div> 
                     <!--****************************************************************************-->
                     

                     <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R1-I1-A3" name="INDICADORES_PM-R1-I1-A3"><!--Inicio Bloque Indicadores de la Actividad = PM-R1-I1-A3-->
                        <div class="CampoText1_i1">
                            <label for="CampoLabel1_i1">PM-R1-I1-A3-i1</label>
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">ACTA</label>
                        </div>   

                        <div class="CampoText1_i2">
                            <label for="CampoLabel1_i2">PM-R1-I1-A3-i2</label>
                        </div>   
                        <div class="CampoText2_i2">
                          <label id="Guias_Actualizadas">INFORME DE ACTIVIDADES</label>
                        </div> 
                        
                        <div class="CampoText1_i3">
                            <label for="CampoLabel1_i3">PM-R1-I1-A3-i3</label>
                        </div>   
                        <div class="CampoText2_i3">
                          <label id="Guias_Actualizadas">ACTA</label>
                        </div> 
                        
                     </div> 
                     <!--****************************************************************************-->
                     
                     <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R1-I1-A4" name="INDICADORES_PM-R1-I1-A4"><!--Inicio Bloque Indicadores de la Actividad = PM-R1-I1-A4-->
                        <div class="CampoText1_i1">
                            <label for="CampoLabel1_i1">PM-R1-I1-A4-i1</label>
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">ACTA</label>
                        </div>   
                     </div> 
                     <!--****************************************************************************-->

                     
                     
                     <!-- PM-R2-->
                     
                     <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R2-I1-A1" name="INDICADORES_PM-R2-I1-A1"><!--Inicio Bloque Indicadores de la Actividad = PM-R2-I1-A1-->
                        <div class="CampoText1_i1">
                            <label for="CampoLabel1_i1">PM-R2-I1-A1-i1</label>
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">INFORME</label>
                        </div>   
                        
                        <div class="CampoText1_i2">
                            <label for="CampoLabel1_i2">PM-R2-I1-A1-i2</label>
                        </div>   
                        <div class="CampoText2_i2">
                          <label id="Guias_Actualizadas">INFORME</label>
                        </div>   
                        
                     </div> 
                     <!--****************************************************************************-->
                     
                     <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R2-I1-A2" name="INDICADORES_PM-R2-I1-A2"><!--Inicio Bloque Indicadores de la Actividad = PM-R2-I1-A2-->
                        <div class="CampoText1_i1">
                            <label  value="" for="CampoLabel1_i1">PM-R2-I1-A2-i1</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">INFORME</label><!--MEDIO-->
                        </div>   
                     </div> 
                     <!--****************************************************************************-->
                     
                     <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R3-I1-A1" name="INDICADORES_PM-R3-I1-A1"><!--Inicio Bloque Indicadores de la Actividad = PM-R3-I1-A1-->
                        <div class="CampoText1_i1">
                            <label  value="" for="CampoLabel1_i1">PM-R3-I1-A1-i1</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">*********</label><!--MEDIO-->
                        </div>   
                        
                        <div class="CampoText1_i2">
                            <label  value="" for="CampoLabel1_i2">PM-R3-I1-A1-i2</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i2">
                          <label id="Guias_Actualizadas">*********</label><!--MEDIO-->
                        </div>   
                        
                     </div> 
                     <!--****************************************************************************-->
                     

                     <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R3-I2-A1" name="INDICADORES_PM-R3-I2-A1"><!--Inicio Bloque Indicadores de la Actividad = PM-R3-I2-A1-->
                        <div class="CampoText1_i1">
                            <label  value="" for="CampoLabel1_i1">PM-R3-I2-A1-i1</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">*********</label><!--MEDIO-->
                        </div>   
                        
                        <div class="CampoText1_i2">
                            <label  value="" for="CampoLabel1_i2">PM-R3-I2-A1-i2</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i2">
                          <label id="Guias_Actualizadas">*********</label><!--MEDIO-->
                        </div>   
                        
                        <div class="CampoText1_i3">
                            <label  value="" for="CampoLabel1_i3">PM-R3-I2-A1-i3</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i3">
                          <label id="Guias_Actualizadas">*********</label><!--MEDIO-->
                        </div>   
                    </div> 
                     <!--****************************************************************************-->
                     
                     
                     <!--****************************************************************************-->
                    <div class="" id="INDICADORES_PM-R3-I3-A1" name="INDICADORES_PM-R3-I3-A1"><!--Inicio Bloque Indicadores de la Actividad = PM-R3-I3-A1-->
                        <div class="CampoText1_i1">
                            <label  value="" for="CampoLabel1_i1">PM-R3-I3-A1-i1</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i1">
                          <label id="Guias_Actualizadas">DOCUMENTOS / ACTAS / INFORME ACTIVIDADES</label><!--MEDIO-->
                        </div>   
                        
                        <div class="CampoText1_i2">
                            <label  value="" for="CampoLabel1_i2">PM-R3-I3-A1-i2</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i2">
                          <label id="Guias_Actualizadas">DOCUMENTOS / ACTAS / INFORME ACTIVIDADES</label><!--MEDIO-->
                        </div>   
                        
                        <div class="CampoText1_i3">
                            <label  value="" for="CampoLabel1_i3">PM-R3-I3-A1-i3</label><!--INDICADOR-->
                        </div>   
                        <div class="CampoText2_i3">
                          <label id="Guias_Actualizadas">DOCUMENTOS / ACTAS / INFORME ACTIVIDADES</label><!--MEDIO-->
                        </div>   
                    </div> 
                     <!--****************************************************************************-->
                     

                     <!--**************ZONA PARA LOS CONTROLES DE CONFIRMACION DE ENVIO DEL ARCHIVO**-->
                     <div>
                        <div class="CampoText3_radio1" id="Radio_ConfirmaI1">
                           <?PHP echo radio_field("ConfirmaI1", "S", "Si hay Documento", "$valueConfirmaI1", array("id" => "ConfirmaI1","onclick"=>"Confirmacion_Cargue(1,1)")); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <?PHP echo radio_field("ConfirmaI1", "N", "No hay Documento", "$valueConfirmaI1", array("id" => "ConfirmaI1","onclick" => "Confirmacion_Cargue(2,1)")); ?>
                        </div>   

                         <div class="CampoText3_radio2" id="Radio_ConfirmaI2">
                           <?PHP echo radio_field("ConfirmaI2", "S", "Si hay Documento", "$valueConfirmaI2", array("id" => "ConfirmaI2","onclick" => "Confirmacion_Cargue(1,2)")); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <?PHP echo radio_field("ConfirmaI2", "N", "No hay Documento", "$valueConfirmaI2", array("id" => "ConfirmaI2","onclick" => "Confirmacion_Cargue(2,2)")); ?>
                        </div>   
                         
                        <div class="CampoText3_radio3" id="Radio_ConfirmaI3">
                           <?PHP echo radio_field("ConfirmaI3", "S", "Si hay Documento", "$valueConfirmaI3", array("id" => "ConfirmaI3","onclick" => "Confirmacion_Cargue(1,3)")); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <?PHP echo radio_field("ConfirmaI3", "N", "No hay Documento", "$valueConfirmaI3", array("id" => "ConfirmaI3","onclick" => "Confirmacion_Cargue(2,3)")); ?>
                        </div>   

                         <div class="CampoText3_radio4" id="Radio_ConfirmaI4">
                           <?PHP echo radio_field("ConfirmaI4", "S", "Si hay Documento", "$valueConfirmaI4", array("id" => "ConfirmaI4","onclick" => "Confirmacion_Cargue(1,4)")); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <?PHP echo radio_field("ConfirmaI4", "N", "No hay Documento", "$valueConfirmaI4", array("id" => "ConfirmaI4","onclick" => "Confirmacion_Cargue(2,4)")); ?>
                        </div>  
                     </div>
                     <!--****************************************************************************-->

                     <!--**************ZONA PARA LA CARGA DE CADA ARCHIVO****************************-->
                              <input class="Sube_Archivo1" type="file" name="archivo1[]" id="Cargue1"/>
                              <input class="Sube_Archivo2" type="file" name="archivo1[]" id="Cargue2"/>
                              <input class="Sube_Archivo3" type="file" name="archivo1[]" id="Cargue3"/>
                              <input class="Sube_Archivo4" type="file" name="archivo1[]" id="Cargue4"/>
                     <!--****************************************************************************-->
                  
              <!--****************************************************************************--> 
              </div><!--FIN DIV LabelGrupo1_AP-R1-I1-A1-->
       </div><!--FIN DIV  AP-R1-I1-A1 -->


       
               <!--************************************************-->   
               <!--Zona para el Campo de Observaciones -->
               <!--************************************************-->   
                <div class="LabelGrupo5" >                    
                  <div class="CampoLabel1" id="observaciones">
                    <label for="CampoLabel1">OBSERVACIONES</label>
                  </div>   

                  <div class="CampoText_Comentarios">
                    <?PHP
                    echo textarea_field("textoobservaciones","",140,array("readonly"=>"false"));
                    ?>
                  </div>   
                </div>

                <!--***************Zona para el Boton del Formulario-->
                <div id="Boton1" class="BotonIngresar_Form"> 
                    <input name="Enviar" id="Enviar" size="70" class="Boton_Enviar_Form" type="submit" value="ENVIAR"/>
                </div>
                <!--************************************************-->   
       
  </div><!--DIV INTERNO-->
</div><!--FIN DIV EstiloDivContenedorCuerpoCentral_Form - EXTERNO -->

</form>
 <!--=== FIN CONTENEDOR CUERPO CENTRAL===-->
</body>
</html>