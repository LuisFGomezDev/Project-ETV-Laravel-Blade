<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-co" lang="es-co" > 
<head>
    <title><-- Cargue de Archivos - ETV --></title>

    <!-- Se usa para el manejo de las fechas -->
    <link type="text/css" rel="stylesheet" href="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"/>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'/>

    <link rel="stylesheet" type="text/css" media="all" href="./App_Themes/HojaEstiloLogin.css"/>

    <script type="text/javascript" src="./inc/calendario/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

    <script language="javascript" src="./js/dialogo.js"></script>
    <script language="javascript" src="./js/venta.js"></script>
</head>
<body>

    
<?PHP
    include "../inc/header.php";
    include "../modelos/gestionM.php";
    include "../modelos/ArchivosM.php";

    $clas_ges=new gestion();
    $Form_Valido=false; 
    

if(($_SESSION['usuario_id'])!=-1)
{

     $error=array();
   
    //***** Zona de validaciones de los campos   
     $Nombre_Municipio="";
     $NombreModulo_ETV="Atencion";

     
     //Averiguamos a que Municipio pertenece el Usuario para identificar en que Carpeta guardar los Files
     $gestion_cargue_Municipio=new Archivos();

     
     //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
     $Nombre_Municipio=$gestion_cargue_Municipio->ProcesarCargue_Municipio($_SESSION['usuario_id']);
     $Nombre_Municipio=$Nombre_Municipio->fields['NombreMunicipio'];

     
     $Path_Documentos_Guardados = "./Files_Medios_Verific_Mpios/$Nombre_Municipio";
     
     $MedioVerific_AP_R1="Documentos";
     $Supuesto_AP_R1="Implementacion adecuada del sistema obligatorio de garantia de calidad - Voluntad politica - Capacidad de gestion de los responsables del SOGC en el MSPS";

     $MedioVerific_AP_R2="Informes de Auditoria";
     $Supuesto_AP_R2="Capacidad de respuesta adecuada de la red prestadora de servicios.- Herramientas del SOGC - Procedimientos y medicamentos en POS";
     
     $MedioVerific="";
     $Supuesto="";

     
     //***En este archivo se guarda el nombre de la actividad que se esta TRABAJANDO: AP-R1-I1-A1 Y AP-R1-I1-A2
     $ResultadoElegido="";//Ok
     $IndicadorElegido="";//Ok
     $Actividad_Elegida="";//Ok
     //*******************************************************************

     $Activa_ConfirmaCargue = 0;


     //***En este archivo se almacena la ruta donde quedaran los archivos o documentos soporte en las carpetas del servidor WEB
     //$Path_Documentos_Guardados="";
     //*******************************************************************
     
     $ActividadSupuesto="Disponibilidad de recursos"." y "."Voluntad de los actores";//NULL

     $Observaciones="";
     
     //***Estos archivos guardaran el nombre del documento en la BASE DATOS
     $Nombre_Documento_Act_i1 = "NO HUBO DOCUMENTO";
     $Nombre_Documento_Act_i2 = "NO HUBO DOCUMENTO";
     $Nombre_Documento_Act_i3 = "NO HUBO DOCUMENTO";
     $Nombre_Documento_Act_i4 = "NO HUBO DOCUMENTO";
     
     
     //*******************************************************************
     if(!empty($_POST['Id_Resultado']))//Este valor puede ser 1 o 2
     {
     //Asigno el valor del resultado elegido para trabajar
        $ResultadoElegido=($_POST['Id_Resultado']);
        
        if($ResultadoElegido==1)
        {
            $ResultadoElegido="AP-R1";
            $MedioVerific=$MedioVerific_AP_R1;
            $Supuesto=$Supuesto_AP_R1;
        }
        else
        {
            $ResultadoElegido="AP-R2";
            $MedioVerific=$MedioVerific_AP_R2;
            $Supuesto=$Supuesto_AP_R2;
        }
     }
     else
        {             
            $error[]="Debe Elegir un Resultado";
        }
     //************************************************************     
     if(!empty($_POST['Id_Indicador']))//Este valor es solo 1
     {
     //Asigno el codigo del Indicador seleccionado para trabajar
        $IndicadorElegido=($_POST['Id_Indicador']);
        $Id_Indicador_AP_R2=($_POST['Id_Indicador_AP-R2']);
        
        if(($IndicadorElegido==1)&&($ResultadoElegido=="AP-R1"))
        {
            $IndicadorElegido="AP-R1-I1";
        }
        else
            if(($Id_Indicador_AP_R2==1)&&($ResultadoElegido=="AP-R2"))
            {
                $IndicadorElegido="AP-R2-I1";
            }
        
     }
     else
        {             
            $error[]="Debe Elegir un Indicador";
            //echo mensaje_respuesta(array("INDICADOR ELEGIDO:"),'error'); 
        }
     //************************************************************     
        
     if(!empty($_POST['Id_Actividad']))//Este valor puede ser 1 o 2
     {
     //Asigno el codigo de la actividad seleccionada para trabajar
        $Actividad_Elegida=($_POST['Id_Actividad']);
        $Actividad_Elegida_AP_R2 = ($_POST['Id_Indicador_AP-R2']);
        
        if(($Actividad_Elegida==1)&&($IndicadorElegido="AP-R1-I1"))
        {
            $Actividad_Elegida="AP-R1-I1-A1";
            
            $ActividadIndicador1="AP-R1-I1-A1-i1-i2";  
            $ActividadIndicador2="AP-R1-I1-A1-i3";  
            $ActividadIndicador3="AP-R1-I1-A1-i4";  
            $ActividadIndicador4="NO APLICA PARA AP-R1-I1-A1-i4";  

            $Medio_ActividadIndicador1="Guias Actualizadas";  
            $Medio_ActividadIndicador2="Guias Auditoria Clinica";  
            $Medio_ActividadIndicador3="Informes de auditoria de EPS y DTS";  
            $Medio_ActividadIndicador4="NO APLICA"; 

            $Activa_ConfirmaCargue = 1;            
            
        }
        else//La actividad elegida fue: AP-R1-I1-A2

        if(($Actividad_Elegida==2)&&($IndicadorElegido="AP-R1-I1"))        
        {
            $Actividad_Elegida="AP-R1-I1-A2";
            
            $ActividadIndicador1="AP-R1-I1-A2-i1";  
            $ActividadIndicador2="AP-R1-I1-A2-i2";  
            $ActividadIndicador3="NO APLICA PARA AP-R1-I1-A2";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Acuerdo";  
            $Medio_ActividadIndicador2="Planes de distribucion por DTS";  
            $Medio_ActividadIndicador3="NO APLICA PARA AP-R1-I1-A2";  
            $Medio_ActividadIndicador4="NO APLICA";  
            
            $Activa_ConfirmaCargue = 2;
        }

        
        else//La actividad elegida fue: AP-R2-I1-A1 ********MODULO:  AP-R2

        if(($Actividad_Elegida_AP_R2==1)&&($IndicadorElegido="AP-R2-I1"))
        {
            $Actividad_Elegida="AP-R2-I1-A1";
            
            $ActividadIndicador1="AP-R2-I1-A1-i1";  
            $ActividadIndicador2="AP-R2-I1-A1-i2";  
            $ActividadIndicador3="AP-R2-I1-A1-i3";  
            $ActividadIndicador4="AP-R2-I1-A1-i4";  

            $Medio_ActividadIndicador1="Informe de Actividades";  
            $Medio_ActividadIndicador2="Informes de auditoria de EPS y DTS";  
            $Medio_ActividadIndicador3="Informes de Vigilancia";  
            $Medio_ActividadIndicador4="Informes de auditoria de EPS y DTS";  
            
            $Activa_ConfirmaCargue = 3;
        }
        else//La actividad elegida fue: AP-R2-I1-A2

        if(($Actividad_Elegida_AP_R2==2)&&($IndicadorElegido="AP-R2-I1"))        
        {
            $Actividad_Elegida="AP-R2-I1-A2";
            
            $ActividadIndicador1="AP-R2-I1-A2-i1";  
            $ActividadIndicador2="AP-R2-I1-A2-i2";  
            $ActividadIndicador3="AP-R2-I1-A2-i3";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Informes de auditoria de EPS y DTS";  
            $Medio_ActividadIndicador2="Informes de auditoria de EPS y DTS";  
            $Medio_ActividadIndicador3="Informes de auditoria de EPS y DTS";  
            $Medio_ActividadIndicador3="NO APLICA";  
            
            $Activa_ConfirmaCargue = 4;
        }
        else//La actividad elegida fue: AP-R1-I1-A2

        if(($Actividad_Elegida_AP_R2==3)&&($IndicadorElegido="AP-R2-I1"))        
        {
            $Actividad_Elegida="AP-R2-I1-A3";
            
            $ActividadIndicador1="AP-R2-I1-A3-i1";  
            $ActividadIndicador2="NO APLICA PARA AP-R2-I1-A3";  
            $ActividadIndicador3="NO APLICA PARA AP-R2-I1-A3";  
            $ActividadIndicador4="NO APLICA PARA AP-R2-I1-A3";  

            $Medio_ActividadIndicador1="Informes de auditoria de EPS y DTS";  
            $Medio_ActividadIndicador2="NO APLICA PARA AP-R2-I1-A3";  
            $Medio_ActividadIndicador3="NO APLICA PARA AP-R2-I1-A3";  
            $Medio_ActividadIndicador4="NO APLICA PARA AP-R2-I1-A3";  
            
            $Activa_ConfirmaCargue = 5;
        }
        
     }
     else
        {             
            $error[]="Debe Elegir una Actividad";
            //echo mensaje_respuesta(array("ACTIVIDAD ELEGIDA:"),'error'),$Actividad_Elegida; 

        }
     //*******************************************************************    
     
     
     if(!empty($_POST['textoobservaciones']))//Este campo puede estar vacio
     {
        $Observaciones=$_POST['textoobservaciones']; 
     }   
     else
        {             
            $Observaciones="Sin Observaciones";
        }
     
     //*******************************************************************
     //*****ACA SE PROCESAN TODOS LOS EVENTOS DEL CONTROL UPLOAD FILES****
     //*******************************************************************
     //************************************************************            
     //************************************************************            
     //*****En esta zona leo el nombre de cada uno de los archivos            
     //*****o Documentos cargados**********************************
     //************************************************************   

        if(!empty($_POST['ConfirmaI1'])&&($_POST['ConfirmaI1'])=="S")
        {
            
            $TipoFile = ($_FILES['archivo1']['type'][0]);
            $TamañoFile = ($_FILES['archivo1']['size'][0]);
            $NombreFile = ($_FILES['archivo1']['name'][0]);
            $Tmp_NombreFile = ($_FILES['archivo1']['tmp_name'][0]);
        
            $gestion_cargue_archivos1=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            $Resultado1=$gestion_cargue_archivos1->ProcesarCargue_Files($TipoFile,$TamañoFile,$NombreFile,$Tmp_NombreFile,$Nombre_Municipio);
            
            if($Resultado1==1)//Retorna 1 cuando es exitoso el envio del archivo
            {
                            //$error[]="El Archivo para i1 se ha enviado con exito...!";
                            $Nombre_Documento_Act_i1=$NombreFile;//Nombre del archivo 1
            }
            else
            if($Resultado1==2)//Retorna 2 cuando hay error en el envio del archivo al servidor
            {
                            $error[]="Error!!! El archivo no pudo ser enviado...!";
            }
            else
            if($Resultado1==3)//Retorna 3 cuando el Tipo de Archivo NO es el permitido
            {
                            $error[]="El Tipo de Archivo para i1 no esta permitido...";
            }
            else
            if($Resultado1==4)//Retorna 4 cuando es tamaño del archivo NO es el permitido
            {
                            $error[]="Error...El Tamaño del archivo para i1 supera el espacio permitido de 2 Megas";
            }
          }
     //************************************************************   

     //************************************************************   
        if(!empty($_POST['ConfirmaI2'])&&($_POST['ConfirmaI2'])=="S")
        {
            $TipoFile2 = ($_FILES['archivo1']['type'][1]);
            $TamañoFile2 = ($_FILES['archivo1']['size'][1]);
            $NombreFile2 = ($_FILES['archivo1']['name'][1]);
            $Tmp_NombreFile2 = ($_FILES['archivo1']['tmp_name'][1]);
        
            $gestion_cargue_archivos2=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            
            $Resultado2=$gestion_cargue_archivos2->ProcesarCargue_Files($TipoFile2,$TamañoFile2,$NombreFile2,$Tmp_NombreFile2,$Nombre_Municipio);
            
            if($Resultado2==1)//Retorna 1 cuando es exitoso el envio del archivo
            {
                            //$error[]="El Archivo para i3 se ha enviado con exito...!";
                            $Nombre_Documento_Act_i2=$NombreFile2;//Nombre del archivo 2
            }
            else
            if($Resultado2==2)//Retorna 2 cuando hay error en el envio del archivo al servidor
            {
                            $error[]="Error!!! El archivo no pudo ser enviado...!";
            }
            else
            if($Resultado2==3)//Retorna 3 cuando el Tipo de Archivo NO es el permitido
            {
                            $error[]="El Tipo de Archivo para i3 no esta permitido...";
            }
            else
            if($Resultado2==4)//Retorna 4 cuando es tamaño del archivo NO es el permitido
            {
                            $error[]="Error...El Tamaño del archivo para i3 supera el espacio permitido de 2 Megas";
            }
        }
     //************************************************************   
          
          
     //************************************************************   
        if(!empty($_POST['ConfirmaI3'])&&($_POST['ConfirmaI3'])=="S")
        {
            $TipoFile3 = ($_FILES['archivo1']['type'][2]);
            $TamañoFile3 = ($_FILES['archivo1']['size'][2]);
            $NombreFile3 = ($_FILES['archivo1']['name'][2]);
            $Tmp_NombreFile3 = ($_FILES['archivo1']['tmp_name'][2]);
        
            $gestion_cargue_archivos3=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            
            $Resultado3=$gestion_cargue_archivos3->ProcesarCargue_Files($TipoFile3,$TamañoFile3,$NombreFile3,$Tmp_NombreFile3,$Nombre_Municipio);
            
            if($Resultado3==1)//Retorna 1 cuando es exitoso el envio del archivo
            {
                            //$error[]="El Archivo para i3 se ha enviado con exito...!";
                            $Nombre_Documento_Act_i3=$NombreFile3;//Nombre del archivo 3
            }
            else
            if($Resultado3==2)//Retorna 2 cuando hay error en el envio del archivo al servidor
            {
                            $error[]="Error!!! El archivo no pudo ser enviado...!";
            }
            else
            if($Resultado3==3)//Retorna 3 cuando el Tipo de Archivo NO es el permitido
            {
                            $error[]="El Tipo de Archivo para i3 no esta permitido...";
            }
            else
            if($Resultado3==4)//Retorna 4 cuando es tamaño del archivo NO es el permitido
            {
                            $error[]="Error...El Tamaño del archivo para i3 supera el espacio permitido de 2 Megas";
            }
        }
     //************************************************************   

     //************************************************************   
        if(!empty($_POST['ConfirmaI4'])&&($_POST['ConfirmaI4'])=="S")
        {
            $TipoFile4 = ($_FILES['archivo1']['type'][3]);
            $TamañoFile4 = ($_FILES['archivo1']['size'][3]);
            $NombreFile4 = ($_FILES['archivo1']['name'][3]);
            $Tmp_NombreFile4 = ($_FILES['archivo1']['tmp_name'][3]);
        
            $gestion_cargue_archivos4=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            
            $Resultado4=$gestion_cargue_archivos4->ProcesarCargue_Files($TipoFile4,$TamañoFile4,$NombreFile4,$Tmp_NombreFile4,$Nombre_Municipio);
            
            if($Resultado4==1)//Retorna 1 cuando es exitoso el envio del archivo
            {
                            //$error[]="El Archivo para i4 se ha enviado con exito...!";
                            $Nombre_Documento_Act_i4=$NombreFile4;//Nombre del archivo 4
                            
            }
            if($Resultado4==2)//Retorna 2 cuando hay error en el envio del archivo al servidor
            {
                            $error[]="Error!!! El archivo no pudo ser enviado...!";
            }
            else
            if($Resultado4==3)//Retorna 3 cuando el Tipo de Archivo NO es el permitido
            {
                            $error[]="El Tipo de Archivo para i4 no esta permitido...";
            }
            else
            if($Resultado4==4)//Retorna 4 cuando es tamaño del archivo NO es el permitido
            {
                            $error[]="Error...El Tamaño del archivo para i4 supera el espacio permitido de 2 Megas";
            }
        }
     //************************************************************   
        
    //*******************************************************************
    //*******************************************************************
    //*******************************************************************
    //********ACA PROCESAMOS LOS EVENTOS DE VALIDACION DE LOS CAMPOS DE**
    //********CONFIRMACION DE CARGUE DE ARCHIVOS*************************

            if(($Activa_ConfirmaCargue == 1))
            {
                    if(empty($_POST['ConfirmaI1']) OR empty($_POST['ConfirmaI2']) OR empty($_POST['ConfirmaI3']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
            else

            if(($Activa_ConfirmaCargue == 2))
            {
                    if(empty($_POST['ConfirmaI1']) OR empty($_POST['ConfirmaI2']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
        
            else

            if(($Activa_ConfirmaCargue == 3))
            {
                    if(empty($_POST['ConfirmaI1']) OR empty($_POST['ConfirmaI2']) OR empty($_POST['ConfirmaI3']) OR empty($_POST['ConfirmaI4']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }

            else

            if(($Activa_ConfirmaCargue == 4))
            {
                    if(empty($_POST['ConfirmaI1']) OR empty($_POST['ConfirmaI2']) OR empty($_POST['ConfirmaI3']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }

            else

            if(($Activa_ConfirmaCargue == 5))
            {
                    if(empty($_POST['ConfirmaI1']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
            
//************************************************************           
//************************************************************           
//************************************************************           
//************************************************************           
//************************************************************           
            if(count($error)>0)
                    {
                        echo mensaje_respuesta($error,'error');
                        //echo mensaje_respuesta(array($error),'error'); 
                        $datos=$_POST;
                        ?>
                          <script type="text/javascript">
                            alert("Debe volver a verificar los archivos a enviar");   
                            history.back();
                           </script>
                         <?PHP
                    }
		 else
                 {
                     $gestion_clas=new Gestion();  
                     
                     //PROCESO EL ENVIO DE DATOS DEPENDIENDO DE SI LA ACTIVIDAD FUE AP-R1-I1-A1=1 O AP-R1-I1-A2=2
                         $gestion_clas->ProcesarCapturaNovedades_Archivos($_SESSION['usuario_id'],$ResultadoElegido,$IndicadorElegido,$MedioVerific,$Supuesto,$Actividad_Elegida,$ActividadIndicador1,$ActividadIndicador2,$ActividadIndicador3,$ActividadIndicador4,$Medio_ActividadIndicador1,$Medio_ActividadIndicador2,$Medio_ActividadIndicador3,$Medio_ActividadIndicador4,$ActividadSupuesto,$Observaciones,$Path_Documentos_Guardados,$Nombre_Documento_Act_i1,$Nombre_Documento_Act_i2,$Nombre_Documento_Act_i3,$Nombre_Documento_Act_i4,$NombreModulo_ETV);

                         ?>
                           <script type="text/javascript">
                            alert("El Proceso culmino exitosamente !!!");   
                            window.location.href='../index2.php?p=captura_datos_Atencion&carp=2';
                           </script>
                         <?PHP
                  }
 
}//FIN DEL IF GENERAL EXTERNO 

else
 echo mensaje_respuesta(array("Usuario debe Iniciar Sesi&oacute;n."), $tipo);
?>
</body>
</html>