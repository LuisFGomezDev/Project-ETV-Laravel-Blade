<?PHP
/*******************************************************************************************
   Genera reporte en CSV de ventas  entre un rango de fecha y estado establecido 
********************************************************************************************/
$GLOBALS['db']->SetFetchMode(ADODB_FETCH_NUM); 

include "inc/header.php";
include "modelos/gestionM.php";
require_once './inc/PHPExcel_1.7.9_odt/Classes/PHPExcel.php'; 

$Form_Valido=false;
$GeneracionArchivo=0;

if(($_SESSION['usuario_id'])!=-1)
{

  if($_POST['operation'][1]=='1')
  {  
     $error=array();
   
//***** Zona de validaciones de los campos     
                 
     $FechaInicial="";
     $FechaFinal="";
     $TipoInforme="";
     $Modulo="";
     $Nom_Municipio="";
                 
     if(!empty($_POST['fecha1']))
     {
     //Asigno la fecha inicial
        $FechaInicial=($_POST['fecha1']);
     }
        else
        {             
            $error[]="Falta elegir una Fecha inicial";
        }
     //************************************************************            
     if(!empty($_POST['fecha2']))
     {
     //Asigno la fecha Final
        $FechaFinal=($_POST['fecha2']);
     }
        else
        {             
             $error[]="Falta elegir una Fecha Final";
        }
     //************************************************************            

     if(!empty($_POST['Modulo']))
     {
     //Asigno el nombre del modulo
        $Modulo=($_POST['Modulo']);
     }
        else
        {             
             $error[]="Falta elegir el Modulo para el reporte";
        }
     //************************************************************   
     //******REPORTE POR FECHA DE CAPTURA***********
     //************************************************************            
        if(($_POST['opcion'])=='F')
        {
           $TipoInforme=($_POST['opcion']);  
           $ActivaCampaña=0;
        }//Fin if caso 'C'

        else
            
     //************************************************************            
     //******REPORTE POR MUNICIPIO***********
     //************************************************************            
        if(($_POST['opcion'])=='M')
        {
            $ActivaCampaña=1;
            $TipoInforme=($_POST['opcion']); 
         //************************************************************            
            if(!empty($_POST['Municipio']))
            {
            //Asigno el nombre del Municipio
               $Nom_Municipio=($_POST['Municipio']);
            }
               else
               {             
                   $error[]="Falta elegir el municipio para el Reporte";
               }
          //************************************************************   
        }

        
     //************************************************************            
     if(empty($_POST['opcion']))//SI NO HAN ELEGIDO UN TIPO DE REPORTE
     {
            $error[]="Falta elegir el tipo de Reporte";
     }
        
     //************************************************************            

//*******************************************************************
//****ZONA DE CONTEO E IMPRESION DE MENSAJES DE ERROR POR PANTALLA
//*******************************************************************            
//*******************************************************************            
            if(count($error)>0)
            {
                echo mensaje_respuesta($error,'error');
                $datos=$_POST;
                ?>
                  <script type="text/javascript">
                    alert("Debe elegir Todos los Campos necesarios para Generar el Archivo Excel");   
                    history.back();
                  </script>
                <?PHP
             }//FIN IF COUNT
             else
	     {//INICIO ELSE COUNT
//***************************************************************************
//***************************************************************************
//SI YA NO HAY ERRORES Y EL FORMULARIO ESTA COMPLETO ENTONCES PASAMOS A FABRICAR EL ARCHIVO EN EXCEL .XLSX
//***************************************************************************
                require_once './inc/PHPExcel_1.7.9_odt/Classes/PHPExcel.php'; 
                set_time_limit(0);
                $Novedades_clas=new gestion(); 
                
                $datos_gestion=$Novedades_clas->Procesar_Reportes_Excel_ETV_ATENCION($FechaInicial,$FechaFinal,$TipoInforme,$Nom_Municipio,$Modulo);
                
//***************************************************************************
//*****ZONA PARA LA GENERACION DE LOS MODULOS ETV ***************************
//***************************************************************************
               if($TipoInforme=='F')//** REPORTE POR FECHA CAPTURA DE LA NOVEDAD
               {
                $nombreArchivo="ReporteNovedadesXFechaCaptura";
                $descripArchivo="Reporte de Novedades por Fecha";
               }
               else
               
               if($TipoInforme=='M')//** REPORTE POR MUNICIPIO
               {
                $nombreArchivo="ReporteNovedadesXMunicipio";
                $descripArchivo="Reporte de Novedades por Municipio";
               }
               
     
                //FUNCION QUE CONSTRUYE EL ARCHIVO CSV CON TODAS SUS ESPECIFICACIONES     
                  if($datos_gestion->RecordCount()>0)
                  {
                    $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
                    $cacheSettings = array( ' memoryCacheSize ' => '15MB');
                     PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
    
                    // Crea un nuevo objeto PHPExcel 
                    $objPHPExcel = new PHPExcel(); 

                    $nombre_archivo=$nombreArchivo."_".$_SESSION['usuario_id'];
                    //$nombre_archivo=$nombreArchivo;

//***************************************************************************
//*****ZONA PARA CONSTRUIR LA IDENTIFICACION DE CADA ARCHIVO EXCEL A GENERAR
//***************************************************************************
//***************************************************************************
//*****ZONA PARA LA GENERACION DE LOS MODULOS ETV ***************************
//***************************************************************************
               if($TipoInforme=='F')//** REPORTE POR FECHA CAPTURA DE LA NOVEDAD
               {
                    // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades por Fecha") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }
               else
               
               if($TipoInforme=='M')//** REPORTE POR MUNICIPIO 
               {
                    // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades por Municipio") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }

//***************************************************************************
//*****ZONA PARA CONSTRUIR CADA HOJA CON SUS CAMPOS EN EXCEL - ETV
//***************************************************************************
              if($TipoInforme=='F')//** REPORTE POR FECHA CAPTURA DE LA NOVEDAD
               {
                    $encabezado="FECHA_NOVEDAD;RES_ESPERADO;RES_INDICADOR;RES_MEDIO;RES_SUPUESTO;ACTIVIDAD;ACT_INDICADOR;ACT_MEDIO;ACT_SUPUESTO;OBSERVACIONES;RUTA_DOCUMENTO;NOMBRE_DOCUMENTO;MUNICIPIO;NOMBRE_USUARIO;";    
                    $abc=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK");
    
                    $columnas=  explode(";",$encabezado);

                    $fila=1;

                    while(list($key,$campo)=each($columnas))
                    {
                        // Agregar Informacion 
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($abc[$key].$fila, $campo);
                    }

                    
                    $fila++;		
                    $columna=-1;


                    //while(list($key,$datos_gestion)=each($ConsultaNovedades))
                    while(!$datos_gestion->EOF) 
                    { 
                    $objPHPExcel->setActiveSheetIndex(0)          
                    ->setCellValue('A'.$fila, $datos_gestion->fields['Fecha_Novedad']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['Res_Esperado']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Res_Indicador']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['Res_Medio']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Res_Supuesto']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Actividad']) 
                    ->setCellValue('G'.$fila, $datos_gestion->fields['Act_Indicador']) 
                    ->setCellValue('H'.$fila, $datos_gestion->fields['Act_Medio']) 
                    ->setCellValue('I'.$fila, $datos_gestion->fields['Act_Supuesto']) 
                    ->setCellValue('J'.$fila, $datos_gestion->fields['Observaciones']) 
                    ->setCellValue('K'.$fila, $datos_gestion->fields['Ruta_Documento']) 
                    ->setCellValue('L'.$fila, $datos_gestion->fields['Nombre_Documento']) 
                    ->setCellValue('M'.$fila, $datos_gestion->fields['Municipio']) 
                    ->setCellValue('N'.$fila, $datos_gestion->fields['Nombre_Usuario']);
                    
                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        
               else

               if($TipoInforme=='M')//** REPORTE POR MUNICIPIO 
               {
                    $encabezado="MUNICIPIO;FECHA_NOVEDAD;RES_ESPERADO;RES_INDICADOR;RES_MEDIO;RES_SUPUESTO;ACTIVIDAD;ACT_INDICADOR;ACT_MEDIO;ACT_SUPUESTO;OBSERVACIONES;RUTA_DOCUMENTO;NOMBRE_DOCUMENTO;NOMBRE_USUARIO;";    
                    $abc=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK");
    
                    $columnas=  explode(";",$encabezado);

                    $fila=1;

                    while(list($key,$campo)=each($columnas))
                    {
                        // Agregar Informacion 
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($abc[$key].$fila, $campo);
                    }

                    
                    $fila++;		
                    $columna=-1;


                    //while(list($key,$datos_gestion)=each($ConsultaNovedades))
                    while(!$datos_gestion->EOF) 
                    { 
                    $objPHPExcel->setActiveSheetIndex(0)          
                    ->setCellValue('A'.$fila, $datos_gestion->fields['Municipio']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['Fecha_Novedad']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Res_Esperado']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['Res_Indicador']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Res_Medio']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Res_Supuesto']) 
                    ->setCellValue('G'.$fila, $datos_gestion->fields['Actividad']) 
                    ->setCellValue('H'.$fila, $datos_gestion->fields['Act_Indicador']) 
                    ->setCellValue('I'.$fila, $datos_gestion->fields['Act_Medio']) 
                    ->setCellValue('J'.$fila, $datos_gestion->fields['Act_Supuesto']) 
                    ->setCellValue('K'.$fila, $datos_gestion->fields['Observaciones']) 
                    ->setCellValue('L'.$fila, $datos_gestion->fields['Ruta_Documento']) 
                    ->setCellValue('M'.$fila, $datos_gestion->fields['Nombre_Documento']) 
                    ->setCellValue('N'.$fila, $datos_gestion->fields['Nombre_Usuario']);
                    
                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        


        
                     // Renombrar Hoja 
                        $objPHPExcel->getActiveSheet()->setTitle('Novedades'); 
                     // Establecer la hoja activa, para que cuando se abra el documento se muestre primero. 
                        $objPHPExcel->setActiveSheetIndex(0); 
                        $nombre_archivo.=".xlsx";
                        

                        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
                        //$objWriter->save('php://output');
                        $objWriter->save("./archisvos_xml/$nombre_archivo");
                        $texto=mensaje_respuesta(array("Descargar archivo:$descripArchivo de <A href=\"./archisvos_xml/descargar.php?f=$nombre_archivo\">Descargar</A>"),'okay');		
                        
                        $GeneracionArchivo=1;
                  }//Fin del IF
                  else
                  {
                        //$texto= mensaje_respuesta(array("No se encontraron resultados para $descripArchivo"),'error');
                         ?>
                           <script type="text/javascript">
                            alert("No se encontraron resultados para Exportar");   
                            window.location.href='./index2.php?p=Exportar_Datos&carp=9';
                           </script>
                         <?PHP
                  }
                        echo $texto;
                // }//Fin de la Funcion

//***************************************************************************
//***************************************************************************
//***************************************************************************
                        if($GeneracionArchivo==1) 
                        {
                         ?>
                           <script type="text/javascript">
                            alert("El Archivo se genero con exito. Verifique en la carpeta de Descargas");   
                            //window.location.href='./index2.php?p=captura_datos&carp=1';
                           </script>
                         <?PHP
                     //echo mensaje_respuesta(array("El Proceso de Captura fue realizado con Exito"),'conf'); 
                           $Form_Valido=true;
                        }
		}//FIN ELSE
    }//Fin IF operacion POST
       
       
       //EVALUO SI AUN NO ESTA CORRECTAMENTE DILIGENCIADO EL FORMULARIO DE NOVEDADES
       if($Form_Valido===false)
       {            
                echo start_form($_SERVER['PHP_SELF']."?p=$_GET[p]&carp=$_GET[carp]",array("name"=>"datos"));
                echo hidden_field("operation","01000000000");
                $datos=$_POST;
                $nombre_form="EXPORTAR DATOS NOVEDADES";
                $boton_form="GENERAR ARCHIVO";
                include "./vista/Procesar_Reportes_ETV_ExcelV.php";
                echo end_form();  
        }
?>

<?PHP
}//FIN DEL IF GENERAL EXTERNO

else
 echo mensaje_respuesta(array("Usuario debe Iniciar Sesi&oacute;n."), $tipo);
?>