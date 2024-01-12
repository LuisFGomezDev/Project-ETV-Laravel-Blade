<?PHP
/*

********************************************************
*** This script from MySQL/PHP Database Applications ***
***         by Jay Greenspan and Brad Bulger         ***
***                                                  ***
***   You are free to resuse the material in this    ***
***   script in any manner you see fit. There is     ***
***   no need to ask for permission or provide       ***
***   credit.                                        ***
********************************************************
*/
// void authenticate ([string realm] [, string error message]])

// Send a WWW-Authenticate header, to perform HTTP authentication.
// The first argument is the text that will appear in the pop-up
// form presented to the user. The second argument is the text
// that will appear on the 401 error page if the user hits the
// 'Cancel' button in the pop-up form.

// This code only works if PHP is running as an Apache module.

function authenticate ($realm="Secure Area",$errmsg="Please enter a username and password")
 {
   Header("WWW-Authenticate: Basic realm=\"$realm\"");
   Header("HTTP/1.0 401 Unauthorized");
   die($errmsg);
 }

function imperius_auth($level="0")
 {
    //print "En proceso de facturacion. Dpto Sistemas.";
    //exit;
     global $PHP_AUTH_USER;
     global $PHP_AUTH_PW;
     global $REMOTE_ADDR;
     global $simon;
     $userIP = $REMOTE_ADDR;

/*
         if (preg_match("/200.1.0/","$userIP")      //Router's
         || (preg_match("/200.1.1/","$userIP"))     //Wan Bogota
         || (preg_match("/200.1.11/","$userIP"))     //Wan Bogota 2 WTC
         || (preg_match("/200.1.2/","$userIP"))     //Wan Cali
         || (preg_match("/200.1.6/","$userIP"))     //Wan Bogota
         || (preg_match("/200.1.7/","$userIP"))     //Wan Bucaramnga
         || (preg_match("/200.1.67/","$userIP"))     //Wan Armenia
         || (preg_match("/192.168.99./","$userIP"))     //VPN Mobil
         || (preg_match("/192.168.68/","$userIP"))     //VPN Manizales
         || (preg_match("/192.168.63/","$userIP"))     //VPN Santa Rosa de Cabal
         || (preg_match("/192.168.1/","$userIP"))     //VPN Bogota
         || (preg_match("/192.168.2/","$userIP"))     //VPN Cali
         || (preg_match("/192.168.9/","$userIP"))     //VPN NY
         || (preg_match("/200.93.146./","$userIP"))     //ETB WAN
	 || (preg_match("/192.168.67/","$userIP"))     //ETB WAN
	 || (preg_match("/192.168.7/","$userIP"))     //VPN BUC
	     
	 
    ){*/
	
        //Pagina de autentificacion
        //    if($REMOTE_ADDR=="200.1.6.169")//Ip que no participa en sessiones
  	    //	dossi_auth_sin_session();
   	    //    else
        if (!defined("SESSION_INICIADA"))
          {
                 include "c:/ServerWeb/www/imperius_comercial/sessiones/sessiones.php";
                 //include "C:/ServerWeb/EasyPHP-5.3.6.1/www/imperius_comercial/sessiones/sessiones.php";
				 define("SESSION_INICIADA","Session_Kima");
                 /*safe_query("INSERT INTO accesos_pag(codigo,ip,fecha,hora,pagina)
                                values('$_SESSION[usuario_id]','$userIP','".date("Y-m-d")."','".date("H:i:s")."',
                                '$_SERVER[PHP_SELF]')");*/
          }
      /*} else {
               header("Location:http://www.dossi.com");
               //authenticate();
             }*/
			 
			 
   }
/*}else
  //  {
      //header("Location:$link");
      //print $link; exit;
    //  define("LOADED_HEADER", "yes");
      //define("SESSION_INICIADA","Session_Dossi");
      //header("Location:$link");
      //print"<SCRIPT LANGUAGE='JavaScript'>
        //      window.location.href='$link';
          //  </SCRIPT>";
    //}*/

