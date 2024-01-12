<?PHP
if (!defined("LOADED_HEADER"))
{
	
	require ("c:\\wamp\\www\tourlink\inc\confi_sitio.ini.php");

	header('Content-Type: text/html; charset=utf-8');  

	include("$rootSys/inc/adodb5/adodb.inc.php"); //Libreria de DB
	include_once("$rootSys/inc/adodb5/adodb-exceptions.inc.php");
	include "$rootSys/inc/conexion.php";

   define("LOADED_HEADER", "yes");
   include $rootSys."/inc/basic.php";   
   $GLOBALS['server_root']="/$carpeta_web";
   $GLOBALS['server_sys']=$rootSys;
   $GLOBALS['server_web']=$dire_web."/$carpeta_web";//No lo modifique.. Oscar Llanos   
}

$default_page_title = "Codensa";
?>