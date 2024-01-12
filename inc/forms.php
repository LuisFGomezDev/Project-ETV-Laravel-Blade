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

// string start_form ([string action [, array attributes]])

// This function returns an HTML <form> tag. If the first argument
// is empty, the value of the global Apache variable SCRIPT_NAME
// is used for the 'action' attribute of the <form> tag. Other
// attributes for the form can be specified in the optional second
// argument; the default method of the form is "post".

// The behavior of this function on servers other than Apache is
// not known. It's likely that it will work, as SCRIPT_NAME is
// part of the CGI 1.1 specification.

function start_form ($action="", $atts="")
{
	global $SCRIPT_NAME;

	if (empty($action)) { $action = $SCRIPT_NAME; }

	$attlist = get_attlist($atts,array("method"=>"post"));
	
	$output = <<<EOQ
<form action="$action" $attlist>
EOQ;
	return $output;
}

// string end_form(void)

// This function returns an HTML </form> tag.

function end_form ()
{
	$output = <<<EOQ
</form>
EOQ;
	return $output;
}

// string text_field ([string name [, string value [, int size [, int maximum length]]]])

// This function returns an HTML text input field. The default size
// of the field is 10. A value and maximum data length for the field
// may be supplied.

function text_field ($name="", $value="", $size=10, $maxlen="", $ro="",$atts="",$div="contact_input")
{
	$maxatt = empty($maxlen) ? "" : "maxlength=\"$maxlen\"";
	
	$attlist = get_attlist($atts,array("class"=>"inputbox"));
	
	$output = <<<EOQ
<div class="$div">
<input type="text" name="$name" value='$value' size="$size" $maxatt $attlist>
<span></span>
</div>
EOQ;
	if ($ro=='RO') {
	$output = str_replace("size","readonly size",$output);}
	return $output;
}

// string textarea_field([string name [, string value [, int cols [, int rows [, string wrap mode]]]]])

// This function returns an HTML textarea field. The default size is
// 50 columns and 10 rows, and the default wrap mode is 'soft', which means 
// no hard newline characters will be inserted after line breaks in what
// the user types into the field. The alternative wrap mode is 'hard',
// which means that hard newlines will be inserted.

function textarea_field ($name="", $value="", $cols=50, $rows=10, $wrap="soft",$atts="")
{
	$attlist = get_attlist($atts,array("class"=>"inputbox required invalid"));
	
	$output = <<<EOQ

<textarea name="$name" cols="$cols" rows="$rows" wrap="$wrap" $attlist>$value</textarea>


EOQ;
	return $output;
}

// string password_field ([string name [, string value [, int size [, int maximum length]]]])

// This function returns an HTML password field. This is like a text field,
// but the value of the field is obscured (only stars or bullets are visible
// for each character).  The default size of the field is 10.  A starting
// value and maximum data length may be supplied.

function password_field ($name="", $value="", $size=10, $maxlen="",$atts="",$div="contact_input")
{
	
 	$attlist = get_attlist($atts,array("class"=>"inputbox"));
	
	$output = <<<EOQ
<div class="$div">		
<input type="password" name="$name" value="$value" size="$size" maxlength="$maxlen" $attlist>
<span></span>
</div>
EOQ;
	return $output;
}

// string hidden_field ([string name [, string value]])

// This function returns an HTML hidden field. A value may be supplied.

function hidden_field ($name="", $value="")
{
	$output = <<<EOQ
<input type="hidden" name="$name" value="$value" id="$name">
EOQ;
	return $output;
}

// string file_field ([string name])

// This function returns an HTML file field. These are used to specify
// files on the user's local hard drive, typically for uploading as
// part of the form. (See http://www.zend.com/manual/features.file-upload.php
// for more information about this subject.)

function file_field ($name="")
{
	$output = <<<EOQ
<input type="file" name="$name">
EOQ;
	return $output;
}

// string submit_field ([string name [, string value]])

// This function returns an HTML submit field. The value of the field
// will be the string displayed by the button displayed by the user's
// browser. The default value is "Submit".

function submit_field ($name="", $value="",$atts="")
{
	
	$attlist = get_attlist($atts,array("class"=>"btn btn-danger"));
	
	if (empty($value)) { $value = "Submit"; }

	$output = <<<EOQ
<input type="submit" name="$name" value="$value" $attlist>
EOQ;

	return $output;

}

function button_field ($name="", $value="",$atts="")
{
	
	$attlist = get_attlist($atts,array("class"=>"btn btn-success"));
	
	if (empty($value)) { $value = "Submit"; }

	$output = <<<EOQ
<input type="button" name="$name" value="$value" $attlist>
EOQ;

	return $output;

}

// string image_field ([string name [, string src [, string value]]])

// This function returns an HTML image field. An image field works
// likes a submit field, except that the image specified by the URL
// given in the second argument is displayed instead of a button.

function image_field ($name="", $src="", $value="")
{
	if (empty($value)) { $value = $name; }

	$output = <<<EOQ
<input type="image" name="$name" value="$value" src="$src">
EOQ;
	return $output;
}

// string reset_field ([string name [, string value]])

// This function returns an HTML reset field. A reset field returns
// the current form to its original state.

function reset_field ($name="reset", $value="Reset")
{
	$output = <<<EOQ
<input type="reset" name="$name" value="$value">
EOQ;
	return $output;
}

