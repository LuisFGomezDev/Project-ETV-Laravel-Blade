//  $("#realizarAsignacion").load("./controlador/realizarAsignacionC.php"); 

function Cargar()
{
	var arr=new Array();
	txt=document.getElementById('box').value;
	arr.push(txt);
	sel=document.getElementById('st');
	for(var i=0; arr[i]; ++i)
	{
		var Op=new Option(arr[i]); 
		sel.options[i]=Op;
	}
}  

