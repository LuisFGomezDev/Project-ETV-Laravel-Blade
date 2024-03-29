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
     $NombreModulo_ETV="Conocimiento";

     
     //Averiguamos a que Municipio pertenece el Usuario para identificar en que Carpeta guardar los Files
     $gestion_cargue_Municipio=new Archivos();

     
     //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
     $Nombre_Municipio=$gestion_cargue_Municipio->ProcesarCargue_Municipio($_SESSION['usuario_id']);
     $Nombre_Municipio=$Nombre_Municipio->fields['NombreMunicipio'];

     
     $Path_Documentos_Guardados = "./Files_Medios_Verific_Mpios/$Nombre_Municipio";
     
     $MedioVerific_GC_R1_I1="Actas de Reunion";
     $Supuesto_GC_R1_I1="Voluntad de los actores del sistema general de seguridad social en salud -Voluntad de los actores del sistema de ciencia, tecnologia e innovacion. -Capacidad de gestion del lider del programa";

     $MedioVerific_GC_R1_I2="Plan de Accion";
     $Supuesto_GC_R1_I2="Redes de generaci�n de conocimiento aplicado conformadas -Disponibilidad de recursos financieros";
     
     $MedioVerific_GC_R2_I1="Informes asistencia tecnica -Planes de accion";
     $Supuesto_GC_R2_I1="Voluntad pol�tica de los actores -Disponibilidad de recursos financieros -Capacidad de gesti�n del l�der del programa";
     
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
     
     $ActividadSupuesto="Articulaci�n de los actores de la vigilancia de las ETV -Existencia de lineamientos nacionales -Capacidad de liderazgo de los grupos de vigilancia en salud publica";

     $Observaciones="";
     
     //***Estos archivos guardaran el nombre del documento en la BASE DATOS
     $Nombre_Documento_Act_i1 = "NO HUBO DOCUMENTO";
     $Nombre_Documento_Act_i2 = "NO HUBO DOCUMENTO";
     $Nombre_Documento_Act_i3 = "NO HUBO DOCUMENTO";
     $Nombre_Documento_Act_i4 = "NO HUBO DOCUMENTO";
     $Nombre_Documento_Act_i5 = "NO HUBO DOCUMENTO";
     
     
     //*******************************************************************
      if(!empty($_POST['Id_Resultado']))//Este valor puede ser 1 o 2
     {
     //Asigno el valor del resultado elegido para trabajar
        $ResultadoElegido=($_POST['Id_Resultado']);
        
        if($ResultadoElegido==1)
        {
            $ResultadoElegido="GC-R1";
        }
        else

        if($ResultadoElegido==2)
        {
            $ResultadoElegido="GC-R2";
        }
     }
     else
        {             
            $error[]="Debe Elegir un Resultado";
        }
     //************************************************************     
     if(!empty($_POST['Id_Indicador']))//Este valor puede estar entre 1 y 6
     {
     //Asigno el codigo del Indicador seleccionado para trabajar
        $IndicadorElegido=($_POST['Id_Indicador']);
        
        if(($IndicadorElegido==1))
        {
            $IndicadorElegido="GC-R1-I1";

            $MedioVerific=$MedioVerific_GC_R1_I1;
            $Supuesto=$Supuesto_GC_R1_I1;
        }
        else

        if(($IndicadorElegido==2))
        {
            $IndicadorElegido="GC-R1-I2";
            
            $MedioVerific=$MedioVerific_GC_R1_I2;
            $Supuesto=$Supuesto_GC_R1_I2;
        }
        else

        if(($IndicadorElegido==3))
        {
            $IndicadorElegido="GC-R2-I1";
            
            $MedioVerific=$MedioVerific_GC_R2_I1;
            $Supuesto=$Supuesto_GC_R2_I1;
        }

        else

        if(($IndicadorElegido==4))
        {
            $IndicadorElegido="GC-R2-I2";
            
            $MedioVerific=$MedioVerific_GC_R2_I2;
            $Supuesto=$Supuesto_GC_R2_I2;
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
        
        //La actividad elegida fue: GC-R1-I1
        if(($Actividad_Elegida==1)&&($IndicadorElegido="GC-R1-I1"))
        {
            $Actividad_Elegida="GC-R1-I1-A1";
            
            $ActividadIndicador1="GC-R1-I1-A1-i1";  
            $ActividadIndicador2="GC-R1-I1-A1-i2";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="ACTAS DE REUNION / DOCUMENTO";  
            $Medio_ActividadIndicador2="ACTAS DE REUNION / DOCUMENTO";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 

            $Activa_ConfirmaCargue = 1;            
            
        }
        else//La actividad elegida fue: GC-R1-I1

        if(($Actividad_Elegida==2)&&($IndicadorElegido="GC-R1-I1"))        
        {
            $Actividad_Elegida="GC-R1-I1-A2";
            
            $ActividadIndicador1="GC-R1-I1-A2-i1";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Documento";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 2;
        }
        else//La actividad elegida fue: GC-R1-I2

        if(($Actividad_Elegida==3)&&($IndicadorElegido="GC-R1-I2"))        
        {
            $Actividad_Elegida="GC-R1-I2-A1";
            
            $ActividadIndicador1="GC-R1-I2-A1-i1";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="ACTAS DE REUNION / DOCUMENTO";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 3;
        }
        else//

        if(($Actividad_Elegida==4)&&($IndicadorElegido="GC-R1-I2"))        
        {
            $Actividad_Elegida="GC-R1-I2-A2";
            
            $ActividadIndicador1="GC-R1-I2-A2-i1";  
            $ActividadIndicador2="NO APLICA";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Actas de reunion / Documento";  
            $Medio_ActividadIndicador2="NO APLICA";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 4;
        }
        

        else//

        if(($Actividad_Elegida==5)&&($IndicadorElegido="GC-R1-I2"))        
        {
            $Actividad_Elegida="GC-R1-I2-A3";
            
            $ActividadIndicador1="GC-R1-I2-A3-i1";  
            $ActividadIndicador2="GC-R1-I2-A3-i2";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Actas de reunion / Documento";  
            $Medio_ActividadIndicador2="Actas de reunion / Documento";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 5;
        }
        

        else//

        if(($Actividad_Elegida==6)&&($IndicadorElegido="GC-R1-I2"))        
        {
            $Actividad_Elegida="GC-R1-I2-A4";
            
            $ActividadIndicador1="GC-R1-I2-A4-i1";  
            $ActividadIndicador2="GC-R1-I2-A4-i2";  
            $ActividadIndicador3="NO APLICA";  
            $ActividadIndicador4="NO APLICA";  

            $Medio_ActividadIndicador1="Actas de Reunion / Documento";  
            $Medio_ActividadIndicador2="Actas de Reunion / Documento";  
            $Medio_ActividadIndicador3="NO APLICA";  
            $Medio_ActividadIndicador4="NO APLICA"; 
            
            $Activa_ConfirmaCargue = 6;
        }

        else//

        if(($Actividad_Elegida==7)&&($IndicadorElegido="GC-R2-I1"))        
        {
            $Actividad_Elegida="GC-R2-I1-A1";
            
            $ActividadIndicador1="GC-R2-I1-A1-i1";  
            $ActividadIndicador2="GC-R2-I1-A1-i2";  
            $ActividadIndicador3="GC-R2-I1-A1-i4";  
            $ActividadIndicador4="GC-R2-I1-A1-i5";  
            $ActividadIndicador5="GC-R2-I1-A1-i6";  

            $Medio_ActividadIndicador1="Voluntad pol�tica de los actores";  
            $Medio_ActividadIndicador2="Disponibilidad de recursos financieros";  
            $Medio_ActividadIndicador3="Capacidad de gesti�n del l�der del programa";  
            $Medio_ActividadIndicador4=""; 
            $Medio_ActividadIndicador5=""; 
            
            $Activa_ConfirmaCargue = 7;
        }
        
        else//

            
        //BLOQUE INDICADOR: GC-R2-I1    
        if(($Actividad_Elegida==8)&&($IndicadorElegido="GC-R2-I2"))        
        {
            $Actividad_Elegida="GC-R2-I2-A1";
            
            $ActividadIndicador1="GC-R2-I2-A1-i1";  
            $ActividadIndicador2="GC-R2-I2-A1-i2";  
            $ActividadIndicador3="GC-R2-I2-A1-i3";  
            $ActividadIndicador4="NO APLICA";  
            $ActividadIndicador5="NO APLICA";  

            $Medio_ActividadIndicador1="Voluntad pol�tica de los actores";  
            $Medio_ActividadIndicador2="Disponibilidad de recursos financieros";  
            $Medio_ActividadIndicador3="Capacidad de gesti�n del l�der del programa";  
            $Medio_ActividadIndicador4=""; 
            $Medio_ActividadIndicador5=""; 
            
            $Activa_ConfirmaCargue = 8;
        }
        
     }
     else
        {             
            $error[]="Debe Elegir una Actividad";
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
            $Tama�oFile = ($_FILES['archivo1']['size'][0]);
            $NombreFile = ($_FILES['archivo1']['name'][0]);
            $Tmp_NombreFile = ($_FILES['archivo1']['tmp_name'][0]);
        
            $gestion_cargue_archivos1=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            $Resultado1=$gestion_cargue_archivos1->ProcesarCargue_Files($TipoFile,$Tama�oFile,$NombreFile,$Tmp_NombreFile,$Nombre_Municipio);
            
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
            if($Resultado1==4)//Retorna 4 cuando es tama�o del archivo NO es el permitido
            {
                            $error[]="Error...El Tama�o del archivo para i1 supera el espacio permitido de 2 Megas";
            }
          }
     //************************************************************   

     //************************************************************   
        if(!empty($_POST['ConfirmaI2'])&&($_POST['ConfirmaI2'])=="S")
        {
            $TipoFile2 = ($_FILES['archivo1']['type'][1]);
            $Tama�oFile2 = ($_FILES['archivo1']['size'][1]);
            $NombreFile2 = ($_FILES['archivo1']['name'][1]);
            $Tmp_NombreFile2 = ($_FILES['archivo1']['tmp_name'][1]);
        
            $gestion_cargue_archivos2=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            
            $Resultado2=$gestion_cargue_archivos2->ProcesarCargue_Files($TipoFile2,$Tama�oFile2,$NombreFile2,$Tmp_NombreFile2,$Nombre_Municipio);
            
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
            if($Resultado2==4)//Retorna 4 cuando es tama�o del archivo NO es el permitido
            {
                            $error[]="Error...El Tama�o del archivo para i3 supera el espacio permitido de 2 Megas";
            }
        }
     //************************************************************   
          
          
     //************************************************************   
        if(!empty($_POST['ConfirmaI3'])&&($_POST['ConfirmaI3'])=="S")
        {
            $TipoFile3 = ($_FILES['archivo1']['type'][2]);
            $Tama�oFile3 = ($_FILES['archivo1']['size'][2]);
            $NombreFile3 = ($_FILES['archivo1']['name'][2]);
            $Tmp_NombreFile3 = ($_FILES['archivo1']['tmp_name'][2]);
        
            $gestion_cargue_archivos3=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            
            $Resultado3=$gestion_cargue_archivos3->ProcesarCargue_Files($TipoFile3,$Tama�oFile3,$NombreFile3,$Tmp_NombreFile3,$Nombre_Municipio);
            
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
            if($Resultado3==4)//Retorna 4 cuando es tama�o del archivo NO es el permitido
            {
                            $error[]="Error...El Tama�o del archivo para i3 supera el espacio permitido de 2 Megas";
            }
        }
     //************************************************************   

     //************************************************************   
        if(!empty($_POST['ConfirmaI4'])&&($_POST['ConfirmaI4'])=="S")
        {
            $TipoFile4 = ($_FILES['archivo1']['type'][3]);
            $Tama�oFile4 = ($_FILES['archivo1']['size'][3]);
            $NombreFile4 = ($_FILES['archivo1']['name'][3]);
            $Tmp_NombreFile4 = ($_FILES['archivo1']['tmp_name'][3]);
        
            $gestion_cargue_archivos4=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            
            $Resultado4=$gestion_cargue_archivos4->ProcesarCargue_Files($TipoFile4,$Tama�oFile4,$NombreFile4,$Tmp_NombreFile4,$Nombre_Municipio);
            
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
            if($Resultado4==4)//Retorna 4 cuando es tama�o del archivo NO es el permitido
            {
                            $error[]="Error...El Tama�o del archivo para i4 supera el espacio permitido de 2 Megas";
            }
        }
     //************************************************************   

     //************************************************************   
        if(!empty($_POST['ConfirmaI5'])&&($_POST['ConfirmaI5'])=="S")
        {
            $TipoFile5 = ($_FILES['archivo1']['type'][4]);
            $Tama�oFile5 = ($_FILES['archivo1']['size'][4]);
            $NombreFile5 = ($_FILES['archivo1']['name'][4]);
            $Tmp_NombreFile5 = ($_FILES['archivo1']['tmp_name'][4]);
        
            $gestion_cargue_archivos5=new Archivos();
            
            //Averiguamos el resultado de gestionar el cargue de los archivos en el servidor
            
            $Resultado5=$gestion_cargue_archivos5->ProcesarCargue_Files($TipoFile5,$Tama�oFile5,$NombreFile5,$Tmp_NombreFile5,$Nombre_Municipio);
            
            if($Resultado5==1)//Retorna 1 cuando es exitoso el envio del archivo
            {
                            //$error[]="El Archivo para i4 se ha enviado con exito...!";
                            $Nombre_Documento_Act_i5=$NombreFile5;//Nombre del archivo 4
                            
            }
            if($Resultado5==2)//Retorna 2 cuando hay error en el envio del archivo al servidor
            {
                            $error[]="Error!!! El archivo no pudo ser enviado...!";
            }
            else
            if($Resultado5==3)//Retorna 3 cuando el Tipo de Archivo NO es el permitido
            {
                            $error[]="El Tipo de Archivo para i5 no esta permitido...";
            }
            else
            if($Resultado5==4)//Retorna 4 cuando es tama�o del archivo NO es el permitido
            {
                            $error[]="Error...El Tama�o del archivo para i5 supera el espacio permitido de 2 Megas";
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
                    if(empty($_POST['ConfirmaI1']) or empty($_POST['ConfirmaI2']))
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
                    if(empty($_POST['ConfirmaI1']))
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
                    if((empty($_POST['ConfirmaI1'])) or (empty($_POST['ConfirmaI2'])))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
            
            else

            if(($Activa_ConfirmaCargue == 6))
            {
                    if((empty($_POST['ConfirmaI1'])) or (empty($_POST['ConfirmaI2'])))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
            
            else

            if(($Activa_ConfirmaCargue == 7))
            {
                    if((empty($_POST['ConfirmaI1'])) or (empty($_POST['ConfirmaI2'])) or (empty($_POST['ConfirmaI3'])) or (empty($_POST['ConfirmaI4'])) or (empty($_POST['ConfirmaI5'])))
                    {
                      $error[]="Debe elegir una opcion en confirmar envio de archivos Actividad"." ".$Actividad_Elegida;
                    }         
            }
            
            else

            if(($Activa_ConfirmaCargue == 8))
            {
                    if((empty($_POST['ConfirmaI1'])) or (empty($_POST['ConfirmaI2'])) or (empty($_POST['ConfirmaI3'])))
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
                     //$gestion_clas->ProcesarCapturaNovedades_Archivos($_SESSION['usuario_id'],$ResultadoElegido,$IndicadorElegido,$MedioVerific,$Supuesto,$Actividad_Elegida,$ActividadIndicador1,$ActividadIndicador2,$ActividadIndicador3,$ActividadIndicador4,$Medio_ActividadIndicador1,$Medio_ActividadIndicador2,$Medio_ActividadIndicador3,$Medio_ActividadIndicador4,$ActividadSupuesto,$Observaciones,$Path_Documentos_Guardados,$Nombre_Documento_Act_i1,$Nombre_Documento_Act_i2,$Nombre_Documento_Act_i3,$Nombre_Documento_Act_i4,$NombreModulo_ETV);
                         $gestion_clas->ProcesarCapturaNovedades_Archivos_ModConocimiento($_SESSION['usuario_id'],$ResultadoElegido,$IndicadorElegido,$MedioVerific,$Supuesto,$Actividad_Elegida,$ActividadIndicador1,$ActividadIndicador2,$ActividadIndicador3,$ActividadIndicador4,$ActividadIndicador5,$Medio_ActividadIndicador1,$Medio_ActividadIndicador2,$Medio_ActividadIndicador3,$Medio_ActividadIndicador4,$Medio_ActividadIndicador5,$ActividadSupuesto,$Observaciones,$Path_Documentos_Guardados,$Nombre_Documento_Act_i1,$Nombre_Documento_Act_i2,$Nombre_Documento_Act_i3,$Nombre_Documento_Act_i4,$Nombre_Documento_Act_i5,$NombreModulo_ETV);

                         ?>
                           <script type="text/javascript">
                            alert("El Proceso culmino exitosamente !!!");   
                            window.location.href='../index2.php?p=captura_datos_Inteligencia&carp=6';
                           </script>
                         <?PHP
                  }
                    
}//FIN DEL IF GENERAL EXTERNO 

else
 echo mensaje_respuesta(array("Usuario debe Iniciar Sesi&oacute;n."), $tipo);
?>
</body>
</html>