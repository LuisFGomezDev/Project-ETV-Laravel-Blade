 <?PHP
//Muestra todos los errores menos los de notificacion,
//error_reporting(E_ALL ^ E_NOTICE);
if (!defined("LOADED_HEADER"))
{	
	require ("D:\\www\\Aplicacion_ETV\\inc\\confi_sitio.ini.php");
	

	if(empty($sin_session))
       {
		session_name($usuarios_sesion);
		session_start();
		
		if(!empty($_GET['cerrar_s'])){
		 session_destroy();	
		 //$GLOBALS['db']->Close();
		 header("Location: ".$_SERVER['PHP_SELF']);
		}
				
		//Si no existen la variables las creamos
/*		if(empty($_SESSION['idgestion']))
 *             {		 
		 $_SESSION['idgestion']=-1;
                 $_SESSION['voz']=array();
                 $_SESSION['texto']=array();
                 $_SESSION['municipioSelec']=0;

 
		}
                */

	}//fin si session

    header('Content-Type: text/html; charset=utf-8');  
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");                       // Expira en fecha pasada
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");          // Siempre página modificada
    header("Cache-Control: no-cache, must-revalidate");                     // HTTP/1.1
    header("Pragma: no-cache");                                             // HTTP/1.0

	include("$rootSys/inc/adodb5/adodb.inc.php"); //Libreria de DB
	include_once("$rootSys/inc/adodb5/adodb-exceptions.inc.php");
	include "$rootSys/inc/conexion.php";

	include "$rootSys/modelos/usuariosM.php";
	
	$gestor=new usuarios();
	
	//--------------------------------------------------------------------------
   //include $rootSys."/inc/charset.php";
   include $rootSys."/inc/basic.php";   
   define("LOADED_HEADER", "yes");
   $GLOBALS['server_root']="/$carpeta_web";
   $GLOBALS['server_sys']=$rootSys;
   $GLOBALS['server_web']=$dire_web."/$carpeta_web";//No lo modifique.. Oscar Llanos   
    //ruta donde se encuentra intalado el servidor postgres.
}

//$default_page_title = "<-- Claro Republica -->";
$default_page_title = "<-- ETV -->";

?>