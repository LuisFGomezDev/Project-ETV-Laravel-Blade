<?PHP
class Menu extends Conexion
{
	

	private $sql;

	public function consultar($tipo='ASSOC_NUM'){
        return parent::consultaSQL($this->sql,$tipo);
    }
    public function EjecutarSql($transaccion, $DML=NULL) { //ejecutar con transaccion
        $this->DML = $DML;
        return parent::ejecutar($this->sql, $transaccion);
    }	

//---------------------------------------------------------------------------
function menuAdmin($Grupo_Menu)
{

 $resultado=array();	

  //$this->con->debug=true; 
  $this->sql="SELECT 
      
		idPadre,
		padreOrden,
		nomPadre,		
		linkPadre,	
		clasPadre,

		hijoNombre,
		hijoLink,	
		hijoClas,
		hijosPadre,
		hijosOrden	

                FROM fun_administrador($Grupo_Menu)
            
                ORDER BY padreOrden,hijosPadre,hijosOrden
                ";
  
  $rs=$this->consultar('ASSOC');

   while($row=$rs->FetchRow()){                     
		$resultado[]=$row;		
   }	
   
	return $resultado;
		
}
//-----------------------------------------------------------------------------
function menuUsuario($codCargo,$Grupo_Menu)
{

 $resultado=array();	

  //$this->con->debug=true; 
  $this->sql="SELECT 
      
		idPadre,
		padreOrden,
		nomPadre,		
		linkPadre,	
		clasPadre,

		hijoNombre,
		hijoLink,	
		hijoClas,
		hijosPadre,
		hijosOrden	

                FROM fun_menuUsuario('$codCargo',$Grupo_Menu)
            
                ORDER BY padreOrden,hijosPadre,hijosOrden
                ";
  
   $rs=$this->consultar('ASSOC');

   while($row=$rs->FetchRow())
   {                     
        $resultado[]=$row;		
   }	
	return $resultado;
}
//---------------------------------------------------------------------------
}//Fin de la clase MENU
?>