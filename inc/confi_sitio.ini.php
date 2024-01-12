<?PHP
    //--------------------------------------------------------------------------
	//Configuración del sitio
    //--------------------------------------------------------------------------	
	$carpeta_web="Aplicacion_ETV";//Carpeta donde esta alojado baul de tesoros
	//Debe de ir con http://www.dominio.xxx   : Si no la notificacion de pago de usuarios no funciona.
	//$dire_web="http://192.168.130.48";//direccion web o local.
	$dire_web="http://localhost";//direccion web o local.
	//IpPublica es: http://190.70.103.100/tourlink/index2.php
                
        $rootWeb=$dire_web."/$carpeta_web";//direccion Web.
	$rootSys="D:/www/$carpeta_web";
	$urlAppend="/$carpeta_web";

	//--------------------------------------------------------------------------
	//Nombre de la sesion del sitio
	//--------------------------------------------------------------------------

	$usuarios_sesion="auten_ETV";
	$GLOBALS['db']=null;

	//Nombre del sitio Web
	$nombre_sitio_web="<-- ETV -->";
?>