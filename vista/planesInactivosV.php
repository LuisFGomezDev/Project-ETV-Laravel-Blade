<?PHP

if($rsInactivos->RecordCount()>0){
    
    echo start_table(array("class"=>"table table-hover"));


    echo table_row_th(            
            table_cell("Nombre del Plan"),
            table_cell_th("PRICE PLAN /SOC"),
            table_cell("RENTA MENSUAL"),
            table_cell_th("RENTA CON IMPUESTOS"),
            table_cell(""),
            table_cell_th(""),
            table_cell("FAVORITOS VOZ"),
            table_cell_th("FAVORITOS TEXTO")            
            );

     echo "<tbody>";
    
    while(!$rsInactivos->EOF)
    {        
        $renImpuestos=($rsInactivos->fields['rentaMensual']*$rsInactivos->fields['impuesto'])+$rsInactivos->fields['rentaMensual'];        
        
        $idPlan=$rsInactivos->fields['idplan'];
        
        echo table_row(
            table_cell("<A href=\"javaScript: void(0);\" onclick=\"cargarForm('./controlador/actualizarPlanC.php?idPlan=$idPlan')\">".$rsInactivos->fields['nombrePlan']."</A>"),
            table_cell($rsInactivos->fields['codigoPlan']),
            table_cell($rsInactivos->fields['rentaMensual'],array("align"=>"right")),
            table_cell($renImpuestos,array("align"=>"right")),
            table_cell("",array("align"=>"right")),
            table_cell("",array("align"=>"right")),
            table_cell($rsInactivos->fields['favoritosVoz'],array("align"=>"center")),
            table_cell($rsInactivos->fields['favoritosTexto'],array("align"=>"center"))                    
            );                
        
        $rsInactivos->MoveNext();
        
    }
     echo "</tbody>";
    echo end_table();
    
}
else
    echo mensaje_respuesta(array("No hay planes Inactivos"), "error");
?>