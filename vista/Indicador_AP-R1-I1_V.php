<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-co" lang="es-co" > 
<head>
<title><-- Pantalla Captura AP-R1-I1 - ETV --></title>

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

<style type="text/css"> 
 
A{text-decoration:none} 
A:hover{text-decoration: underline ; color:red;} 
 
</style>
</head>
    
<body>
<?PHP
                $GLOBALS['db']->SetFetchMode(ADODB_FETCH_NUM);
                $url="?p=$_GET[p]&carp=$_GET[carp]";
                 
                include "./inc/header.php";
                include "./modelos/gestionM.php";
                
                $rsActivos="AP-R1-I1-A1";
                $rsActivos2="AP-R1-I1-A2"
?>

<!--*************************************************************************-->



<?PHP
  $url="?p=$_GET[p]&carp=$_GET[carp]";
  
  
 
  echo start_form($_SERVER['PHP_SELF']."$url",array("name"=>"captura_datos_Atencion"));

?> 
  <!-- INICIO CONTENEDOR CUERPO CENTRAL -->

           <div>
               <div class="Estilo_Div_Tabla"> 
  
<?PHP  
  
  echo start_table(array("width"=>"98%","class"=>"Estilo_Tabla")); 
  
        echo table_row_th
        (
            table_cell_th("INDICADOR",array("class"=>"Estilo_th_Tit")),
            table_cell_th("MEDIO VERIFICACION",array("class"=>"Estilo_th_Tit")),
            table_cell_th("SUPUESTO",array("class"=>"Estilo_th_Tit")),
            table_cell_th("ACTIVIDADES",array("class"=>"Estilo_th_Tit"))
        );
        
        echo table_row_th
        (            
            table_cell("AP-R1-I1",array("class"=>"Estilo_th")),
            table_cell("Documentos",array("class"=>"Estilo_th")),
            table_cell("***Implementacion adecuada del sistema obligatorio de garantia de calidad"." <br> "."  ***Voluntad politica &nbsp;&nbsp;&nbsp;&nbsp; "." <br> "." ***Capacidad de gestion de los responsables del SOGC en el MSPS",array("class"=>"Estilo_th")),
            //table_cell("1)"."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos."</A>" ." <br> ". "2)" ."<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsActivos2."</A>")
            //table_cell("1)"."<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=detalleV&gestion=".$rsActivos2."</A>")
            table_cell("1)"."<A href='./index2.php$url&opc2=Cargue_Actividades_V'>" .$rsActivos."</A>"." <br> ". "2)" . "<A href='./index2.php$url&opc2=Cargue_Actividades_V_I2'>" .$rsActivos2."</A>",array("class"=>"Estilo_th"))
        );

  echo end_table();
        
  echo end_form();

?>

               </div>
            </div>

</body>
</html>