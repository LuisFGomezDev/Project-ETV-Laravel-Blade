    function lTrim(sStr){
	
     while (sStr.charAt(0) == " ") 
      sStr = sStr.substr(1, sStr.length - 1);
     return sStr;
  	}	
	
    function rTrim(sStr){
     while (sStr.charAt(sStr.length - 1) == " ") 
      sStr = sStr.substr(0, sStr.length - 1);
     return sStr;
    }
 
    function allTrim(sStr){
      return rTrim(lTrim(sStr));
    	}


	function procesar()
	{	 
		    
  	  $("#procesar_venta").html("");//Limpio el formulario	  
	   
	  $("#tipificacion option[value=0]").attr("selected",true);		 
	  $("#guion option[value=0]").attr("selected",true);		 
	  $("#guionVenta").hide();
	  	  
	}	 
	
	function abrir_ventana(Url,NombreVentana,width,height,extras)
	{
		
	var largo = width;
	var altura = height;
	var adicionales= extras;
	var top = (screen.height-altura)/2;
	var izquierda = (screen.width-largo)/2; 
	
	window.open(''+ Url + '',''+ NombreVentana + '','scrollbars=yes,width=' + largo + ',height=' + altura + ',top=' + top + ',left=' + izquierda + ',features=' + adicionales + ''); 
	

		  
	}		 
	
	function anularPlan(reg,opcion)	
	{
	 	if(opcion=='AnularP1'){	
		 if(confirm("Atención: ¿Esta seguro de no incluir el plan?"))
		  $("#viajerosdiv").load("./controlador/acomodaciones_div_C.php?reg="+reg);//Recarga de nuevo Asegurados y elimina registro	 		
		}
	 	else 
		if(opcion=='AnularBenefi'){		 				 
	 	 if(confirm("Atención: ¿Está seguro de eliminar el beneficiario?"))
		  $("#beneficiariosdiv").load("./controlador/beneficiarios_div_C.php?reg="+reg);//Recarga de nuevo los Beneficiarios	y elimina registro					
		}		
		 
	}	


        

	function recargar_planElegido()
	{		  
		  $("#planSelecionado").load("./controlador/datosPlanSeleccionadoC.php");   		 		   
	}

	function recargarBeneficiarios()
	{		  
		  $("#recargtarBeneficiarios").load("./controlador/recargarBeneficiariosC.php");   		 		   
	}

         
        function editarCampo(opcion,campo,original){
           
            if($(opcion).is(":checked"))
            {          
             $(campo).removeAttr('readonly');
             $(campo).focus();
            }
            else
            {
             $(campo).val($(original).val());   
             $(campo).attr('readonly', 'readonly');             
            }


        }
        
	function calcularEdad(dato,campo){		
		 var fecha=dato.value;

		 $(campo).load("./controlador/varios.php?opcion=calcularEdad&fechaNacimiento="+fecha);		
	
	}	
		
	
//------------------------------------------------------------------------------
function traerValorAdicional_Actualizacion(valor,campo,opcion_id){		

    $(campo).load("./controlador/varios.php?opcion="+opcion_id+"&dato="+valor);
    if("#traerPrima"==campo){

            $("#cambioPlan").load("./controlador/varios.php?opcion=nombrePlan&dato="+valor);

    }

}		
//------------------------------------------------------------------------------
function cambiarProvincia(form){
		
    ciudad=form.value;  
    $("#idProvincia").load("./controlador/varios.php?opcion=cambioProvincia&ciudad="+ciudad);
    $("#txtProducto").val("");
    $("#lblSectorBarrio").html("");
    $("#idBarrio").val("0");
    $("#idCalle").html("");
    
}
//Utilizado en la zona de administracion
function cambiarProvinciaAdmin(form){
		
    ciudad=form.value;  
    $("#idProvincia").load("./controlador/varios.php?opcion=cambioProvincia&ciudad="+ciudad);
    $("#idsecBarrio").load("./controlador/varios.php?opcion=listSectBarrio&ciudad="+ciudad);
}
//Formulario para agregar un nuevo sector o barrio
function agregarSectorBarrio(){
    
    ciudad=$("#ciudad").val();        
    cargarForm("controlador/datosSectorBarrioC.php?ciudad="+ciudad);
    
}

function traerSectorBarrioCiudad(ciudad)
{
   $("#idsecBarrio").load("./controlador/varios.php?opcion=listSectBarrio&ciudad="+ciudad);  
}
/*
 Cundo hay lista de chequeo, se verifica si fue preguntada
 **/
function verificarDatos(){
		
    var bandera=true;

    $(':checkbox').each(function(index, item){

        if(item.name == 'lectChequeo')
        {
            if(item.checked == false){                             
                bandera=false;
            }

        }

    });

    /*           
    if(bandera==1){

    div = document.getElementById("enviarForm");
    div.style.display = '';

    }*/

    if(bandera==false)
    alert("Atención: No ha diligenciado la lista de chequeo");       

    return bandera;
		 
}


