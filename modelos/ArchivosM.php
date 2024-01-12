<?PHP
class Archivos extends Conexion
{	
	private $sql;

    public function consultar($tipo='ASSOC_NUM')
    {
        return parent::consultaSQL($this->sql,$tipo);
    }

    public function EjecutarSql($transaccion, $DML=NULL) 
    { //ejecutar con transaccion
        $this->DML = $DML;
        return parent::ejecutar($this->sql, $transaccion);
    }		
	

    //******************************************************************************
    //*******ESTA FUNCION PROCESA LOS EVENTOS PARA LOS ARCHIVOS SUBIDOS AL SERVIDOR*
    //******************************************************************************

    function ProcesarCargue_Files($TipoFile,$TamañoFile,$NombreFile,$Tmp_NombreFile,$Nombre_Municipio)
    {
        $Nombre_Archivo = $NombreFile;

        if($TamañoFile < 2000000)
        {
            if(($TipoFile == "text/plain") or ($TipoFile == "application/pdf") or ($TipoFile == "application/octet-stream") or ($TipoFile == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") or ($TipoFile == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))
            {
                if(is_uploaded_file($Tmp_NombreFile))
                {
                    $Path_Documentos_Guardados = "../Files_Medios_Verific_Mpios/$Nombre_Municipio/$Nombre_Archivo";

                    if(move_uploaded_file($Tmp_NombreFile,$Path_Documentos_Guardados)) 
                    {
                            $Respuesta=1;//Retorna 1 - El Archivo se ha enviado con exito...!
                    }
                }
                else
                {
                            $Respuesta=2;//Retorna 2 - Error!!! El archivo no pudo ser enviado...!
                }
            }
            else
            {
                            $Respuesta=3;//Retorna 3 cuando el Tipo de Archivo NO es el permitido
            }

         }
         else
         {
                            $Respuesta=4;//Retorna 4 cuando es tamaño del archivo NO es el permitido
         }
    

         return $Respuesta;
    }        

//------------------------------------------------------------------------------------------------------------------------------	
    
    //******************************************************************************
    //*******ESTA FUNCION PROCESA LOS EVENTOS PARA LOS ARCHIVOS SUBIDOS AL SERVIDOR*
    //******************************************************************************

    function ProcesarCargue_Municipio($Usuario)        
    {
  //****************************************
        
    $this->sql="SELECT NombreMunicipio from fun_consultar_Municipio($Usuario)";

    $rs=$this->consultar('ASSOC');
    return $rs;        
    }        
  //------------------------------------------------------------------------------------------------------------------------------	
    
}//fin clase
