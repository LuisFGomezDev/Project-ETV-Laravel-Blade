  $(document.datos).ready(function ()
        {			
		
            $("#btnShowSimple").click(function (e)
            {				
                ShowDialog(false);
                e.preventDefault();
            });
 
            $("#btnShowModal").click(function (e)
            {
				if($("#plan").val()!=0){
				
				 $("#dialog").load("./controlador/acomodacionesC.php?idplan="+document.datos.plan.value);
                 ShowDialog(true);
                 e.preventDefault();
				}
				 else
				 alert("Atencion: Debe de seleccionar primero el plan");
				
            });
 
 
 
            $("#btnClose").click(function (e)
            {				
		$("#dialog").html("?");
                HideDialog();
                e.preventDefault();
            });
 
            $("#btnSubmit").click(function (e)
            {
                //var brand = $("#brands input:radio:checked").val();
				 brand="Lo felicito"; //Procesna la informacion
                $("#output").html("<b>Your favorite mobile brand: </b>" + brand);
                HideDialog();
                e.preventDefault();
            });
        });
 
 
	function cargarForm(url)
        {				
				
		 $("#dialog").load(url);
                 ShowDialog(true);
                 //e.preventDefault();
				          
        }

		function cargarFormTipo2(IdrangoTemporada,codHospedaje)
        {
				if($("#plan").val()!=0){
				
				 $("#dialog").load("./controlador/acomodacionesTipo2C.php?IdrangoTemporada="+IdrangoTemporada+"&codHospedaje="+codHospedaje);
                 ShowDialog(true);
                 //e.preventDefault();
				}
				 else
				 alert("Atencion: Debe de seleccionar primero el plan");           
        }

	//Para crear rango temporadas con habitacion
		function cargarFormTipo3(codHospedaje,idHabitacion,tipoCreacion)
                {								
                    $("#dialog").load("./controlador/rangoTemporadaC.php?idHospedaje="+codHospedaje+"&idHabitacion="+idHabitacion+"&tipoCrea="+tipoCreacion);
                    ShowDialog(true);
                    //e.preventDefault();          
                }		
		
        function ShowDialog(modal)
        {
            $("#overlay").show();
            $("#dialog").fadeIn(300);
 
            if (modal)
            {
                $("#overlay").unbind("click");
            }
            else
            {
                $("#overlay").click(function (e)
                {
                    HideDialog();
                });
            }
        }
 
        function HideDialog()
        {
            $("#overlay").hide();
            $("#dialog").fadeOut(300);
        } 
		
	function actualizarGrupoViaje(reg,codHospedaje,grupo){
				
            $("#dialog").load("./controlador/acomodacionesC.php?codHospedaje="+codHospedaje+"&reg="+reg+"&idGrupo="+grupo);
            ShowDialog(true);
			
	}

	function actualizarGrupoViajeTipo2(reg,codHospedaje,IdrangoTemporada){
				
            $("#dialog").load("./controlador/acomodacionesTipo2C.php?codHospedaje="+codHospedaje+"&reg="+reg+"&IdrangoTemporada="+IdrangoTemporada);
            ShowDialog(true);
			
	}		
		function ingresarBeneficiarios(reg){
		
			if(document.datos.plan.value!=0)
			{
				 if(reg=='no')
				  $("#dialog").load("./controlador/beneficiarios_C.php?idplan="+document.datos.plan.value);
				 else
				  $("#dialog").load("./controlador/beneficiarios_C.php?idplan="+document.datos.plan.value+"&reg="+reg);  
				
				 
                            ShowDialog(true);
			
			}
			else
			alert("Atencion: Debe de seleccionar primero el plan");
			
		}
                
		function ingresarObservacion(venta){
				 
                    $("#dialog").load("./controlador/observacionesC.php?venta="+venta);
                    ShowDialog(true);
			
		}		