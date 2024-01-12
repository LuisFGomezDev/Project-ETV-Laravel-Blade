<?PHP

$agentes_clas=new usuarios();

if($_GET['idagente']>0 || $_POST['idagente']>0)
{
        $rs_agentes=$agentes_clas->listado_agentes();
	echo start_form($_SERVER['PHP_SELF']."?p=$_GET[p]&carp=$_GET[carp]",array("name"=>"datos"));
	echo hidden_field("operation","01000000000");	
	echo hidden_field("idagente",$_GET['idagente'].$_POST['idagente']);
	
	$nombre_form="!! ATENCION !!";
	//$boton_form="Reinicializar Password";
        $no_actualizar="RO";
	include "./vista/formato_Reinicializar_ClaveagenteV.php";
        
        //****************************************************************
        
        
        
        
        //****************************************************************
        
	echo end_form();
	include "./inc/fin_pagina.php";
 
}//FIN IF GENERAL
?>