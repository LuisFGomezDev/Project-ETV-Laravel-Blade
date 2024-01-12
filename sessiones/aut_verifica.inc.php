<?PHP
// Cargar datos conexion y otras variables 
require "../inc/confi_sitio.ini.php";
require "../inc/conexion.php";
include("../inc/adodb5/adodb-exceptions.inc.php"); 
include "../inc/adodb5/adodb.inc.php"; //Libreria de DB
require_once "../modelos/usuariosM.php";

//Chequear pagina que lo llama para devolver errores a dicha p�gina.

$url = explode("?",$_SERVER['HTTP_REFERER']);

$pag_referida=$url[0];
$redir=$pag_referida."?opc=p_1&mod=u";


if(!empty($_GET['asesorverifica']) && !empty($_GET['validaverifica']))
{
    $_POST['user']=$_GET['asesorverifica'];
    $_POST['pass']=$_GET['validaverifica'];
}

// Chequeamos si se esta autentificandose un usuario por medio del formulario
if (isset($_POST['user']) && isset($_POST['pass']))
 {

    $pass=$_POST['pass'];

	$usuarios_clas=new usuarios();
	//$GLOBALS['db']->SetFetchMode(ADODB_FETCH_ASSOC);
	// $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC
	
	$_POST['user']=stripslashes($_POST['user']);
	//$GLOBALS['db']->debug=true;
    $recorSet= $usuarios_clas->datosGestor(trim($_POST['user']));	
	
   // miramos el total de resultado de la consulta (si es distinto de 0 es que existe el usuario)
   if ($recorSet)
    {
	  /******************************************************************
	  	si el password no es correcto ..
        salimos del script con error 3 y redireccinamos hacia la p�gina de error
	  *******************************************************************/
	  
    if ($pass != $recorSet->fields['pasw']) 
    {
        $GLOBALS['db']->Close();
        header ("Location: $redir&error_login=3");
	exit;
    }

    // le damos un mobre a la sesion.
    session_name($usuarios_sesion);
     // incia sessiones
    session_start();

    //Paranoia: decimos al navegador que no "cachee" esta p�gina.
    session_cache_limiter('nocache,private');

        // definimos usuarios_id como IDentificador del usuario en nuestra BD de usuarios
        $_SESSION['usuario_id']=$recorSet->fields['idAgente'];
        //definimos usuario_password con el Nivel de acceso del usuario de nuestra BD de usuarios
        $_SESSION['usuario_login']=$_POST['user'];
        $_SESSION['usuario_nombre']=$recorSet->fields['nombreAsesor'];
        // Perfil de usuario
        $_SESSION['usuario_perfil']=$recorSet->fields['perfil'];
        //Variable de session que evita la recarga de una pagina en situaciones criticas.
        $_SESSION['usuario_transaccion']=array();
        $_SESSION['usuario_url']="";
  	$GLOBALS['db']->Close();
	//echo "Estamos en este punto";exit;
	//if($_SESSION['usuario_perfil']=='M' || $_SESSION['usuario_perfil']=='C' || $_SESSION['usuario_perfil']=='T')
	 header ("Location: ../index2.php");
	//else	
        //header ("Location: ../index.php");
    exit;
    
   } else {
      // si no esta el nombre de usuario en la BD o el password ..
      // se devuelve a pagina q lo llamo con error
      $GLOBALS['db']->Close();
      header ("Location: $redir&error_login=2");
      exit;}
} else {
// usamos la sesion de nombre definido.
session_name($usuarios_sesion);
// Iniciamos el uso de sesiones
session_start();
}
?>