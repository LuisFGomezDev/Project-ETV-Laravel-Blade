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
     $NomAgente="";
                 
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
    //******AGENTE  ESPECIFICO***********
    //************************************************************            
     if(!empty($_POST['opcion']))
     {
        if(($_POST['opcion'])=='A')
        {
           $TipoInforme=($_POST['opcion']);  
           $ActivaCampaña=9;

           if((!empty($_POST['ListaAgentes'])))
                {
                    $NomAgente=($_POST['ListaAgentes']);
                }
                else
                {             
                    $error[]="Falta elegir el nombre del Agente...";
                }  
        }//Fin if caso 'A'
      }
      else        
        {
            $error[]="Falta elegir el Tipo de informe a generar...";
            
        } 
            
     //************************************************************            
     //******IMAGENOLOGIA***********
     //************************************************************            
        if(($_POST['opcion'])=='C')
        {
           $TipoInforme=($_POST['opcion']);  
           $ActivaCampaña=0;
        }//Fin if caso 'C'

        else
            
     //************************************************************            
     //******PARTICULARES***********
     //************************************************************            
        if(($_POST['opcion'])=='P')
        {
            $ActivaCampaña=1;
            $TipoInforme=($_POST['opcion']); 
        }

        else
            
     //************************************************************            
     //******CARDIOLOGIA***********
     //************************************************************            
        if(($_POST['opcion'])=='K')
        {
            $ActivaCampaña=2;
            $TipoInforme=($_POST['opcion']); 
        }
        
        else
       
     //************************************************************            
     //******PISO  6***********
     //************************************************************            
        if(($_POST['opcion'])=='O')
        {
            $ActivaCampaña=3;
            $TipoInforme=($_POST['opcion']); 
        }
        
        else      
            
            
     //************************************************************            
     //******ZONA REPORTES DE NUEVOS MODULOS - ETAPA 2 SVF
     //************************************************************            
            
     //************************************************************            
     //******NO MAS CIEGOS - N ***********
     //************************************************************            
        if(($_POST['opcion'])=='N')
        {
            $ActivaCampaña=4;
            $TipoInforme=($_POST['opcion']); 
        }
        
        else      
            
     //************************************************************            
     //******MAMOGRAFIAS - M ***********
     //************************************************************            
        if(($_POST['opcion'])=='M')
        {
            $ActivaCampaña=5;
            $TipoInforme=($_POST['opcion']); 
        }
        
        else      
            
     //************************************************************            
     //******MILITARES - T 
     //************************************************************            
        if(($_POST['opcion'])=='T')
        {
            $ActivaCampaña=6;
            $TipoInforme=($_POST['opcion']); 
        }
        
        else      
            
     //************************************************************            
     //******OTORRINO - R
     //************************************************************            
        if(($_POST['opcion'])=='R')
        {
            $ActivaCampaña=7;
            $TipoInforme=($_POST['opcion']); 
        }
        else
     //************************************************************            
     //******HOSPITAL DIA CE - H
     //************************************************************            
        if(($_POST['opcion'])=='H')
        {
            $ActivaCampaña=8;
            $TipoInforme=($_POST['opcion']); 
        }
     
//*******************************************************************
     
     
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
                    alert("Debe diligenciar Todos los datos necesarios para Generar el Archivo");   
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

                
                $datos_gestion=$Novedades_clas->reporte_Novedades_Examenes($FechaInicial,$FechaFinal,$TipoInforme,$NomAgente);
                
//***************************************************************************
//*****ZONA PARA LA GENERACION DE LOS 4 MODULOS NUEVOS SVF - ETAPA 2*********
//***************************************************************************
               if($TipoInforme=='N')//**NO MAS CIEGOS
               {
                $nombreArchivo="ReporteNovedadesNomasCiegos";
                $descripArchivo="Reporte de Novedades No mas Ciegos";
               }
               else
               
               if($TipoInforme=='M')//** MAMOGRAFIAS
               {
                $nombreArchivo="ReporteNovedadesMamografias";
                $descripArchivo="Reporte de Novedades Mamografias";
               }
               else

               if($TipoInforme=='T')//**MILITARES
               {
                $nombreArchivo="ReporteNovedadesMilitares";
                $descripArchivo="Reporte de Novedades Militares";
               }
               else

               if($TipoInforme=='R')//**OTORRINO
               {
                $nombreArchivo="ReporteNovedadesOtorrino";
                $descripArchivo="Reporte de Novedades Otorrino";
               }
               else

                   
