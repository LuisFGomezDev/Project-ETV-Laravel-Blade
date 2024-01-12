<?PHP
/*
Genera de la Sabana
*/
$agentes_clas=new usuarios();
$bandera=true;//no es modificacion


if($_GET['idagente']>0 || $_POST['idagente']>0){

	$bandera=false;//No muestra lista de agentes
	
	if(empty($_POST['idagente'])){
	 $datos=$agentes_clas->datosGestorId($_GET['idagente']);
	 $datos['clave2']=$datos['clave'];
	}


	if($_POST['operation'][1]==1){
		
		
		$gestor=new usuarios();
		$error=array();
		
	
		if(empty($_POST['login']))$error[]="El login es obligatorio";
		 else
		if($gestor->existeLoginDif($_POST['login'],$_POST['idagente'])!=0)
		 $error[]="El login ingresado ya lo tiene otro usuario";
			
		if(empty($_POST['documento']))$error[]="El n&uacute;mero de documento es obligatorio";
		 else
		if($gestor->existeGestorDif($_POST['documento'],$_POST['idagente'])!=0)
		 $error[]="El documento ingresado ya existe";
		 
		if(empty($_POST['nombre']))$error[]="El nombre es obligatorio";
		if(empty($_POST['clave']))
		 $error[]="La clave es obligatoria";
		else
		 if($_POST['clave']!=$_POST['clave2'])
		  $error[]="La clave inicial no es igual a la clave de confirmaci&oacute;n";
		
		if(empty($_POST['perfil']) || $_POST['perfil']=="0")$error[]="Debe de seleccionar el perfil";
			
			if(count($error)>0){
			 echo mensaje_respuesta($error,'error');
			 $datos=$_POST;	
			}
			else
			 {
                                $gestor->actualizarAgente($_POST['idagente'],$_POST['login'],$_POST['documento'],$_POST['nombre'],$_POST['clave'],$_POST['perfil'],$_POST['estado']);			
                                
                                if($_POST['estado']=='E')
                                {
                                    echo mensaje_respuesta(array("El Usuario ha sido Eliminado del Sistema !!!"),'conf');
                                }
                                else
                                {
                                    echo mensaje_respuesta(array("El agente fue actualizado"),'conf');
                                }
				$bandera=true;
			 }
	}	

	if($bandera===false){

	echo start_form($_SERVER['PHP_SELF']."?p=$_GET[p]&carp=$_GET[carp]",array("name"=>"datos"));
	echo hidden_field("operation","01000000000");	
	echo hidden_field("idagente",$_GET['idagente'].$_POST['idagente']);
	
	$nombre_form="Actualizar datos agente";
	$boton_form="Actualizar";
        $no_actualizar="RO";
	include "./vista/formato_agenteV.php";
	echo end_form();
	 
	}
}

if($bandera===true)
{
$rs_agentes=$agentes_clas->listado_agentes();

if(count($rs_agentes)>0)
{
?>

<!-- INICIO CONTENEDOR CUERPO CENTRAL -->
      <div class="EstiloDivContenedorCuerpoCentral_Form">
          <div class="LabelTituloFormulario"> 
                    <label for="LabelTituloFormulario">LISTADO DE AGENTES</label>
          </div>

           <div>
               <div class="Estilo_Div_Tabla"> 
                   <?PHP
                        echo start_table(array("width"=>"98%","class"=>"Estilo_Tabla"));

                        echo table_row_th(table_cell_th("",array("colspan"=>"6")));
	
                        echo table_row_th(
                                                   table_cell_th("Login",array("class"=>"Estilo_th_Tit")),
						   table_cell_th("#Documento",array("class"=>"Estilo_th_Tit")),
						   table_cell_th("Nombre Agente",array("class"=>"Estilo_th_Tit")),
						   table_cell_th("Perfil",array("class"=>"Estilo_th_Tit")),
						   table_cell_th("Estado",array("class"=>"Estilo_th_Tit"))							  
						   );

                        $k='specalt';
                        $k1='alt';
									   	

			while(list($key,$datos)=each($rs_agentes))
			{
			  ($k=='specalt')?$k="spec":$k='specalt';
			  ($k1=='alt')?$k1="":$k1='alt';				
			
			  $perfil=$datos['perfil'];
			  ($datos['estado']=='1')?$estado="Activo":$estado="Inactivo";
			  	
			  echo table_row(
			  			table_cell("<A href=\"$_SERVER[PHP_SELF]?idagente=$datos[idagente]&p=$_GET[p]&carp=$_GET[carp]\">".$datos['login']."</A>",array("class"=>"Estilo_th")),
						table_cell($datos['documento'],array("class"=>"Estilo_th")),
			  			table_cell($datos['nombreAsesor'],array("class"=>"Estilo_th")),
						table_cell($perfil,array("class"=>"Estilo_th")),
						table_cell($estado,array("class"=>"Estilo_th"))												 
			  );		
			}				
	
                          echo end_table();
            ?>
               </div>
         </div>
      </div>

<?PHP
}
else
 echo mensaje_respuesta(array("No se encontraron agentes"),'error');
 
}//fin si es listar agente
 
include "./inc/fin_pagina.php";
?>