/*
function dossi_auth_diana($level="0")
{
//	print "En proceso de facturacion. Dpto Sistemas.";
//	exit;
	global $PHP_AUTH_USER;
	global $PHP_AUTH_PW;
	global $REMOTE_ADDR;
	$userIP = $REMOTE_ADDR;


   if (preg_match("/200.1.0/","$userIP")      //Router's
   || (preg_match("/200.1.1/","$userIP"))     //Wan Bogota
   || (preg_match("/200.1.11/","$userIP"))     //Wan Bogota 2 WTC
   || (preg_match("/200.1.2/","$userIP"))     //Wan Cali
   || (preg_match("/200.1.6/","$userIP"))     //Wan Bogota
   || (preg_match("/200.1.7/","$userIP"))     //Wan Bucaramnga
   || (preg_match("/192.168/","$userIP"))     //Wan VPN
   || (preg_match("/67.87.113/","$userIP"))     //Intouch
   || (preg_match("/67.87.118/","$userIP"))     //Intouch
   || (preg_match("/67.87.119/","$userIP"))     //Intouch
   || (preg_match("/69.118.31/","$userIP"))     //Intouch
   || (preg_match("/170.206./","$userIP"))     //Intouch
   || (preg_match("/200.21./","$userIP"))     //Telecom
   || (preg_match("/200./","$userIP"))     //Manizales Internet
   || (preg_match("/216./","$userIP")) ){   //Manizales Internet

//if (!isset($PHP_AUTH_USER)) {
//		authenticate();
//       	 exit;
//	} else if ($level=="0" && isset($PHP_AUTH_USER) && ($PHP_AUTH_PW !="cl13nt3")) {
//		authenticate();
//                exit;
//	}
	db_authenticate();
   } else {
		   header("Location:http://www.dossi.com");
           //authenticate();
		   }
}
*/
// void db_authenticate([string table [, string realm [, string error message [, string username field name [, string password field name]]]])

// Uses HTTP authentication to get a user name and password, and then
// verifies that against a database table. The first argument is the
// name of the table to use - the default is mysql.users.  The second
// and third arguments are passed in to the authenticate() function.
// The fourth and fifth arguments are the names of the fields in the
// database table - default values are 'username' and 'password'.

// This code only works if PHP is running as an Apache module.

