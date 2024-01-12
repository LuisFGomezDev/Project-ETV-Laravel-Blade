<?PHP
abstract class  Conexion 
{//INICIO CLASE Conexion

    var $con = null;
    var $DML; 		//Determina el tipo de sentencia a validar.
    var $_error; 	//almacena el ultimo error.


    //------------------------------------------------------------------------------------------------------
    //Conexion a la Base de datos Postgres
    //----------------------------------------------------------------------------------------------------------

    public function __construct() 
    {
	//include_once '../inc/adodb5/adodb.inc.php';
        //include_once "D:/www/Aplicacion_San_Vicente_SVF/inc/adodb5/adodb.inc.php";

	//Conexion Local
	if($GLOBALS['db']==null){		
		
	
        //$SqlServer="192.168.130.28";
        $SqlServer="3I_CC_DELL\SQLEXPRESS";
		$SqlServerDbname="DBUno27_SVF";
		$SqlServerUser="UsrUno27_SVF";//Nombre de usuario
		$SqlServerPassword="UsrUno27_SVF123";//Clave de usuario
		//$driver_db="mssql";
		$driver_db="mssqlnative";
		
		$GLOBALS['db'] = ADONewConnection($driver_db);
		$GLOBALS['db']->Connect("$SqlServer", $SqlServerUser, $SqlServerPassword, "$SqlServerDbname");	              
			
	 }
			  
	   $this->con=$GLOBALS['db'];

    }//Fin constructor

    /**
     * Captura el mensaje del error generado en la base de datos, para ser tratado dentro del sistema.
     *
     * @return		Integer Tipo de Error.
     */
    public function Error() 
    {
        $ADOMsg = $this->con->ErrorMsg();
        return $this->ArrayErrores($ADOMsg);
    }

    /**
     * Este metodo permite procesar los errores que son entregados desde la librerï¿½a ADODB para manejar la
     * excepciï¿½n dentro del sistema.
     *
     * @param		String $errMsg
     * @return		Integer Tipo de error.
     */
    private function ArrayErrores($errMsg) 
    {
        $arrayErrors = array(
            0 => " ",
            1 => "violation of PRIMARY or UNIQUE KEY constraint", //Duplicidad de registro con llave igual.
            2 => "violation of FOREIGN KEY constraint", //Eliminaciï¿½n de registro.
            3 => "EOF in string detected", //Campo vacï¿½o
        );

        $errorCount = $errorFinded = 0;
        if (is_null($errMsg) || empty($errMsg))
            return $errorFinded;
        while ($errorCount < count($arrayErrors)) {
            
            if(strlen($arrayErrors[$errorCount])<$errMsg)
            if (substr_compare($errMsg, $arrayErrors[$errorCount], 0, strlen($arrayErrors[$errorCount])) == 0) {
                $errorFinded = $errorCount;
            }
            $errorCount++;
        }
        return $errorFinded;
    }

    /**
     * @todo Mï¿½todo para Ejecutar comando SQL
     * @param string $sql - Sentencia SQL a ejecutar
     * @param string $transaccion - {[COMMIT, ROLLBACK, STARTRANSACCION]}
     * @return boolean 
     */
    public function ejecutar($sql, $transaccion) 
    {
        try {
			
            $rs = $this->con->Execute($sql);
            $this->_error = $this->Error();
			
			
            switch ($this->DML) {
                case "i": case "I": //INSERT
                    switch ($this->_error) {
                        case 1:
                            echo "<script> alert(\"Los datos no pueden ser ingresados\"); </script>";
                            break;
                        case 3:
                            echo "<script> alert(\"No debe ingresar caracteres invalidos.\"); </script>";
                            break;
                    }
                    break;
                case "u": case "U": //UPDATE
                    switch ($this->_error) {
                        case 1:
                            echo "<script> alert(\"El registro no puede ser actualizado.\"); </script>";
                            break;
                    }
                    break;
                case "d": case "D": //DELETE
                    switch ($this->_error) {
                        case 2:
                            echo "<script> alert(\"El registro no puede ser eliminado.\"); </script>";
                            break;
                    }
                    break;
            }

            /* echo "<pre>";
              print_r($rs);
              echo "</pre>"; */

            if (!$rs) {
                $this->ejecutarTransaccion(ROLLBACK);
                return false;
            } else {
                $this->ejecutarTransaccion($transaccion);
                return true;
            }
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return false;
        }
    }

    /**
     * @todo Mï¿½todo para ejecutar el tipo de transacciÃ³n enviado
     * @param string $transaccion - Tipo de transacciÃ³n a ejecutar {[COMMIT, ROLLBACK, STARTRANSACCION]}
     */
    public function ejecutarTransaccion($transaccion) 
    {
        switch ($transaccion) {
            case COMMIT: $this->con->CommitTrans();
                $this->ejecutarTransaccion(STARTRANSACCION);
                break;
            case ROLLBACK: $this->con->RollbackTrans();
                $this->ejecutarTransaccion(STARTRANSACCION);
                break;
            case STARTRANSACCION: $this->con->BeginTrans();
                break;
            // Deberï¿½a ir un default ??
        }
    }

    
    public function __destruct() 
    {
        $this->con;       
    }

//Si no pasa parametro, se estaria ejecutando con la ultima asiciacion
    public function consultaSQL($sql,$tipo_asocicion)
    {
        try {
			
			switch ($tipo_asocicion){
			 case 'ASSOC': 	$this->con->SetFetchMode(ADODB_FETCH_ASSOC); break;
 			 case 'NUM': 	$this->con->SetFetchMode(ADODB_FETCH_NUM); break;
			 // default: 		$this->con->SetFetchMode(ADODB_FETCH_ASSOC);				
			}
			
            $rs = $this->con->Execute($sql);
            $this->_error = $this->Error();
                  
				  	switch ($this->_error) {
                        case 1:
                            echo "<script> alert(\"No se pudo realizar la consulta\"); </script>";
                            break;
                        case 3:
                            echo "<script> alert(\"No debe ingresar caracteres invalidos.\"); </script>";
                            break;
                    }
                  
 			return $rs;

            } catch (Exception $e) {
                $this->_error = $e->getMessage();
                            echo $this->_error;
                return false;
            }
	}//fin funcion

        
    function controlErrores1($Sql) 
    {
        $archivo = @fopen('../pruebas/sebas3.txt', "a+");
        $str = "PRUEBA\n";
        $str = "$Sql";
        $str.="\n"; //SOLO PARA VERIFICAR QUE LLEGA
        fwrite($archivo, $str);
        fclose($archivo);
    }
}//FIN CLASE Conexion
?>