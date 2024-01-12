<?PHP
class Ofertas extends Conexion{
	

	private $sql;

	public function consultar($tipo='ASSOC_NUM'){
        return parent::consultaSQL($this->sql,$tipo);
    }
	
    public function EjecutarSql($transaccion, $DML=NULL) { //ejecutar con transaccion
        $this->DML = $DML;
        return parent::ejecutar($this->sql, $transaccion);
    }	

    
    
      
 }	
?>