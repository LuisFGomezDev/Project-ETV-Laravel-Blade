<?PHP

if(($_POST['user']=="" or $_POST['pass']=="") and empty($inicio_session))
    {
 	header ("Location:".$_SERVER['HTTP_REFERER']);
 	exit;
    }
 
require("aut_verifica.inc.php");
?>