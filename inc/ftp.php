<?PHP
function get_file($ftp_server="intouch.dossi.com",
		$user_name="manager",$user_pass="sim0n",
		$file_toget="",$destination="/user2/daily/") {
// set up basic connection

$conn_id = ftp_connect($ftp_server); 
if (!$conn_id){
	echo "Couldn't connect!";
}
// login with username and password
$login_result = ftp_login($conn_id, "$user_name", "$user_pass"); 

// check connection
if ((!$conn_id) || (!$login_result)) { 
        echo "Ftp connection has failed!";
        echo "Attempted to connect to $ftp_server for user $user_name"; 
        die; 
    } else { 

        echo "Connected to $ftp_server, for user $user_name<br>";
    }
//change directory to /user2/flatfiles
$chg_dir = ftp_chdir($conn_id, "/user2/flatfiles/");

if (!$chg_dir) {
	echo "Change directory has failed!";
    } else {
	echo "changed directory<br>";
    }
// upload the file
$path = $destination.$file_toget;
$upload = ftp_get($conn_id, "$path", "$file_toget", FTP_ASCII); 

// check upload status
if (!$upload) { 
        echo "Ftp upload has failed!";

    } else {
        echo "downloaded $file_toget from $ftp_server<br>";
	$result = "success";
    }
// close the FTP stream 
ftp_quit($conn_id); 

return $result;
}
//-------------------------------------------------------------------------------------------------------------
//Funcion FTP que sube un archivo al servidor
//Oscar Eduardo Vargas Llanos    $destination="/usr/local/apache/htdocs/documentos" //Servidor 7
function put_file_ftp($ftp_server="200.1.6.188",
                $user_name="upload",$user_pass="d3sarr0ll0",
                $file_toget="",$file_rename,$destination="/htdocs/documentos",$delete_a="No")
{
 //Veerificamos la existencia del archivo
 if(file_exists($file_toget))
{
 // Realizamos Conexion
 $conn_id = ftp_connect($ftp_server);
 if (!$conn_id)
 {
   echo "No hay conexión con el servidor!";
   die;
 }
 // Verificamos el usuario y el password
 $login_result = ftp_login($conn_id, "$user_name", "$user_pass");

 // check connection
 if ((!$conn_id) || (!$login_result)) 
 {
        echo "Conexión Ftp Fallo!";
        echo "No se pudo conectar al servidor";
        die;
 } 

 //print "$conn_id $destination";
 //Cambiamos el directorio a la ruta especificada
 $chg_dir = ftp_chdir($conn_id, "$destination");

 if (!$chg_dir) 
    {
        echo "El cambio del directorio Fallo!";
	die;
    } 
 // Subimos el archivo
 $path = $file_toget;
 $upload = ftp_put($conn_id,$file_rename,$file_toget,FTP_BINARY);

 // check upload status
 
 //$upload=copy ($file_toget, $destination."/".$file_rename);
 
 if (!$upload) {
        echo "No se pudo guardar el archivo!";
	die;
    } 
 // close the FTP stream
 ftp_quit($conn_id);
}
 else
 {
  echo "El archivo no existe";
  die;
 }
if($delete_a == 'Yes')
   unlink($file_toget);
}//Fin subir archivo
//------------------------------------------------------------------------------------
//Funcion que realiza una conexion FTP
//Por Oscar Eduardo Vargas Llanos
function ftp_abrir($ftp_server="200.1.6.188",$user_name="upload",$user_pass="d3sarr0ll0")
{
 global $ftp_conectar;
 // Realizamos Conexion
  $ftp_conectar = ftp_connect($ftp_server);

 if (!$ftp_conectar)
    {
     echo "No hay conexión con el servidor!";
     die;
    }
 
    // Verificamos el usuario y el password
    
    $login_result = ftp_login($ftp_conectar, "$user_name", "$user_pass");
    
    // check connection

    if ((!$ftp_conectar) || (!$login_result))
    {
     echo "Conexión Ftp Fallo!";
     echo "No se pudo conectar al servidor";
     die;
    }
}
//-------------------------------------------------------------------------------------
//Cierra la conexion ftp
function ftp_cerrar()
{
 global $ftp_conectar;
 ftp_quit($ftp_conectar);
}
//-------------------------------------------------------------------------------------
//Borra un fichero del seridor FTP
function borrar_fichero($ruta_link)
{
 global $ftp_conectar;
 return ftp_delete($ftp_conectar,"$ruta_link");
}
//-------------------------------------------------------------------------------------
//define la ubicacion donde se guardara el archivo..
//Si los archivos se guardan locamente se utiliza una funcion, de lo contrarario utilizamos la de FTP
/*
$nombre_archivo=Nombre con el que se subio el archivo
$origen_archivo=Ruta donde se encuentra almacenado. ejem archivos temporales
$nombre_dado= Nombre con el que se guardara el archivo
*/
function almacenar_documento($opcion,$origen_archivo,$nombre_dado)
{
 switch($opcion){
 case 1://Documentos de personal
  $ruta_almacen=$GLOBALS['server_sys']."/documentos/personal";
 break;
 case 2://
 
 break; 
 default:
   echo "no se encontro la ruta donde guardar el archivo";
  return false;
  break;  
 }//fin switch 
 
 //usando ftp
 //Cuando se llegue a necesitar ?????????????????????????????????.. arriba esta la funcion
 //usando una ruta local
 return ruta_local($ruta_almacen,$origen_archivo,$nombre_dado);
 
 
}//fin funcion
//-------------------------------------------------------------------------------------------------------
//Copia el archivo en la ruta especificada.
//no utilizar esta funcion directamente, llamar a almacenar_documento
function ruta_local($ruta_almacen,$origen_archivo,$nombre_dado){

	 if(file_exists($origen_archivo))
	   if(!copy("$origen_archivo","$ruta_almacen/$nombre_dado"))
	   	return false;
		else
		chmod("$ruta_almacen/$nombre_dado",0777);	//Por si hay que eliminarlo despues..

	return true;
}
?>