// string checkbox_field ([string name [, string value [, string label [, string match]]]])

// This function returns an HTML checkbox field. The optional third argument
// will be included immediately after the checkbox field, and the pair
// is included inside a HTML <nobr> tag - meaning that they will be
// displayed together on the same line.  If the value of the
// second or third argument matches that of the fourth argument,
// the checkbox will be 'checked' (i.e., flipped on).

function checkbox_field ($name="", $value="", $label="", $match="", $atts="")
{
	
	$attlist = get_attlist($atts,array("class"=>"inputbox"));
	
	$checked = ($value == $match || $label == $match) ? "checked" : "";
	$output = <<<EOQ
<nobr><input type="checkbox" name="$name" value="$value" $checked $attlist> $label</nobr>
EOQ;
	return $output;
}

// string radio_field ([string name [, string value [, string label [, string match]]]])

// This function returns an HTML radio button field. The optional third 
// argument will be included immediately after the radio button, and the pair
// is included inside a HTML <nobr> tag - meaning that they will be
// displayed together on the same line.  If the value of the
// second or third argument matches that of the fourth argument,
// the radio button will be 'checked' (i.e., flipped on).

function radio_field ($name="", $value="", $label="", $match="", $atts="")
{
	
	$attlist = get_attlist($atts,array("class"=>"inputbox"));
	
	$checked = ($value == $match || $label == $match) ? "checked" : "";
	$output = <<<EOQ
<nobr><input type="radio" name="$name" value="$value" $checked $attlist > $label</nobr>
EOQ;
	return $output;
}

// string select_field ([string name [, array items [, string default value]]])

// This function returns an HTML select field (a popup field).
// If the optional second argument is an array, each key in the array
// will be set to the value of an option of the select field, and
// the corresponding value from the array will be the displayed string
// for that option. If the key or the value from the array matches
// the optional third argument, that option will be designated as the default
// value of the select field.

function select_field ($name="", $array="", $value="", $size="1",$atts="")
{
	
	$attlist = get_attlist($atts,array("class"=>"inputbox"));
	
	
	$output = <<<EOQ
<select name="$name" size="$size" $attlist> 
EOQ;
	if (is_array($array))
	{
		
		while (list($avalue,$alabel) = each($array))
		{	//echo "<br>Mire pues: $avalue:$alabel:";
			//$selected = ($avalue == $value || $alabel == $value) ? 
			$selected = ($avalue == $value) ? 
				"selected" : ""
			;
			
			$alabel=htmlentities($alabel);
			
			$output .= <<<EOQ
<option value="$avalue" $selected>$alabel</option>
EOQ;
		}
	}
	 
	
	$output .= <<<EOQ
</select>
EOQ;
	return $output;
}

// string db_select_field ([string name [, string table name [, string value field [, string label field [, string sort field [, string match text [, string where clause]]]]]]])

// This function returns an HTML select field (popup field), based
// on the values in the MySQL database table specified by the second argument,
// as returned by the db_values_array() function (defined in 
// /book/functions/db.php).

function db_select_field ($name="", $table="", $value_field=""
	, $label_field="", $sort_field="", $match="", $where="",$atts=""
)
{
	$values = db_values_array($table, $value_field, $label_field
		, $sort_field, $where
	);
	$output = select_field($name, $values, $match,$size,$atts);
	return $output;
}

function db_link_field ($name="", $table="", $value_field=""
	, $label_field="", $sort_field="", $where="", $size=""
)
{
	$result = safe_query("select $value_field, $label_field
		 from $table where $where order by $value_field");
	$values[0] = "Agregar";
	if ($result)
	{
              $num = pg_numrows($result);
                $i=0;
                while ($i<$num) {
                        list($value,$label) = pg_fetch_array($result, $i);
                        $values[$value] = $value ." - " . $label;
                $i++;
                }
	}       

 
	$output = select_field($name, $values, $match, $size);
	return $output;
}

// string db_radio_field (string name, string table name, string value field, string label field, string sort field, [string match text], [string where clause])

// This function returns a list of HTML radio button fields, separated
// by a non-breaking space HTML entity (&nbsp;) and a newline, based
// on the values in the MySQL database table named by the second
// argument, as returned by the db_values_array() function (defined in 
// /book/functions/db.php).

function db_radio_field ($name="", $table="", $value_field=""
	, $label_field="", $sort_field="", $match="", $where="",$separador="<br>"
)
{
	$values = db_values_array($table, $value_field, $label_field
		, $sort_field, $where
	);

	$output = "";
	while (list($value, $label) = each($values))
	{
		$output .= radio_field($name, $value, $label, $match)
			."$separador"
		;
	}
	return $output;
}
/*
function tel_field
Returns a formated input field with area code, telephone number and optional extension


*/
function tel_field ($name="", $a_code="", $number="", $ext="", $ext_value=""
)
{
if (!empty($ext)) {
$extension = <<<EOQ
      $ext
      <input type ="text" name="ext_$name" value="$ext_value" size="3" maxlength="5">
EOQ;
}
$output = <<<EOQ
    (
    <input type ="text" name="ind_tel_$name" value="$a_code" size="1" maxlength="3">
    )
    <input type ="text" name="tel_$name" value="$number" size="6" maxlength="7">
    $extension
EOQ;
        return $output;
}
?>
