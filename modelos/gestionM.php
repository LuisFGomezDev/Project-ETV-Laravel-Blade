<?PHP
//class Gestion extends Conexion{	
class Gestion extends Conexion{	
	private $sql;

	public function consultar($tipo='ASSOC_NUM'){
        return parent::consultaSQL($this->sql,$tipo);
    }
    public function EjecutarSql($transaccion, $DML=NULL) { //ejecutar con transaccion
        $this->DML = $DML;
        return parent::ejecutar($this->sql, $transaccion);
    }		
	
    /***********************************************************************
        Crea una gestion y retorna el consecutivo de autoincremento. 
    ************************************************************************/
    function crear_gestion($telefono,$agente,$vdn,$tipoLlamada,$idcliente)
    {
        
      $this->sql="EXEC P_GESTION_Insertar '$telefono',$agente,'$vdn','$tipoLlamada','$idcliente'";
     
      $rs=$this->consultar('NUM');					
						
      return $rs->fields[0];//Devuelve el ultimo consecutivo ingresado.
     							
    }    
    
    function ventasTramiteCliente($idcliente)
    {
        
      $this->sql="SELECT dbo.func_ventasTramite($idcliente)";
     
      $rs=$this->consultar('NUM');					
						
      return $rs->fields[0];
     							
    }    
        
        
//***********************************************************************
//        ZONA PARA LA CREACION DE FUNCIONES DE LA TERRITORIAL
//************************************************************************
//***********************************************************************
//************************************************************************

//************************************************************************
    
    function ProcesarCapturaNovedades_Archivos_ModConocimiento($usuarioID,$ResultadoElegido,$IndicadorElegido,$MedioVerific,$Supuesto,$Actividad_Elegida,$ActividadIndicador1,$ActividadIndicador2,$ActividadIndicador3,$ActividadIndicador4,$ActividadIndicador5,$Medio_ActividadIndicador1,$Medio_ActividadIndicador2,$Medio_ActividadIndicador3,$Medio_ActividadIndicador4,$Medio_ActividadIndicador5,$ActividadSupuesto,$Observaciones,$Path_Documentos_Guardados,$Nombre_Documento_Act_i1,$Nombre_Documento_Act_i2,$Nombre_Documento_Act_i3,$Nombre_Documento_Act_i4,$Nombre_Documento_Act_i5,$NombreModulo_ETV)
    {   /*
        echo mensaje_respuesta(array("RESULTADO ESPERADO:"),'error'),$ResultadoElegido; 
        echo mensaje_respuesta(array("INDICADOR ELEGIDO:"),'error'),$IndicadorElegido; 
        echo mensaje_respuesta(array("ACTIVIDAD ELEGIDA:"),'error'),$Actividad_Elegida; 
     * 
     */
          //****************************************
          $this->sql=" EXEC P_GESTION_Insertar_Novedades_Conocimiento $usuarioID,'$ResultadoElegido','$IndicadorElegido','$MedioVerific','$Supuesto','$Actividad_Elegida','$ActividadIndicador1','$ActividadIndicador2','$ActividadIndicador3','$ActividadIndicador4','$Medio_ActividadIndicador1','$Medio_ActividadIndicador2','$Medio_ActividadIndicador3','$Medio_ActividadIndicador4','$ActividadSupuesto','$Observaciones','$Path_Documentos_Guardados','$Nombre_Documento_Act_i1','$Nombre_Documento_Act_i2','$Nombre_Documento_Act_i3','$Nombre_Documento_Act_i4','$NombreModulo_ETV'";
          $this->EjecutarSql(NULL, "U");
    }        

    
//************************************************************************
    