function db_authenticate($table="personal",$realm="Secure Area"
	,$errmsg="Please enter a username and password"
	,$user_field="codigo"
	,$password_field="clave"
)
{
	global $PHP_AUTH_USER;
	global $PHP_AUTH_PW;

	if (empty($PHP_AUTH_USER))
	{
		authenticate($realm,$errmsg.": header");
	}
	else
	{
		if (empty($user_field)) { $user_field = "username"; }
		if (empty($password_field)) { $password_field = "password"; }

	        $dimedime=md5($PHP_AUTH_PW);
		/*
		  $query = "select $user_field from $table 
			where $password_field = '$PHP_AUTH_PW' 
			and $user_field = '$PHP_AUTH_USER' and activo='t'
		  ";
		 */
		
		if($PHP_AUTH_PW!='cl13nt3')
		{
		   $query = "select $user_field,fecha_clave from $table
                        where $password_field = '$dimedime'
                        and $user_field = '$PHP_AUTH_USER' and activo='t'
                    ";
		}
		 else
		 {
		  $query = "select $user_field,fecha_clave from $table
                        where $password_field = '$PHP_AUTH_PW'
                        and $user_field = '$PHP_AUTH_USER' and activo='t'
                    ";
		 }
        	
          $result1 = safe_query($query);

////         {
              $num_rows=pg_numrows($result1);
               //if ($result) { list($valid_user) = pg_fetch_row($result,0); }
                if ((!$result1|| pg_numrows($result1)==0) and $PHP_AUTH_PW!='cl13nt3')
                 {
                    authenticate($realm,$errmsg.": query");
                 }
		        else
		           {
                     if (pg_numrows($result1)>0)
		               {
	                 	 //Si el usuario no ha modificado su clave en 28 dias, se le pide que la cambie
	 	                 $row=pg_fetch_row($result1);
		                 if (($PHP_AUTH_PW=='cl13nt3' || antigue($row[1])>=28))
			               {
			                	print "<script language=javascript>

                             	function cerrar()
				                  {
				                     window.open(\"/utilities/clave.php?PHP_AUTH_USER=$PHP_AUTH_USER\", \"Clave\",\"toolbar=no,menubar=no,scrollbars=no,width=400,height=210,resizable=no\");
				                     
			 	                     var ventana = window.self;
		         	                 ventana.opener = window.self;
        		 	                 ventana.close();
			                         //parent.close();
				                  }
		                        </script>
			                     <script language=javascript>
               			         cerrar();
			                     </script>";
 			                 exit;
			               }//fin si
    	           }else
                       {
                          $query = safe_query_mysql("select usuario,password from usuario
                                                     where usuario='$PHP_AUTH_USER'");
                                                     
                            if ((!$query || mysql_numrows($query)==0))
                             {
                                authenticate($realm,$errmsg.": query");
                                exit;
                             }

                       }
		          //  else
                    //   {
                      //   authenticate($realm,$errmsg.": query");
                        // exit;
                      // }
     		    }//fin else
/*
$usuario_practica['R031']="R031";
$usuario_practica['R037']="R037";
$usuario_practica['R017']="R017";
$usuario_practica['R018']="R018";
$usuario_practica['R022']="R022";
$usuario_practica['R007']="R007";
$usuario_practica['R034']="R034";
$usuario_practica['R211']="R211";
$usuario_practica['R204']="R204";

$usuario_practica['R218']="R218";
$usuario_practica['S402']="S402";
$usuario_practica['R003']="R003";
$usuario_practica['R001']="R001";
$usuario_practica['R030']="R030";
$usuario_practica['R201']="R201";



		//Pagina de autentificacion
	     if (!defined("SESSION_INICIADA"))
   		  if($usuario_practica[$PHP_AUTH_USER]==$PHP_AUTH_USER)
	        if($_SERVER['PHP_SELF']!="/servicio/lu_cartera.php")
	       {
		 include "/var/www/simon/sessiones/sessiones.php";
		 define("SESSION_INICIADA","Session_Dossi");	
	       }	
      unset($usuario_practica);		
*/	
	}

			//where $password_field = password(lower('$PHP_AUTH_PW')) 
	#print "<h5>Editing as $PHP_AUTH_USER</h5>\n";

}//fin funcion

// string cleanup_text ([string value [, string preserve [, string allowed_tags]]])

// This function uses the PHP function htmlspecialchars() to convert
// special HTML characters in the first argument (&,",',<, and >) to their 
// equivalent HTML entities. If the optional second argument is empty,
// any HTML tags in the first argument will be removed. The optional
// third argument lets you specify specific tags to be spared from
// this cleansing. The format for the argument is "<tag1><tag2>".

function cleanup_text ($value = "", $preserve="", $allowed_tags="")
{
	if (empty($preserve)) 
	{ 
		$value = strip_tags($value, $allowed_tags);
	}
	$value = htmlspecialchars($value);
	return $value;
}

// string get_attlist ([array attributes [,array default attributes]])

// This function will take an associative array and format as a string
// that looks like 'name1="value1" name2="value2"', as is used by HTML tags.
// Values for keys in the first argument will override values for the
// same keys in the second argument. (For example, if $atts is (color=>red)
// and $defaults is (color=>black, size=3), the resulting output will
// be 'color="red" size="3"'.)
 
function get_attlist ($atts="",$defaults="")
{
	$localatts = array();
	$attlist = "";

	if (is_array($defaults)) { $localatts = $defaults; }
	if (is_array($atts)) { $localatts = array_merge($localatts, $atts); }

	while (list($name,$value) = each($localatts))
	{
		if ($value == "") { $attlist .= "$name "; }
		else { $attlist .= "$name=\"$value\" "; }
	}
	return $attlist;
}

// string make_page_title ([string title])

// This function will clean up a string to make it suitable for use
// as the value of an HTML <TITLE> tag, removing any HTML tags and
// replacing any HTML entities with their literal character equivalents.

function make_page_title ($title="")
{
	$title = cleanup_text($title);
	$trans = array_flip(get_html_translation_table(HTML_ENTITIES));
	$title = strtr($title, $trans); 
	return $title;
}

// string money ([mixed value])

// This function will format the first argument as a standard US dollars
// value, rounding any decimal value two decimal places for cents 
// and prepending a dollar sign to the returned string.

function money($val=0,$moneda="$")
{
	return "$moneda ". number_format($val,2,",",".");
}

// string get_local_ref ([string ref])

// This function will transform a local reference (such as "edit.php")
// to a local reference that begins with the root of the current
// script as defined by the Apache variable SCRIPT_NAME (such as
// "/book/guestbook/view.php"). It is used by the secure_url()
// and regular_url() functions to create an absolute URL out of
// a local reference.

// This behavior of this function if run under a server other than Apache
// is not known. It's likely to work, though, as SCRIPT_NAME is part of
// the CGI 1.1 specification.

function get_local_ref($ref="")
{
	global $SCRIPT_NAME;

	if (substr($ref,0,1) != "/")
	{
		$ref = substr($SCRIPT_NAME,0,strrpos($SCRIPT_NAME,"/")+1).$ref;
	}
	return $ref;
}

// string secure_url ([string ref])

// This function will transform a local URL into an absolute URL pointing
// to a secure server running on the same domain, as defined by the global
// Apache variable HTTP_HOST. (Note: the server we are using runs on 
// non-standard ports, thus the need to change the port numbers.)

function secure_url($ref="")
{
	global $HTTP_HOST;

	$url = "https://".$HTTP_HOST.get_local_ref($ref);
	$url = str_replace("8080","444",$url);
	return $url;
}

// string regular_url ([string ref])

// This function will transform a local URL into an absolute URL pointing
// to a normal server running on the same domain, as defined by the global
// Apache variable HTTP_HOST. (Note: the server we are using runs on 
// non-standard ports, thus the need to change the port numbers.)

function regular_url($ref="")
{
	global $HTTP_HOST;

	$url = "http://".$HTTP_HOST.get_local_ref($ref);
	$url = str_replace("444","8080",$url);
	return $url;
}

function get_sucursal($i26=""){
	global $suc_code;
	global $suc_direcion;
	global $suc_ciudad;
	global $suc_tel;
	global $suc_pate;

	switch ($i26) {
	    case 'V':
	        $suc_code='CAL';
		$suc_direcion='Avenida 3CN Nro. 47CN-35 Vipasa';
		$suc_ciudad='Cali';
		$suc_tel='(2) 664-4100';
		$suc_pate='70028';
	        break;
	    case 'CM':
	        $suc_code='BOG';
		$suc_direcion='Cra 31 # 98-67 Castellana';
		$suc_ciudad='Santa Fe de Bogota';
		$suc_tel='(1) 533-8515';
		$suc_pate='70016';
	        break;
	    case 'S':
	        $suc_code='BUC';
		$suc_direcion='Calle 52 # 31-129';
		$suc_ciudad='Bucaramanga';
		$suc_tel='(7) 657-3922';
		$suc_pate='70017';
	        break;
	    default:
	        $suc_code='PER';
		$suc_direcion='Calle 14 #23-82 Alamos';
		$suc_ciudad='Pereira';
		$suc_tel='(6)321-0909';
		$suc_pate='70005';
	}
	return ;
}


function codigo($Num)
{ 
// You can't get money from an empty card
	if (empty($Num)) { return FALSE; }
//  The Luhn formula works right to left, so reverse the number. 
	$Num = strrev($Num); 
	$Total = 0; 
	for ($x=0; $x<strlen($Num); $x++)
	{ 
		$digit = substr($Num,$x,1); 
//    If it's an even digit, double it 
		if ($x/2 != floor($x/2))
		{ 
			$digit *= 2; 
//    If the result is two digits, add them 
			if (strlen($digit) == 2)  
			{
				$digit = substr($digit,0,1) 
					+ substr($digit,1,1)
				; 
			}
		} 
//    Add the current digit, doubled and added if applicable, to the Total
		$Total += $digit; 
	} 
//  If it passed (or bypassed) the card-specific check and the Total is 
//  evenly divisible by 10, it's cool! 
		$Total = 10-($Total % 10);
		$codigo = strrev($Num) . $Total;
	return $codigo;
} 
function show_array($array)
{
    if (is_array($array)){
	echo "<table border=1>";
	while (list($key,$value) = each($array))
	{
	  echo "<tr><td>$key</td><td>$value</td></tr>";
	}
	echo "</table>"; 
    }
}

function ts2date($ts)
{
	$fdate=array();
	$fdate[ano]=substr("$ts",0,4);
	$fdate[mes]=substr("$ts",5,2);
	$fdate[dia]=substr("$ts",8,2);
	return $fdate;
}

function antigue($ts)
{
	$fdate=ts2date($ts);
	$fromdate = mktime(0,0,0,$fdate[mes],$fdate[dia],$fdate[ano]);
	$nowdate = time();
	$ageunix = $nowdate - $fromdate;
	$age = floor($ageunix / (24*60*60));
	return $age;
}
//------------------------------------------------------------------------------------------------
//Devuelve la deferencia de dias entre dos fechas ingresadas
//Oscar Eduardo Vargas Llanos
//Fecha 2005-08-30
function diferencia_dias($fecha_inicio,$fecha_fin)
{
        $fdate=ts2date($fecha_inicio);
        $fromdate = mktime(0,0,0,$fdate[mes],$fdate[dia],$fdate[ano]);
		
		unset($fdate);
        $fdate=ts2date($fecha_fin);
        $fecha_mayor = mktime(0,0,0,$fdate[mes],$fdate[dia],$fdate[ano]);		
		
        $ageunix = $fecha_mayor - $fromdate;
        $age = floor($ageunix / (24*60*60));

        return ($age);
}
//------------------------------------------------------------------------------------------------

function is_date($fecha)
{

        if (!empty($fecha) && strlen($fecha)==10)
        {
                $dia=substr($fecha,8,2);
                $mes=substr($fecha,5,2);
                $anio=substr($fecha,0,4);
                
				if (strlen($anio)==4 && is_numeric($anio) && is_numeric($mes) && is_numeric($dia) && $mes!="" && $dia!="")
                {
                   $output=checkdate($mes,$dia,$anio);
                }
                else
                {
                        $output=false;
                }
        }
	else
	{
		$output=false;
	}
        return $output;
}

//-----------------------------------------------------------------------------------------
//Evalua si una variable exsite
include($rootSys."/inc/db.php");
include($rootSys."/inc/html.php");
include($rootSys."/inc/forms.php");
include($rootSys."/inc/tables.php");

?>
