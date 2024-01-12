<?PHP
/*******************************************************************************************
   GENERA REPORTE POR PANTALLA DE LAS NOVEDADES DE PACIENTES / EXAMENES / SVF
********************************************************************************************/
$GLOBALS['db']->SetFetchMode(ADODB_FETCH_NUM); 

include "inc/header.php";

$Form_Valido=false;
$GeneracionArchivo=0;
$ActivaCampaña=0;

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

        else        
            
            
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
     }//FIN IF EVALUA OPCION ELEGIDA PARA GENERAR EL INFORME   
     else
     {
       $error[]="Debe elegir el tipo de informe a Generar ...";  
     }//Fin Else EXTERNO opcion NO HA ELEGIDO EL TIPO DE INFORME
     
     
//***************************************************************************
//****ZONA DE CONTEO E IMPRESION DE MENSAJES DE ERROR POR PANTALLA
//************************************************************            
            if(count($error)>0)
            {
                echo mensaje_respuesta($error,'error');
                $datos=$_POST;
                ?>
                  <script type="text/javascript">
                    alert("Debe diligenciar Todos los datos necesarios para Generar el Listado");   
                    history.back();
                  </script>
                <?PHP
             }//FIN IF COUNT
             else
	     {//INICIO ELSE COUNT ERRORES
             
             
//***************************************************************************
//SI YA NO HAY ERRORES Y EL FORMULARIO ESTA COMPLETO ENTONCES PASAMOS A LISTAR LOS DATOS POR PANTALLA
//******************************* ********************************************
                 include "./modelos/gestionM.php";
                 $gesClas=new Gestion();
                
                if($_SESSION['usuario_perfil']=='M' || $_SESSION['usuario_perfil']=='L' || $_SESSION['usuario_perfil']=='B')
                    {
                        $rs=$gesClas->Listado_Novedades_Pacientes($FechaInicial,$FechaFinal,$TipoInforme,$NomAgente);
                    }
                  else    
                    {
                        $rs=$gesClas->Listado_Novedades_Pacientes($FechaInicial,$FechaFinal,$TipoInforme,$NomAgente);
                    }
                
                //INICIO FUNCION Construir_reporte_Novedades
                   if($rs->RecordCount()>0)
                  {
                    echo start_form($_SERVER['PHP_SELF']."?p=$_GET[p]&carp=$_GET[carp]",array("name"=>"datos"));
                    echo hidden_field("operation","01000000000");
                    $datos=$_POST;
                    $nombre_form="LISTADO DATOS PACIENTE";
                    $boton_form="LISTAR";
                    
                    if($ActivaCampaña==0)
                      {
                        include "./vista/Lista_DatosPacientesV.php";
                      }
                    else

                    if($ActivaCampaña==1)
                      {
                        include "./vista/Lista_DatosParticularesV.php";
                      }

                    else

                    if($ActivaCampaña==2)
                      {
                        include "./vista/Lista_Datos_CardiologiaV.php";
                      }
                      
                    else
                   
                    if($ActivaCampaña==3) 
                        
                      {
                        include "./vista/Lista_Datos_Otros_ExamenesV.php";
                      }
                          
                      //***************************************
                      //ZONA NUEVOS MODULOS********************
                      //***************************************
                      
                    else
                   
                    if($ActivaCampaña==4) 
                        
                      {
                        include "./vista/Lista_Datos_No_Mas_CiegosV.php";
                      }

                    else
                   
                    if($ActivaCampaña==5) 
                        
                      {
                        include "./vista/Lista_Datos_MamografiasV.php";
                      }

                    else
                   
                    if($ActivaCampaña==6) 
                        
                      {
                        include "./vista/Lista_Datos_MilitaresV.php";
                      }

                    else
                   
                    if($ActivaCampaña==7) 
                        
                      {
                        include "./vista/Lista_Datos_OtorrinoV.php";
                      }

                    else
                        //******LISTA DATOS AGENTE ESPECIFICO
                        //******INHABILITADO*******
                      {
                        //include "./vista/Lista_Datos_AgenteEspecificoV.php";
                      }
                      
                    
                    $Form_Valido=true;
                    echo end_form();  
                      //  $GeneracionArchivo=1;
                  }//Fin del IF
                  else
                  {
                        /*$texto= mensaje_respuesta(array("No se encontraron resultados para mostrar"),'error');
                        echo $texto;*/
                        
                ?>
                            <script type="text/javascript">
                                alert("No se encontraron resultados para mostrar");   
                                history.back();
                            </script>
                <?PHP
                  }
		}//INICIO ELSE COUNT ERRORES
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
                $nombre_form="LISTADO EXAMENES";
                $boton_form="LISTAR";
                include "./vista/Lista_Novedades_PacientesV.php";
                echo end_form();  
        }
    
  }//FIN IF VALIDACION INICIO SESION


else
 echo mensaje_respuesta(array("Usuario debe Iniciar Sesi&oacute;n."), $tipo);
//}//FIN DEL IF GENERAL EXTERNO
?>