    function ProcesarCapturaNovedades_Archivos($usuarioID,$ResultadoElegido,$IndicadorElegido,$MedioVerific,$Supuesto,$Actividad_Elegida,$ActividadIndicador1,$ActividadIndicador2,$ActividadIndicador3,$ActividadIndicador4,$Medio_ActividadIndicador1,$Medio_ActividadIndicador2,$Medio_ActividadIndicador3,$Medio_ActividadIndicador4,$ActividadSupuesto,$Observaciones,$Path_Documentos_Guardados,$Nombre_Documento_Act_i1,$Nombre_Documento_Act_i2,$Nombre_Documento_Act_i3,$Nombre_Documento_Act_i4,$NombreModulo_ETV)
    {   /*
        echo mensaje_respuesta(array("RESULTADO ESPERADO:"),'error'),$ResultadoElegido; 
        echo mensaje_respuesta(array("INDICADOR ELEGIDO:"),'error'),$IndicadorElegido; 
        echo mensaje_respuesta(array("ACTIVIDAD ELEGIDA:"),'error'),$Actividad_Elegida; 
     * 
     */
          //****************************************
          $this->sql=" EXEC P_GESTION_Insertar_Novedades_Atencion $usuarioID,'$ResultadoElegido','$IndicadorElegido','$MedioVerific','$Supuesto','$Actividad_Elegida','$ActividadIndicador1','$ActividadIndicador2','$ActividadIndicador3','$ActividadIndicador4','$Medio_ActividadIndicador1','$Medio_ActividadIndicador2','$Medio_ActividadIndicador3','$Medio_ActividadIndicador4','$ActividadSupuesto','$Observaciones','$Path_Documentos_Guardados','$Nombre_Documento_Act_i1','$Nombre_Documento_Act_i2','$Nombre_Documento_Act_i3','$Nombre_Documento_Act_i4','$NombreModulo_ETV'";
          $this->EjecutarSql(NULL, "U");
    }        

    
/************************************************************************/

    
/***********************************************************************
        GENERA UN REPORTE DE NOVEDADES EN EXCEL XLSX  -  APLIC ETV
************************************************************************/
function Procesar_Reportes_Excel_ETV_ATENCION($FechaInicial,$FechaFinal,$TipoInforme,$Municipio,$Modulo)
{ 
  //****************************************
  //VALIDACION CAMPO MODULO
  //****************************************

      if($Modulo == 'A')
      {
         $Modulo='Atencion';
      }
      else
           
      if($Modulo == 'P')
      {
         $Modulo='Prevencion';
      }
      else

      if($Modulo == 'R')
      {
         $Modulo='Promocion';
      }
      else
           
      if($Modulo == 'K')
      {
         $Modulo='Contingencia';
      }
      else
           
      if($Modulo == 'I')
      {
         $Modulo='Inteligencia';
      }
       else
      {
         $Modulo='Conocimiento';
      }
      //****************************************

     $fecha1=str_replace("/","-",$FechaInicial)." 00:00:00";
     $fecha2=str_replace("/","-",$FechaFinal)." 23:59:59";  
    
     $nuevafecha2 = date('Y-m-d', strtotime("$fecha2 + 1 day"));
     $fecha2 = $nuevafecha2." 23:59:59";
    
/*  $fechaInicial=str_replace("/","-",$FechaInicial)."";
    $fechaFinal=str_replace("/","-",$FechaFinal)."";  
    
    $date1 = new DateTime($FechaInicial);
    $date2 = new DateTime($FechaFinal);
    $fechaInicial=$date1->format('Y-m-d');
    $fechaFinal=$date2->format('Y-m-d'); 

        echo mensaje_respuesta(array("FECHA1:"),'error'),$fecha1; 
        echo mensaje_respuesta(array("FECHA2:"),'error'),$fecha2; 
        echo mensaje_respuesta(array("NUEVA FECHA2:"),'error'),$nuevafecha2; 
       echo mensaje_respuesta(array("TIPO INFORME:"),'error'),$TipoInforme; 
        echo mensaje_respuesta(array("MUNICIPIO:"),'error'),$Municipio; 
        echo mensaje_respuesta(array("MODULO:"),'error'),$Modulo; 
  */      


   if($TipoInforme=='F')
   {
   $this->sql=" SELECT 
                Fecha_Novedad,
                Res_Esperado,
                Res_Indicador,
                Res_Medio,
                Res_Supuesto,
                Actividad,
                Act_Indicador,
                Act_Medio,
                Act_Supuesto,
                Observaciones,
                Ruta_Documento,
                Nombre_Documento,
                Municipio,
                Nombre_Usuario
          
           FROM fun_reporteNovedades_Atencion_Fecha('$fecha1','$fecha2','$Modulo')";
    }
    else
    if($TipoInforme=='M')
    {
       $this->sql=" SELECT 
                Municipio,
                Fecha_Novedad,
                Res_Esperado,
                Res_Indicador,
                Res_Medio,
                Res_Supuesto,
                Actividad,
                Act_Indicador,
                Act_Medio,
                Act_Supuesto,
                Observaciones,
                Ruta_Documento,
                Nombre_Documento,
                Nombre_Usuario
          
           FROM fun_reporteNovedades_Atencion_Municipio('$fecha1','$fecha2','$Municipio','$Modulo')";
    }
       
  $rs=$this->consultar('ASSOC');
  return $rs;
}//FIN FUNCION Procesar_Reportes_Excel_Mamografias

//------------------------------------------------------------------------------------------------------------------------------	
}//fin clase