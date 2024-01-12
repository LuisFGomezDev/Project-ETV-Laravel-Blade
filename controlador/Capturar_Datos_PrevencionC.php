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
     $NombreModulo_ETV="Prevencion";

     
     //Averiguamos a que Municipio pertenece el Usuario para identificar en que Carpeta guardar los Files
     $gestion_cargue_Municipio=new Archivos();

     
     //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
     $Nombre_Municipio=$gestion_cargue_Municipio->ProcesarCargue_Municipio($_SESSION['usuario_id']);
     $Nombre_Municipio=$Nombre_Municipio->fields['NombreMunicipio'];

     
     $Path_Documentos_Guardados = "./Files_Medios_Verific_Mpios/$Nombre_Municipio";
     
     $MedioVerific_PV_R1_i1="Plan de Accion e Informe de Actividades";
     $Supuesto_PV_R1_i1="Aceptabilidad de las estrategias por los individuos, -Existencia de recursos, -Capacidad de gestión del líder de programa, -Focalización adecuada de población objeto de las intervenciones";

     $MedioVerific_PV_R1_i2="Plan de Accion e Informe de Actividades";
     $Supuesto_PV_R1_i2="Existencia de recursos,-Capacidad de gestion del líder de programa";
     
     $MedioVerific_PV_R1_i3="Plan de Accion e Informe de Actividades";
     $Supuesto_PV_R1_i3="Disponibilidad de recurso humano, -Capacidad de gestión de los lideres de programa, -Articulación con salud ambiental, -Disponibilidad de recursos humanos, financieros y logísticos";
     
     
     $MedioVerific="";
     $Supuesto="";

     
     //***En este archivo se guarda el nombre de la actividad que se esta TRABAJANDO
     $ResultadoElegido="";//Ok
     $IndicadorElegido="";//Ok
     $Actividad_Elegida="";//Ok
     //*******************************************************************

     $Activa_ConfirmaCargue = 0;


     //***En este archivo se almacena la ruta donde quedaran los archivos o documentos soporte en las carpetas del servidor WEB
     //$Path_Documentos_Guardados="";
     //*******************************************************************
     
     $ActividadSupuesto="Disponibilidad de recursos humanos, financieros y logísticos"." -Estudios de focalización de intervenciones, -Voluntad política"."-Existencia de recursos,-Capacidad de gestión del líder de programa";//NULL

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
            $ResultadoElegido="PV-R1";
        }
     }
     else
        {             
            $error[]="Debe Elegir un Resultado";
        }
     //************************************************************     
     if(!empty($_POST['Id_Indicador']))//Este valor puede ser: 1-2 o 3
     {
     //Asigno el codigo del Indicador seleccionado para trabajar
        $IndicadorElegido=($_POST['Id_Indicador']);
        
        if(($IndicadorElegido==1))
        {
            $IndicadorElegido="PV-R1-I1";
            $MedioVerific=$MedioVerific_PV_R1_i1;
            $Supuesto=$Supuesto_PV_R1_i1;
        }
        else

        if(($IndicadorElegido==2))
        {
            $IndicadorElegido="PV-R1-I2";
            $MedioVerific=$MedioVerific_PV_R1_i2;
            $Supuesto=$Supuesto_PV_R1_i2;
        }
        else

        if(($IndicadorElegido==3))
        {
            $IndicadorElegido="PV-R1-I3";
            $MedioVerific=$MedioVerific_PV_R1_i3;
            $Supuesto=$Supuesto_PV_R1_i3;
        }
        
     }
     else
        {             
            $error[]="Debe Elegir un Indicador";
        }

        
     //************************************************************     
        
     if(!empty($_POST['Id_Actividad']))//Este valor puede estr entre 1 y 4 segun el indicador
     {
     //Asigno el codigo de la actividad seleccionada para trabajar
        $Actividad_Elegida=($_POST['Id_Actividad']);
        
        //La actividad elegida fue: PV-R1-I1-A1
        if(($Actividad_Elegida==1)&&($IndicadorElegido="PV-R1-I1"))
        {
            $Actividad_Elegida="PV-R1-I1-A1";
            
            $ActividadIndicador1="PV-R1-I1-A1 /i1-i2-I3";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Plan de Implementacion";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 

            $Activa_ConfirmaCargue = 1;            
            
        }
        else//La actividad elegida fue: PV-R1-I1-A2

        if(($Actividad_Elegida==2)&&($IndicadorElegido="PV-R1-I1"))        
        {
            $Actividad_Elegida="PV-R1-I1-A2";
            
            $ActividadIndicador1="PV-R1-I1-A2-i1";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Plan de Implementacion";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 2;
        }
        else//La actividad elegida fue: PV-R1-I1-A3

        if(($Actividad_Elegida==3)&&($IndicadorElegido="PV-R1-I1"))
        {
            $Actividad_Elegida="PV-R1-I1-A3";
            
            $ActividadIndicador1="PV-R1-I1-A3-i1";  
            $ActividadIndicador2="PV-R1-I1-A3-i2";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Lineamiento";  
            $Medio_ActividadIndicador2="Informe de Actividades";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 3;
        }
        else//La actividad elegida fue: PV-R1-I1-A4

        if(($Actividad_Elegida==4)&&($IndicadorElegido="PV-R1-I1"))        
        {
            $Actividad_Elegida="PV-R1-I1-A4";
            
            $ActividadIndicador1="PV-R1-I1-A4-i1";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Documento";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 4;
        }
        
        
        
        //ESTOS SON EVENTOS PARA ELEGIR LA ACTIVIDAD DE ACUERDO AL INDICADOR PV-R1-I2

        else//La actividad elegida fue: PV-R1-I2-A1

        if(($Actividad_Elegida==5)&&($IndicadorElegido="PV-R1-I2"))        
        {
            $Actividad_Elegida="PV-R1-I2-A1";
            
            $ActividadIndicador1="PV-R1-I2-A1-i1";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Plan de Accion e Informe de Actividades";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA";  
            
            $Activa_ConfirmaCargue = 5;
        }
        
        
        //ESTOS SON EVENTOS PARA ELEGIR LA ACTIVIDAD DE ACUERDO AL INDICADOR PV-R1-I2

        else//La actividad elegida fue: PV-R1-I3-A1

        if(($Actividad_Elegida==6)&&($IndicadorElegido="PV-R1-I3"))        
        {
            $Actividad_Elegida="PV-R1-I3-A1";
            
            $ActividadIndicador1="PV-R1-I3-A1-i1/i2/i3";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Actas de Visita Sanitaria";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA";  
            
            $Activa_ConfirmaCargue = 6;
        }
        //ESTOS SON EVENTOS PARA ELEGIR LA ACTIVIDAD DE ACUERDO AL INDICADOR PV-R1-I2

        else//La actividad elegida fue: PV-R1-I2-A1

        if(($Actividad_Elegida==7)&&($IndicadorElegido="PV-R1-I3"))        
        {
            $Actividad_Elegida="PV-R1-I3-A2";
            
            $ActividadIndicador1="PV-R1-I3-A2-i1";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Plan de Accion e Informe de Actividades";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA";  
            
            $Activa_ConfirmaCargue = 7;
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
                    if(empty($_POST['ConfirmaI1']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
            else

            if(($Activa_ConfirmaCargue == 2))
            {
                    if(empty($_POST['ConfirmaI1']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
        
            else

            if(($Activa_ConfirmaCargue == 3))
            {
                    if(empty($_POST['ConfirmaI1']) OR empty($_POST['ConfirmaI2']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }

            else

            if(($Activa_ConfirmaCargue == 4))
            {
                    if(empty($_POST['ConfirmaI1']))
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
            
            else

            if(($Activa_ConfirmaCargue == 6))
            {
                    if(empty($_POST['ConfirmaI1']))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
            
            else

            if(($Activa_ConfirmaCargue == 7))
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
                            window.location.href='../index2.php?p=captura_datos_Prevencion&carp=3';
                           </script>
                         <?PHP
                  }
 
}//FIN DEL IF GENERAL EXTERNO 

else
 echo mensaje_respuesta(array("Usuario debe Iniciar Sesi&oacute;n."), $tipo);
?>
</body>
</html>