<?PHP
/*

********************************************************
*** This script from MySQL/PHP Database Applications ***
***         by Jay Greenspan and Brad Bulger         ***
***                                                  ***
***   You are free to resuse the material in this    ***
***   script in any manner you see fit. There is     ***
***   no need to ask for permission or provide       ***
***   credit.                                        ***
********************************************************
*/


// string font_tag ([int size [, string typeface [, array attributes]]])

// This function returns an HTML <font> tag. The default font size is
// 2, and the default font typeface is sans-serif. Additional attributes
// for the tag may be supplied as an array in the third argument.

function font_tag($size="2",$face="sans-serif",$atts="")
{
	$attlist = get_attlist($atts,array("size"=>$size,"face"=>$face));
	$output = "<font $attlist>";
	return $output;
}

// string anchor_tag ([string href [, string text [, array attributes]]])

// This function returns an HTML anchor tag (<a>).  The first argument
// be the URL to which the tag points, and the second argument will
// be the text of the tag. Additional attributes may be supplied as
// an array in the third argument.

function anchor_tag($href="",$text="",$atts="")
{
	$attlist = get_attlist($atts,array("href"=>$href,"border"=>0));
	$output = "<a $attlist>$text</a>";
	return $output;
}

function click_window($href="",$text="",$atts="")
{
	$attlist = get_attlist($atts,array("href"=>$href));
	$output = "
	<a onClick='window.open(\"$href\", \"help\", \"toolbar=no,menubar=yes,scrollbars=yes,width=800,height=400,resizable=yes\"); return false' href=\"$href\">$text</a>
";
	return $output;
}

// string image_tag ([string src [,array attributes]])

// This function returns an HTML image tag (<img>). The first argument
// gives theURL of the image to be displayed. Additional attributes
// may be supplied as an array in the third argument.

function image_tag($src="",$atts="")
{
	$attlist = get_attlist($atts,array("src"=>$src));
	$output = "<img $attlist>";
	return $output;
}

// string subtitle ([string text of subtitle])

// This function returns an HTML <h3> tag. It is used for the titles
// of secondary areas within pages in our examples. The reason to 
// display these via a function, rather than just literal <h3> tags,
// is to enable you to change the format of these subtitles in one
// place, instead of in each script.

function subtitle($what="")
{
	return "<h3>$what</h3>\n";
}

// string paragraph ([array attributes [, mixed ...]])

// This function will return a string inside HTML paragraph (<p>) tags.
// Attributes for the <p> tag may be supplied in the first argument.
// Any additional arguments will be included inside the opening and
// closing <p> tags, separated by newlines.

function paragraph ($atts="")
{
	$output = "<p";
	$i = 0;
	$attlist = get_attlist($atts);
	if ($attlist > "") 
	{ 
		$output .= " $attlist"; 
		$i++;
	}
	$output .= ">\n";
	$args = func_num_args();
	while ($i < $args)
	{
		$x = func_get_arg($i);
		$output .= $x."\n";
		$i++;
	}
	$output .= "</p>\n";
	return $output;
}

// string ul_list ([mixed values])

// This function returns an HTML unordered (bulleted) list (<ul> tags). 
// If the argument is an array, then each value from the array will be
// included as a list item (<li>) in the list. Otherwise, the
// argument will simply be included inside the <ul> tags as is.

function ul_list ($values="")
{
	$output .= "<ul>\n";
	if (is_array($values))
	{
		while (list(,$value) = each($values))
		{
			$output .= " <li>$value\n";
		}
	}
	else
	{
		$output .= $values;
	}
	$output .= "</ul>\n";
	return $output;
}
//Devuelve un identificar para mostrar la ayuda
function ayuda_emergente($etiqueta,$titulo,$contenido)
{
 return "<div id=\"$etiqueta\" style=\"overflow:hidden;\"  onmouseover=\"this.T_TITLE='$titulo'; this.T_WIDTH=250; return escape('<p style=&quot;margin: 0px;&quot; align=justify>$contenido</p>')\">";
}
//---------------------------------------------------------------------------------------------------
//Mensaje de error.. funciona con la hoja de estilo
function mensaje_respuesta($mensaje,$tipo){

$cadena="<div class=\"error-message\">";

if($tipo=='error')
 $cadena.="<IMG SRC=\"./images/important.png\" border=0 align=center>";
elseif($tipo=='conf')
  $cadena.="<IMG SRC=\"./images/check.gif\" border=0 align=center>";
else
 $cadena.="<IMG SRC=\"./images/check.gif\" border=0 align=center>";

$cadena.="Atenci&oacuten<br>"; 

if(is_array($mensaje))
 {
  $cadena.="<UL>";
  for($i=0;$i<count($mensaje);$i++)
   $cadena.="<LI>".$mensaje[$i]."</LI>";
  $cadena.="</UL>";
 }
$cadena.="</div>";

 return $cadena;
}
//---------------------------------------------------------------------------------------------------
function notas($mensaje,$tipo=1){
 
 if($tipo==1)
  $clas='confirm-message';
 elseif($tipo==2)
  $clas='confirm-alerta';

 $cadena="<div class=\"$clas\" align=\"justify\">";

 if(is_array($mensaje))
 {
  $cadena.="<UL>";
  for($i=0;$i<count($mensaje);$i++)
  if(!empty($mensaje[$i]))
   $cadena.="<LI><b>*</b>&nbsp;&nbsp;".$mensaje[$i]."</LI>";
  $cadena.="</UL>";
 }
  else
  $cadena.=$mensaje;
  
 $cadena.="</div>";

 return $cadena;
 
}
//---------------------------------------------------------------------------------------------------
//quita las comillas dobles y sencillas. Mas que todo para codigos.
function quitar_comillas($cadena){
	$cadena=  str_replace("\"","",$cadena);
	$cadena=  str_replace("\'","",$cadena);
	$cadena=  str_replace("\\","",$cadena);	
	return $cadena;
}
//---------------------------------------------------------------------------------------------------
//Quita el \ que tiene las cadenas para mostrar al usuario lo que escribio.
function poner_comillas($cadena){
	$cadena=  str_replace("\\","",$cadena);
	return 	$cadena;
}
?>