//***************************************************************************
//*****ZONA PARA LA GENERACION DE LOS 4 MODULOS A N T I G U O S SVF
//***************************************************************************
                   
                   
               if($TipoInforme=='P')//**PARTICULARES
               {
                $nombreArchivo="ReporteNovedadesParticulares";
                $descripArchivo="Reporte de Novedades Examenes Particulares";
               }

               if($TipoInforme=='H')//**HOSPITAL DIA CE
               {
                $nombreArchivo="ReporteNovedadesHospitalDiaCE";
                $descripArchivo="Reporte de Novedades Hospital DIA CE";
               }

               else
               {//TODOS LOS OTROS TIPOS DE REPORTES A GENERAR
                $nombreArchivo="ReporteNovedadesExamenes";
                $descripArchivo="Reporte de Novedades Examenes";
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
//*****ZONA PARA LA GENERACION DE LOS 4 MODULOS NUEVOS SVF - ETAPA 2*********
//***************************************************************************
               if($TipoInforme=='N')//**NO MAS CIEGOS
               {
                    // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades No mas Ciegos") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }
               else
               
               if($TipoInforme=='M')//** MAMOGRAFIAS
               {
                    // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades Mamografias") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }
               else

               if($TipoInforme=='T')//**MILITARES
               {
                // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades Militares") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }
               else

               if($TipoInforme=='R')//**OTORRINO
               {
                // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades Otorrino") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }
               else
                   
               if($TipoInforme=='H')//**HOSPITAL DIA CE
               {
                // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades Hospital Dia CE") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }
               else
                   

//***************************************************************************
//*****ZONA PARA LA GENERACION DE LOS 4 MODULOS A N T I G U O S SVF
//***************************************************************************
               if($TipoInforme=='P')
               {
                    // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades Particulares") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
               }
               
                else 
                    {
                    // Establecer propiedades 
                    $objPHPExcel->getProperties() 
                    ->setCreator("C_".$_SESSION['usuario_nombre']) 
                    ->setLastModifiedBy("C_".$_SESSION['usuario_nombre']) 
                    ->setTitle("$nombre_archivo") 
                    ->setSubject("$nombre_archivo") 
                    ->setDescription("Reporte de Novedades Examenes") 
                    ->setKeywords("Excel Office 2007 openxml php") 
                    ->setCategory("Reporte");
                    }


//***************************************************************************
//*****ZONA PARA CONSTRUIR CADA HOJA CON SUS CAMPOS EN EXCEL
//***************************************************************************
//***************************************************************************
//*****ZONA PARA CONSTRUIR CADA HOJA CON SUS CAMPOS EN EXCEL - 4 MODULOS NUEVOS SVF - ETAPA 2*********
//***************************************************************************
               if($TipoInforme=='N')//*****NO MAS CIEGOS
               {
                    $encabezado="HORA CITA;CONSECUTIVO;NOMBRE;DOCUMENTO;TELEFONO;CELULAR;EMAIL;EPS;BARRIO;EDAD;CANTIDAD TOTAL;";    
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
                    ->setCellValue('A'.$fila, $datos_gestion->fields['HoraCita']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['NumConsecutivo']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Nombre']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['Identifcliente']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Telefono']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Celular']) 
                    ->setCellValue('G'.$fila, $datos_gestion->fields['Email']) 
                    ->setCellValue('H'.$fila, $datos_gestion->fields['Eps']) 
                    ->setCellValue('I'.$fila, $datos_gestion->fields['Barrio']) 
                    ->setCellValue('J'.$fila, $datos_gestion->fields['Edad']) 
                    ->setCellValue('K'.$fila, $datos_gestion->fields['CantTotal']);

                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        
               else

               if($TipoInforme=='M')//*****MAMOGRAFIAS
               {
                    $encabezado="FechaGestion;HoraGestion;Paciente;DocumentoId;Telefono;Celular;AtCodigo;NombreExamen;EntidadExamen;Tipo;Observaciones;Medio;Cual;AgenteGestion;";    
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
                    ->setCellValue('A'.$fila, $datos_gestion->fields['FechaGestion']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['HoraGestion']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Paciente']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['DocumentoId']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Telefono']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Celular']) 
                    ->setCellValue('G'.$fila, $datos_gestion->fields['AtCodigo']) 
                    ->setCellValue('H'.$fila, $datos_gestion->fields['NombreExamen']) 
                    ->setCellValue('I'.$fila, $datos_gestion->fields['EntidadExamen']) 
                    ->setCellValue('J'.$fila, $datos_gestion->fields['Tipo']) 
                    ->setCellValue('K'.$fila, $datos_gestion->fields['Observaciones']) 
                    ->setCellValue('L'.$fila, $datos_gestion->fields['Medio']) 
                    ->setCellValue('M'.$fila, $datos_gestion->fields['Cual'])
                    ->setCellValue('N'.$fila, $datos_gestion->fields['AgenteGestion']);

                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        
               else

               if($TipoInforme=='T')//*****MILITARES
               {
                    $encabezado="Tipo Fuerza;Especialidad;Nombre;Documento;Fecha Nacimiento;Telefonos;Tipo Paciente;Observaciones;";    
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
                    ->setCellValue('A'.$fila, $datos_gestion->fields['TipoFuerzaM']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['Especialidad']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Nombre']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['identifcliente']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['FechaNacim']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['telContacto1']) 
                    ->setCellValue('G'.$fila, $datos_gestion->fields['TipoPaciente']) 
                    ->setCellValue('H'.$fila, $datos_gestion->fields['textoobservaciones']);

                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        
               else

               if($TipoInforme=='R')//*****OTORRINO
               {
                    $encabezado="PACIENTE;IDENTIFICACION;EDAD;TIPO PACIENTE;TELEFONO;ENTIDAD;CUAL ?;";    
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
                    ->setCellValue('A'.$fila, $datos_gestion->fields['Paciente']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['DocumentoId']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Edad']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['TipoP']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Telefono']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Entidad'])
                    ->setCellValue('G'.$fila, $datos_gestion->fields['CualEps']);

                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        
               else
                    
                   
               if($TipoInforme=='H')//*****HOSPITAL DIA CE
               {
                    $encabezado="NOMBRE PACIENTE;IDENTIFICACION;TEL FIJO;CELULAR;EXAMEN;ENTIDAD;OBSERVACIONES;";    
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
                    ->setCellValue('A'.$fila, $datos_gestion->fields['Paciente']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['Cedula']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Telefono']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['Celular']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Examen'])
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Entidad'])
                    ->setCellValue('G'.$fila, $datos_gestion->fields['Observaciones']);

                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        
               else
                   
//***************************************************************************
//*****************ZONA PARA LOS MODULOS ANTIGUOS****************************
//***************************************************************************
                    
               if($TipoInforme=='P')//*****PARTICULARES
               {
                    $encabezado="FechaGestion;HoraGestion;Paciente;DocumentoId;Telefono;Celular;AtCodigo;NombreExamen;EntidadExamen;Tipo;Observaciones;Medio;Cual;AgenteGestion;";    
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
                    ->setCellValue('A'.$fila, $datos_gestion->fields['FechaGestion']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['HoraGestion']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Paciente']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['DocumentoId']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Telefono']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Celular']) 
                    ->setCellValue('G'.$fila, $datos_gestion->fields['AtCodigo']) 
                    ->setCellValue('H'.$fila, $datos_gestion->fields['NombreExamen']) 
                    ->setCellValue('I'.$fila, $datos_gestion->fields['EntidadExamen']) 
                    ->setCellValue('J'.$fila, $datos_gestion->fields['Tipo']) 
                    ->setCellValue('K'.$fila, $datos_gestion->fields['Observaciones']) 
                    ->setCellValue('L'.$fila, $datos_gestion->fields['Medio']) 
                    ->setCellValue('M'.$fila, $datos_gestion->fields['Cual'])
                    ->setCellValue('N'.$fila, $datos_gestion->fields['AgenteGestion']);

                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	
               }//Fin If
                        
               else
               {
                    $encabezado="FechaGestion;HoraGestion;Paciente;DocumentoId;Telefono;Celular;NombreExamen;EntidadExamen;UsuarioLlamada;Observaciones;NombreEps;AgenteGestion;";
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
                    ->setCellValue('A'.$fila, $datos_gestion->fields['FechaGestion']) 
                    ->setCellValue('B'.$fila, $datos_gestion->fields['HoraGestion']) 
                    ->setCellValue('C'.$fila, $datos_gestion->fields['Paciente']) 
                    ->setCellValue('D'.$fila, $datos_gestion->fields['DocumentoId']) 
                    ->setCellValue('E'.$fila, $datos_gestion->fields['Telefono']) 
                    ->setCellValue('F'.$fila, $datos_gestion->fields['Celular']) 
                    ->setCellValue('G'.$fila, $datos_gestion->fields['NombreExamen']) 
                    ->setCellValue('H'.$fila, $datos_gestion->fields['EntidadExamen']) 
                    ->setCellValue('I'.$fila, $datos_gestion->fields['UsuarioLlamada']) 
                    ->setCellValue('J'.$fila, $datos_gestion->fields['Observaciones']) 
                    ->setCellValue('K'.$fila, $datos_gestion->fields['NombreEps']) 
                    ->setCellValue('L'.$fila, $datos_gestion->fields['AgenteGestion']);
                    
                    $fila++;
                    $datos_gestion->MoveNext();
                    }//FIN WHILE	

               }


        
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
                        $texto= mensaje_respuesta(array("No se encontraron resultados para $descripArchivo"),'error');
                        
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
                include "./vista/Exportar_Novedades_ExcelV.php";
                echo end_form();  
        }
?>

<?PHP
}//FIN DEL IF GENERAL EXTERNO

else
 echo mensaje_respuesta(array("Usuario debe Iniciar Sesi&oacute;n."), $tipo);
?>