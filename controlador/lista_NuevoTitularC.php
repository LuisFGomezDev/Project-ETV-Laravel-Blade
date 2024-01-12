<?PHP
include "./modelos/gestionM.php";

$gesClas=new Gestion();


if($_SESSION['usuario_perfil']=='M' || $_SESSION['usuario_perfil']=='L')
 $rs=$gesClas->informacionGestionVenta('A','fun_ListaTitulares');
else    
 $rs=$gesClas->ActivacionesPendientes($_SESSION['usuario_id']);//Muestro lo que tiene cargado

if($rs->RecordCount()>0)
{    
  echo "<h3>LISTADO NUEVOS TITULARES</h3><hr>";
  $url="?p=$_GET[p]&carp=$_GET[carp]";
  echo start_form($_SERVER['PHP_SELF']."$url",array("name"=>"verificacion"));
  
  echo start_table();  
  
  echo table_row_th(table_cell_th("Nombre Titular"),table_cell_th("Identificacion del Titular"));
  
  while(!$rs->EOF){
      
    echo table_row(
            table_cell($rs->fields['cliente']),
            table_cell($rs->fields['documento']));  
      
    $rs->MoveNext();
  }
  
  echo end_table();
  echo button_field("solicitarActivar","Solicitar Siguiente",array("onclick"=>"asignarActivacion();"));           
  echo end_form();
  
}
else
{
 echo mensaje_respuesta(array("No hay activaciones pendientes"), $tipo);
 echo button_field("solicitarActivar","Solicitar Siguiente",array("onclick"=>"asignarActivacion();"));           
}            
?>
<div id="realizarAsignacion"></div>