function armarDireccion()
{
        var cadenaDireccion="";

        if($("#viaP1").val()!="1")
            cadenaDireccion=$("#viaP1 option:selected").html();

        if($("#num1").val()!="")
            cadenaDireccion=cadenaDireccion+" "+$("#num1").val();

        if($("#viaP2").val()!="1")
            cadenaDireccion=cadenaDireccion+" "+$("#viaP2 option:selected").html();

        if($("#bis1").is(":checked"))
            cadenaDireccion=cadenaDireccion+" "+"BIS";		 

        if($("#num2").val()!="")
            cadenaDireccion=cadenaDireccion+" "+$("#num2").val();		 

        if($("#generadora").val()!="1")
            cadenaDireccion=cadenaDireccion+" "+$("#generadora option:selected").html();		 

        if($("#bis2").is(":checked"))
            cadenaDireccion=cadenaDireccion+" "+"BIS";		 		 

        if($("#placa").val()!="")
            cadenaDireccion=cadenaDireccion+" "+$("#placa").val();		 		 

        if($("#cuadrante").val()!="1")
            cadenaDireccion=cadenaDireccion+" "+$("#cuadrante option:selected").html();			 

        if($("#bloque").val()!="1")
            cadenaDireccion=cadenaDireccion+" "+$("#bloque option:selected").html();			 		 	

        if($("#num3").val()!="")
            cadenaDireccion=cadenaDireccion+" "+$("#num3").val();	


        if($("#tipoResidencia").val()!="1")
            cadenaDireccion=cadenaDireccion+" "+$("#tipoResidencia option:selected").html();	


        $("#direccionPred").val(cadenaDireccion);	  

}	 	 
//------------------------------------------------------------------------------
function generarTextoAnotacion(estado)
{
    //$("#idTextoVenta").html("????");
    //$('input, select, textarea').attr('readonly', estado);
    //$("#enviar").attr("disabled",false);    
}
//------------------------------------------------------------------------------
function clienteCorreo()
{
  
  if($("#sinCorreo").is(":checked"))
  {
   $("#email").val("sincorreo@claro.com.do");
   $("#email").attr('readonly', 'readonly');
  }
  else
  {
   $("#email").val("");
   $("#email").removeAttr('readonly');
  }

}

function copia_portapapeles(id){ 
   
   if (window.clipboardData){ 
      window.clipboardData.setData("Text",$(id).val()) ;
   } 
}
function procesarOpcionVeri(form,paso,tipoLlamada,vdnLlamada)
{   
    
   var peso=form.value;
   var producto=document.datos.producto.value; 
   var cadena="?tipoLlamada="+tipoLlamada+"&vdnLlamada="+vdnLlamada+"&paso="+paso+"&producto="+producto+"&peso="+peso; 
    
    switch(paso)
    {
        case 4:
            
            if(peso==1)
            {              
              document.datos.paso5[0].disabled=false;  
              document.datos.paso5[1].disabled=false;
            }
            else
            {

              document.datos.paso5[0].checked=false;        
              document.datos.paso5[1].checked=false;                                 
              document.datos.paso5[0].disabled=true;  
              document.datos.paso5[1].disabled=true;
              
              document.datos.paso6[0].checked=false;        
              document.datos.paso6[1].checked=false;                                 
              document.datos.paso6[0].disabled=true;  
              document.datos.paso6[1].disabled=true;
                
              /*document.datos.paso4[0].checked=false;        
              document.datos.paso4[1].checked=false;                                 
              document.datos.paso4[0].disabled=true;  
              document.datos.paso4[1].disabled=true;
              */
              //$("#datosAddVenta").hide();
                
            }
            break
            
        case 5:
            
            

            if(peso==1)
            {
              document.datos.paso6[0].disabled=false;  
              document.datos.paso6[1].disabled=false;
            }     
            else
            {
             /* document.datos.paso3[0].checked=false;        
              document.datos.paso3[1].checked=false;                                 
              document.datos.paso3[0].disabled=true;  
              document.datos.paso3[1].disabled=true;                 */
             
              document.datos.paso6[0].checked=false;        
              document.datos.paso6[1].checked=false;                                 
              document.datos.paso6[0].disabled=true;  
              document.datos.paso6[1].disabled=true;   
             
             
             // $("#datosAddVenta").hide();
                
            }
            break
        case 6:
            
            if(peso==1)
                $("#datosAddVenta").show();               
            else
                $("#datosAddVenta").hide();
            
            break
            
    }
             cadena=cadena+"&opcion=tipificaPasoVerifi";
             $("#opcion_tipifica").load("./controlador/varios.php"+cadena);
}

function asignarActivacion()
{    
  $("#realizarAsignacion").load("./controlador/realizarAsignacionC.php");  
}
function asignarFacturacion()
{    
  $("#realizarAsignacion").load("./controlador/realizarAsigFacturaC.php");  
}



//**********************************************************

function CargarSelectEjemplo()
{    
//  $("#realizarAsignacion").load("./controlador/realizarAsignacionC.php"); 
var arr=new Array();
function Cargar()
{
txt=document.getElementById('box').value;
arr.push(txt);
sel=document.getElementById('st');
for(var i=0; arr[i]; ++i)
{
var Op=new Option(arr[i]); sel.options[i]=Op;
}
}  

}