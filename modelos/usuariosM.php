 <?PHP

class usuarios extends Conexion{
	

	private $sql;

	public function consultar($tipo='ASSOC_NUM'){
        return parent::consultaSQL($this->sql,$tipo);
    }
    public function EjecutarSql($transaccion, $DML=NULL) { //ejecutar con transaccion
        $this->DML = $DML;
        return parent::ejecutar($this->sql, $transaccion);
    }	
 
/***************************************************************************
 Muestra todos los planes que se encuentran vigentes
****************************************************************************/
 function datosGestor($login){
	
	
	//$this->con->debug = true;
	
  	$this->sql="SELECT idAgente,nombreAsesor,perfil,pasw FROM fun_identificarAsesor('$login')";
	
  	$rs=$this->consultar('ASSOC');

   /*
        while($row=$rs->FetchRow()){
          $row['USU_NOMBRE']=utf8_decode($row['USU_NOMBRE']);
	  $resultado=$row;
   }
    */
	return $rs;
 }	
//------------------------------------------------------------------------ 
function existeGestor($documento){
	
	
	$documento=trim($documento);
	
  	$this->sql="select count(0) as existe from USUARIOS where ltrim(rtrim(USU_DOCUMENTO))='".$documento."'";	
  	$rs=$this->consultar('NUM');

	return $rs->fields[0];
  
 }	
function existeGestorDif($documento,$idgestor){
	
	
	$documento=trim($documento);
	
  	$this->sql="select count(0) as existe from USUARIOS where ltrim(rtrim(USU_DOCUMENTO))='".$documento."' AND USU_IDAGENTE!=$idgestor";	
  	$rs=$this->consultar('NUM');

	return $rs->fields[0];
  
 }	 
//------------------------------------------------------------------------ 
function existeLoginDif($login,$idgestor){
	
	
	$login=trim($login);	
  	$this->sql="select count(0) as existe from USUARIOS where ltrim(rtrim(USU_LOGIN))='".$login."' AND USU_IDAGENTE!=$idgestor";
  	$rs=$this->consultar('NUM');
	return $rs->fields[0];
  
 }	
//------------------------------------------------------------------------ 
function existeLogin($login){
	
	
	$login=trim($login);	
  	$this->sql="select count(0) as existe from USUARIOS where ltrim(rtrim(USU_LOGIN))='".$login."'";
  	$rs=$this->consultar('NUM');
	return $rs->fields[0];
  
 }	
//------------------------------------------------------------------------
function crear_usuario($documento,$nombre,$clave,$login,$perfil)
{
        $estado='1';
	$documento=trim($documento);
	$nombre=strtoupper($nombre);
	$login=trim($login);
	
  	$this->sql=" EXEC P_Crear_Usuarios '$documento','$nombre','$estado','$clave','$login','$perfil'";
     
        $rs=$this->consultar('NUM');					
  	//$this->EjecutarSql(NULL,"I");
}
 //-----------------------------------------------------------------------
function listado_agentes()
{
	
    $resultado=array();
	
	//Buscamos el siguiente numero de venta. DEPENDIENDO EL PRODUCTO
  	$this->sql="SELECT US.USU_LOGIN AS login,
                            US.USU_IDAGENTE as idagente,
                            US.USU_DOCUMENTO as documento,
                            US.USU_NOMBRE as nombreAsesor,
                            US.CAU_CODCARGO as perfil,
                            US.USU_ESTADO as estado,
                            CAU_NOMBRE as nombreCargo
                            
					FROM USUARIOS US
						 INNER JOIN CARGOSUSUARIO ON(US.CAU_CODCARGO=CARGOSUSUARIO.CAU_CODCARGO)
                                                 WHERE USU_IDAGENTE!=0
					ORDER BY USU_NOMBRE
                                        ";
	
  	$rs=$this->consultar('ASSOC');
   
   while($row=$rs->FetchRow()){       
      $row['USU_NOMBRE']=utf8_decode($row['USU_NOMBRE']);
      $resultado[]=$row;              
   }
	return $resultado; 
	 
}
//------------------------------------------------------------------------

//-----------------------------------------------------------------------
function datosGestorId($idagente){
	
    $resultado=array();
	
	//Buscamos el siguiente numero de venta. DEPENDIENDO EL PRODUCTO
  	$this->sql="SELECT "
                . "USU_LOGIN login,"
                . "USU_DOCUMENTO documento,"
                . "USU_NOMBRE nombre,"
                . "CAU_CODCARGO perfil,"
                . "USU_ESTADO estado,USU_PASSWD clave "
                . "FROM USUARIOS WHERE USU_IDAGENTE=$idagente";
	
  	$rs=$this->consultar('ASSOC');

    while($row=$rs->FetchRow()){
         $row['nombre']=utf8_decode($row['nombre']);
         $row['USU_NOMBRE']=utf8_decode($row['USU_NOMBRE']);
	 $resultado=$row;
    }
	return $resultado;
	 
}
//------------------------------------------------------------------------

function OperacionReinicializarUser($idAgente)
//function actualizarAgente($idAgente,$login,$documento,$nombre,$clave,$perfil,$estado){
{
	$clave='12345';
	/*$documento=trim($documento);
	$nombre=strtoupper($nombre);
	$login=trim($login);*/
	
  	$this->sql="
				UPDATE USUARIOS
                                    SET USU_PASSWD = '".$clave."'
				 WHERE USU_IDAGENTE=$idAgente
				";
		   
	
  	$this->EjecutarSql(NULL,"U");
}



//------------------------------------------------------------------------
function actualizarAgente($idAgente,$login,$documento,$nombre,$clave,$perfil,$estado)
{
    if($estado=='E')
    {
        $this->sql="EXEC P_Eliminar_Usuario '$login'";
        $rs=$this->consultar('NUM');     
    }
     else 
    {
        $documento=trim($documento);
	$nombre=strtoupper($nombre);
	$login=trim($login);
	
  	$this->sql="
				UPDATE USUARIOS
				   SET USU_LOGIN = '".$login."'
					  ,USU_DOCUMENTO = '".$documento."'
					  ,USU_NOMBRE = '".utf8_encode($nombre)."'
					  ,USU_ESTADO = '".$estado."'
					  ,USU_PASSWD = '".$clave."'
					  ,CAU_CODCARGO = '".$perfil."'
				 WHERE USU_IDAGENTE=$idAgente
				";
     }
  	$this->EjecutarSql(NULL,"U");
}//FIN FUNCTION Actualizar Agente

//*********************************************************************************

function deptAsignados($agente)
{
         
         $resultado=array();   
            
  	 $this->sql="SELECT DEP_CODDEPT,DEP_NOMBRE FROM DEPARTAMENASIGNADOS 
                            INNER JOIN DEPARTAMENTOS ON(DEP_CODDEPT=DPA_CODDEPT)
                        WHERE DPA_IDAGENTE=$agente order by DEP_NOMBRE";
	 	 
         $rs=$this->consultar('ASSOC');          
          
            while($row=$rs->FetchRow()){
                $resultado[]=$row;
            }
            
            return $resultado;
}
        //crea un nuevo barrio para el municipio
function asigarDepartamento($agente,$codDept){
    //$this->con->debug = true;
    $this->sql="EXEC P_departamentoAsignar_Insertar $agente,$codDept";              
    $this->EjecutarSql(NULL,"I");

}        
        //crea un nuevo barrio para el municipio
function quitarDepartamento($agente,$codDept){
    //$this->con->debug = true;
    $this->sql="DELETE FROM DEPARTAMENASIGNADOS WHERE DPA_IDAGENTE=$agente AND DPA_CODDEPT=$codDept";              
    $this->EjecutarSql(NULL,"I");

}   

function resumenVerificadores(){
               
   $this->sql="SELECT idVerificador,Verificador,cantidad FROM func_resumenVerificadores() order by Verificador";
	 	 
   $rs=$this->consultar('ASSOC');          

   return $rs;    
    
}
function resumenActivadores(){
               
   $this->sql="SELECT idActivador,Activador,cantidad FROM func_resumenActivadores() order by Activador";
	 	 
   $rs=$this->consultar('ASSOC');          

   return $rs;    
    
}
function verificacionesPendientes(){
               
   $this->sql="select dbo.func_verificacionesPendientes()";
	 	 
   $rs=$this->consultar('NUM');          

   return $rs->fields[0];
    
}
function activacionesPendientes(){
               
   $this->sql="select dbo.func_activacionesPendientes()";
	 	 
   $rs=$this->consultar('NUM');          

   return $rs->fields[0];
    
}
function verificacionesPorReasignar(){
               
   $this->sql="select idGestion from func_verificacionesPorReasignar() order by idGestion desc";
	 	 
   $rs=$this->consultar('NUM');          

   return $rs;
    
}
function activacionesPorReasignar(){
               
   $this->sql="select idGestion from func_activacionesPorReasignar() order by idGestion desc";
	 	 
   $rs=$this->consultar('NUM');          

   return $rs;
    
}
function volverAsignar($agente,$gestiones){
               
   $this->sql="UPDATE GESTIONVERIFICACION SET USU_IDAGENTE=$agente WHERE GES_IDGESTION IN($gestiones)";
	 	 
   $this->EjecutarSql(NULL,"U");             
}
function volverAsignarActivacion($agente,$gestiones){
               
   $this->sql="UPDATE GESTIONACTIVACION SET USU_IDAGENTE=$agente WHERE GES_IDGESTION IN($gestiones)";
	 	 
   $this->EjecutarSql(NULL,"U");             
}

function solicitarVentaPorActivar($agente)
{
   $this->sql="EXEC P_activacionAsignacion $agente";
   //echo $this->sql;
   $rs=$this->consultar('NUM');     
   
   return $rs->fields[0];
   
}
function solicitarVentaFacturacionRealizar($agente)
{
   $this->sql="EXEC P_activacionFacturacionAsignacion $agente";
   //echo $this->sql;
   $rs=$this->consultar('NUM');     
   
   return $rs->fields[0];
   
}
function liberarActivacionesUsuario($activador)
{
   $this->sql="UPDATE GESTIONACTIVACION SET USU_IDAGENTE=0 WHERE USU_IDAGENTE=$activador";	 	 
   $this->EjecutarSql(NULL,"U");  
}
 //-----------------------------------------------------------------------
}
?>