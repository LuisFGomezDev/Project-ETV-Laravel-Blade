<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-co" lang="es-co" > 
<head>
<title><-- Pantalla Captura Atencion - ETV --></title>

<!--
<link rel="stylesheet" href="./css/bootstrap/css/bootstrap.css" type="text/css" /><!-- Se usa solo para los BOTONES
<link rel="stylesheet" href="./css/jquery.ui.css" type="text/css" /><!-- Para autocompletar

<link rel="stylesheet" type="text/css" media="all" href="./css/style_acordeon.css" /><!-- Se usa para los cajones del Menu -->

<!-- Se usa para el manejo de las fechas -->
<link type="text/css" rel="stylesheet" href="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"/>

<!--
<link rel="stylesheet" href="./css/dialogo.css" type="text/css" /><!-- NO se esta usando para nada -->

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'/>
	
<link rel="stylesheet" type="text/css" href="./App_Themes/HojaEstiloLogin.css"/>

<script type="text/javascript" src="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

<script language="javascript" src="./js/dialogo.js"></script>
<script language="javascript" src="./js/venta.js"></script>


</head>
    
<body>
<?PHP
                $GLOBALS['db']->SetFetchMode(ADODB_FETCH_NUM); 
                 
                include "./inc/header.php";
                //include "../inc/header.php";
                include "../modelos/gestionM.php";
/*
                include './modelos/planesM.php';

                $codProducto=100;
                $planClas=new Planes();
                $rsActivos=$planClas->planesProductoActivos($codProducto);
                $rsInactivos=$planClas-> planesProductoInactivos($codProducto);
*/
?>

<!--*************************************************************************-->
<form name="datos" action="" method="post"> 

    <!-- INICIO CONTENEDOR CUERPO CENTRAL--> 
         <div class="EstiloDivContenedorCuerpoCentral_Form">
            
            <div>
                <div class="LabelTituloFormulario"> 
                    <label for="LabelTituloFormulario">CAPTURA DOCUMENTOS ATENCION - ETV</label>
                </div>
    
    
    <div class="LabelGrupoTabs"> 
                
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#1" data-toggle="tab" id="AP-R1">AP-R1</a>
                </li>
                <li>
                    <a href="#2" data-toggle="tab" id="AP-R2">AP-R2</a>
                </li>

            </ul>

        <div class="tab-content">
                <div class="tab-pane active" id="1">
                    <?PHP include "vista/Indicador_AP-R1-I1_V.php"; ?>
                </div>
            
                <div class="tab-pane" id="2">
                    <?PHP include "vista/Indicador_AP-R2-I1_V.php"; ?>
                </div>
        </div>     
            
            
           
            
        </div>
 </div>   
 <!--= == FIN CONTENEDOR CUERPO CENTRAL===-->

</form>

</body>
</html>