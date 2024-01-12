<?PHP
//Manejo del tab

function encabezado_tab($canti_tab,$nom_pestana,$op_css='S'){
	
	if($op_css=='S'){
?>	
	
		<style type="text/css">
<!--
	.row_on { color: #000000; background-color: #DDDDDD; }
	.row_off { color: #000000; background-color: #E8F0F0; }
	.th { color: #000000; background-color: #D3DCE3; }
	th.activetab
      {
        color:#000000;
        background-color:#D3DCE3;
        border-top-width : 2px;
        border-top-style : solid;
        border-top-color : Black;
        border-left-width : 2px;
        border-left-style : solid;
        border-left-color : Black;
        border-right-width : 2px;
        border-right-style : solid;
        border-right-color : Black;
      }

      th.inactivetab
      {
        color:#000000;
        background-color:#E8F0F0;
        border-width : 1px;
        border-style : solid;
        border-color : Black;
        border-bottom-width : 2px;
        border-bottom-style : solid;
        border-bottom-color : Black;
      }

      table.tabcontent
      {
        border-bottom-width : 2px;
        border-bottom-style : solid;
        border-bottom-color : Black;
        border-left-width : 2px;
        border-left-style : solid;
        border-left-color : Black;
        border-right-width : 2px;
        border-right-style : solid;
        border-right-color : Black;
      }

      table.tabcontent_cabeza
      {
        
        border-left-width : 2px;
        border-left-style : solid;
        border-left-color : Black;
        border-right-width : 2px;
        border-right-style : solid;
        border-right-color : Black;
      }



      .td_left { border-left : 1px solid Gray; border-top : 1px solid Gray; }
      .td_right { border-right : 1px solid Gray; border-top : 1px solid Gray; }

      div.activetab{ display:inline; }
      div.inactivetab{ display:none; }
-->
</style>
<script language="javascript" src="../funciones_js/validacion.js"></script>

		<!--JS Abre la clase javascript -->
            <script type="text/javascript" src="<?PHP echo $GLOBALS['server_root'];?>/js/tabs.js">
            tab.init();
            </script>

<?PHP
}
?>
<body onLoad="tab.init();">

<script type="text/javascript">
var tab = new Tabs(<?PHP echo $canti_tab; ?>,'activetab','inactivetab','tab','tabcontent','','','tabpage');
</script>

<table width="98%" border="0" cellspacing="0" cellpading="0" class="table1">
<tr><td>
			<table width="100%" border="0" cellspacing="0" cellpading="0">
				<tr>
                    
<?PHP
for($i=1;$i<=$canti_tab;$i++){
?>
<th id="tab<?PHP echo $i; ?>" class="activetab" onClick="javascript:tab.display(<?PHP echo $i; ?>);"><a href="#" tabindex="0" accesskey="<?PHP echo $i; ?>" onFocus="tab.display(<?PHP echo $i; ?>);" onClick="tab.display(<?PHP echo $i; ?>); return(false);">&nbsp; <?PHP echo $nom_pestana[$i]; ?> &nbsp;</a></th>

<?PHP
}
?>
				</tr>
			</table>
<?PHP
}
//-------------------------------------------------------------------------------------------------
function pestana_tab_inicio($numtab,$descrip_tab){
?>
<div id="tabcontent<?PHP echo $numtab; ?>" class="inactivetab">

     <table  border="0" width="100%" cellspacing="0" class="tabcontent_cabeza">
        <tr>
            <td class="th"><b><?PHP echo $descrip_tab; ?></b></td>
        </tr>
     </table>
<table width="100%" border="0" align="left" cellpadding="1" cellspacing="0" class="tabcontent">
    <tr class="row_off">
		<td >	
<?PHP
}
//-------------------------------------------------------------------------------------------------
function pestana_tab_fin(){
?>	
</td>
	</tr>
</table>		 
</div>
<?PHP
}
//--------------------------------------------------------------------------------------------------
function encabezado_fin(){

?>	
</td></tr>
</table>
<?PHP
	echo "</body>";
  
}
?>