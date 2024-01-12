<?PHP
include "./inc/header.php";
include "./modelos/gestionM.php";

if(!empty($_GET['idventa']))
if($_GET['idventa']<0){

	/*****************************************************************
		Si es menor que 0 es una actualizacion de administrador.
	******************************************************************/
	
	include "./inc/fin_pagina.php";
		
	switch($_GET['idventa']){
		
		case -1: header("Location: $rootWeb/index2.php?p=aprobar_ventas&carp=mesaControl");  break;			
                case -2: header("Location: $rootWeb/index2.php?p=error_ventas&carp=mesaControl");  break;
                case -3: header("Location: $rootWeb/index2.php?p=generar_sabana&carp=sabana");  break;
	}
	
	exit;
	
}


$gestion_clas=new Gestion();

echo "<fieldset>";
				

echo start_form($_SERVER['PHP_SELF'],array("name"=>"datos"));

if(!empty($_GET['idventa']))
{

  $row=$gestion_clas->consultar_gestion($_GET['idventa']);  
  $telefono=$row->fields['GES_TELELLAMADA'];
  $telCliente=$row->fields['GES_MSISDN'];
  $tipifica=$row->fields['TIP_IDTIPIFICACION'];
  $tabla="GESTION";
  
  if($tipifica==20)
   $venTa="VR_101";
  else
   $venTa="VT_101";
  
  $etiqueta=$telefono."_".$telCliente."_".$_GET['idventa']."_$venTa";
 
echo hidden_field("grabacion",$etiqueta);
echo hidden_field("tipificacion",$tipifica);
echo hidden_field("idgestion",$_GET['idventa']);
echo hidden_field("tabla",$tabla);

$datosOpcion="Venta Registrada:>$_GET[idventa]";

}
else
{
  $row=$gestion_clas->consultar_gestionFinLlamada($_GET['idgestion']);  
  $telefono=$row->fields['GES_TELELLAMADA'];
  $telCliente=$row->fields['GES_MSISDN'];
  $tipifica=$row->fields['TIP_IDTIPIFICACION'];
  
  $tabla="GESTION";
  
  if(!empty($row->fields['GES_REALIZOVENTA']))
   $venTa="NR_100";
  else
   $venTa="NV_100";
   
  $etiqueta=$telefono."_".$telCliente."_".$_GET['idgestion']."_$venTa";
 
echo hidden_field("grabacion",$etiqueta);
echo hidden_field("tipificacion",$tipifica);
echo hidden_field("idgestion",$_GET['idgestion']);
echo hidden_field("tabla",$tabla);

$datosOpcion="Gestion n&uacute;mero:$_GET[idgestion]";	
}
echo "<legend>$datosOpcion</legend>";
echo "	<p>			
			<br>&nbsp;&nbsp;&nbsp;
		</p>";
		
echo "</fieldset>";
echo end_form();

session_destroy();//Destruimos todas la variables de session.

//echo "<A href='./index.php'>Volver A intentar</A>";

include "./inc/fin_pagina.php";
?>