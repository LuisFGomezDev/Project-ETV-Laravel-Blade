<?PHP
/*
Creacion de usuarios
*/
//include "./inc/start_page.php";

$bandera=false;

if($_POST['operation'][1]=='1'){
	
	
	$gestor=new usuarios();
	$error=array();
	

	if(empty($_POST['login']))$error[]="El login es obligatorio";
	 else
	if($gestor->existeLogin($_POST['login'])!=0)
	 $error[]="El login ingresado ya existe";
	 	
	if(empty($_POST['documento']))$error[]="El n&uacute;mero de documento es obligatorio";
	 else
	if($gestor->existeGestor($_POST['documento'])!=0)
	 $error[]="El documento ingresado ya existe";
	 
	if(empty($_POST['nombre']))$error[]="El nombre es obligatorio";
        
	if(empty($_POST['clave']))
	 $error[]="La clave es obligatoria";
	else
	 if($_POST['clave']!=$_POST['clave2'])
	  $error[]="La clave inicial no es igual a la clave de confirmaci&oacute;n";
	
	if(empty($_POST['perfil']) || $_POST['perfil']=="0")
            $error[]="Debe de seleccionar el perfil";
		
		if(count($error)>0)
                {
                    echo mensaje_respuesta($error,'conf');
                   ?>
                           <script lang="javaScript">
                            alert("!!! ATENCION !!!  Todos los campos del Formulario son obligatorios");   
                            history.back();
                           </script>
                   <?PHP
		 
		 $datos=$_POST;	
		}
		else
		 {                  
			$gestor->crear_usuario($_POST['documento'],$_POST['nombre'],$_POST['clave'],$_POST['login'],$_POST['perfil']);			 
			//echo mensaje_respuesta(array("El agente fue creado Exitosamente"),'conf'); 
                   ?>
                           <script lang="javaScript">
                            alert("El agente fue creado Exitosamente");   
                            history.back();
                           </script>
                   <?PHP
			$bandera=true;
		 }
	
}

if($bandera===false){
echo start_form($_SERVER['PHP_SELF']."?p=$_GET[p]&carp=$_GET[carp]",array("name"=>"datos"));
echo hidden_field("operation","01000000000");
$nombre_form="Nuevo Agente";
$boton_form="Crear Agente";
include "./vista/formato_agenteV.php";
echo end_form();
}
?>