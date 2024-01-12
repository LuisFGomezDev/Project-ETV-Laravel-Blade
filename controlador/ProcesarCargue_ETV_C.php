<?PHP

include "../inc/header.php";
include "../modelos/gestionM.php";

$clas_ges=new gestion();
$Form_Valido=false;

$error=array();

if(($_SESSION['usuario_id'])!=-1)
{

  if($_POST['operation'][1]=='1')
  {  
      
      $Carpeta_Destino__path = "D:../SOFTWARE TERRITORIAL 2016/PROYECTO 1_ETV/ARCHIVOSAPP/";
      $Carpeta_Destino__path = $Carpeta_Destino__path . basename( $_FILES['uploadedfile']['name']); 
      
      if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $Carpeta_Destino__path)) 
      { 
          echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido";
      }
  }
  else
      {
          echo "Ha ocurrido un error al cargar los archivos!";
      }
      
      
      
      
     
   
//***** Zona de validaciones de los campos     
                 
     //$NombreUsuario=($_SESSION['usuario_id']);
     
     if(!empty($_POST['AP-R1']))
     {
       $Resultado=($_POST['AP-R1']);  
     }       
             
     $Indicador="AP-R1-I1";
     $MedioVerific="Documentos";
     $Supuesto="*implementacion adecuada del sistema obligatorio de garantia de calidad *Voluntad politica *Capacidad de gestion de los responsables del SOGC en el MSPS";
     
     session_start(); //Iniciamos o Continuamos la sesion
     $Actividad=$_SESSION['Actividad'];
     $ActividadIndicador1=($_POST['AP-R1-I1-A1-i1']);  
     $ActividadIndicador2=($_POST['AP-R1-I1-A1-i3']);  
     $ActividadIndicador3=($_POST['AP-R1-I1-A1-i4']);  
     
     $ActividadIndicadores=$ActividadIndicador1.$ActividadIndicador2.$ActividadIndicador3;
     
     $ActividadMedioVerif="Guias Actualizadas"."Guias Auditoria Clinica"."Informes de auditoria de EPS y DTS";//ACA CONCATENO TODOS LOS MEDIOS EN UNA SOLA CADENA DE MEDIOS
     $ActividadSupuesto="";//NULL
     $Observaciones=""; 
     
     $Path_Documento="";
     
     $RespDocumento1="";
     $RespDocumento2="";
     $RespDocumento3="";

     
     if(!empty($_POST['observaciones']))
     {
     //Asigno las observaciones del usuario
        $Observaciones=($_POST['observaciones']);
     }
        else
        {             
            //$error[]="El Nombre del Paciente es un dato obligatorio";
            $Observaciones="NINGUNA";
        }
     //************************************************************     
     if(!empty($_POST['ConfirmaI1']))
     {
     //Asigno la primera respuesta para el primer indicador
        $RespDocumento1=($_POST['ConfirmaI1']);
        
        if(($RespDocumento1=='S')&&(empty($_POST['Cargue1'])))
        {
            $error[]="Debe efectuar el cargue del documento para el indicador i1";
        }
        
        
     }
        else
        {             
            $error[]="Debe Confirmar si hay o no cargue en el indicador i1";
        }

     
     //************************************************************            
     if(!empty($_POST['ConfirmaI3']))
     {
     //Asigno la primera respuesta para el segundo indicador
        $RespDocumento2=($_POST['ConfirmaI3']);
        
        if(($RespDocumento2=='S')&&(empty($_POST['Cargue2'])))
        {
            $error[]="Debe efectuar el cargue del documento para el indicador i2";
        }
        
        
     }
        else
        {             
            $error[]="Debe Confirmar si hay o no cargue en el indicador i2";
        }

//************************************************************            
     if(!empty($_POST['ConfirmaI4']))
     {
     //Asigno la tercera respuesta para el tercer indicador
        $RespDocumento3=($_POST['ConfirmaI4']);
        
        if(($RespDocumento3=='S')&&(empty($_POST['Cargue3'])))
        {
            $error[]="Debe efectuar el cargue del documento para el indicador i3";
        }
        
        
     }
        else
        {             
            $error[]="Debe Confirmar si hay o no cargue en el indicador i3";
        }

     //************************************************************            
     //************************************************************            
        
        
        
        if(count($error)>0)
                    {
                        echo mensaje_respuesta($error,'error');
                        $datos=$_POST;
                        ?>
                           <script type="text/javascript">
                           //<script lang="javaScript">
                            alert("Debe Confirmar el cargue de archivos en todos los indicadores del formulario");   
                            history.back();
                           </script>
                         <?PHP
                         $Form_Valido=true;
                    }
		 else
		 {

                     $gestion_clas=new Gestion();  
                     $gestion_clas->ProcesarCapturaNovedades_Atencion($_SESSION['usuario_id'],$Resultado,$Indicador,$MedioVerific,$Supuesto,$Actividad,$ActividadIndicadores,$ActividadMedioVerif,$ActividadSupuesto,$Observaciones,$Path_Documento);

                         ?>
                           <script type="text/javascript">
                           //<script lang="javaScript">
                            alert("El Proceso de Envio de documentos fue realizado Exitosamente");   
                            //window.location.href='./index2.php';
                            window.location.href='../index2.php?p=captura_datos_Atencion&carp=2';
                           </script>
                         <?PHP
                     //echo mensaje_respuesta(array("El Proceso de Captura fue realizado con Exito"),'conf'); 
		 }
  }//Fin IF operacion POST
      
//***************************************************************************
//CUERPO DE INSTRUCCIONES PRINCIPALES PARA CARGAR LOS FORMULARIOS DE LAS VISTAS
//***************************************************************************       
       //EVALUO SI AUN NO ESTA CORRECTAMENTE DILIGENCIADO EL FORMULARIO DE NOVEDADES USANDO ESTA BANDERA $Form_Valido
       if($Form_Valido===false)
       {            
                echo start_form($_SERVER['PHP_SELF']."?p=$_GET[p]&carp=$_GET[carp]",array("name"=>"datos"));
                echo hidden_field("operation","01000000000");
                $datos=$_POST;
                $nombre_form="CARGUE ACTIVIDADES";
                $boton_form="ENVIAR";
                include "../vista/Detalle_Cargue_ActividadesV.php";
                echo end_form();  
        }
    
  //FIN IF VALIDACION INICIO SESION

else
 echo mensaje_respuesta(array("Usuario debe Iniciar Sesion&oacute;n."), $tipo);
?>