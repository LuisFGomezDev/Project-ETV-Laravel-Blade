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


// string start_table ([array attributes])


// This function returns an opening HTML <table> tag, inside an
// opening paragraph (<p>) tag. Attributes for the table may be supplied 
// as an array.

function start_table ($atts="")
{
	$attlist = get_attlist($atts,array("style"=>" ")
						);
	$output = <<<EOQ
<p>
<table $attlist>
EOQ;
	return $output;
}

// string end_table (void)

// This function returns a closing <table> tag, followed by a closing
// paragraph (<p>) tag. (Presumably closing the paragraph opened by
// start_table().)

function end_table ()
{
	$output = <<<EOQ
</table>
</p>
EOQ;
	return $output;
}

// string table_cell ([string value [, array attributes]])

// This function returns an HTML table cell (<td>) tag. The first
// argument will be used as the value of the tag. Attributes for the
// <td> tag may be supplied as an array in the second argument.
// By default, the table cell will be aligned left horizontally,
// and to the top vertically.

function table_cell ($value="",$atts="")
{
	$attlist = get_attlist($atts,array("align"=>"left","valign"=>"top"));

	$output = <<<EOQ
  <td $attlist>$value</td>
EOQ;
	return $output;
}
//------------------------------------------------------------------------
function table_cell_th($value="",$atts="")
{
	$attlist = get_attlist($atts,array("align"=>"center","valign"=>"top"));

	$output = <<<EOQ
  <th $attlist>$value</th>
EOQ;
	return $output;
}

//------------------------------------------------------------------------
// string table_row ([mixed ...])

// This function returns an HTML table row (<tr>) tag, enclosing a variable
// number of table cell (<td>) tags. If any of the arguments to the function
// is an array, it will be used as attributes for the <tr> tag. All other
// arguments will be used as values for the cells of the row. If an
// argument begins with a <td> tag, the argument is added to the row as is.
// Otherwise it is passed to the table_cell() function and the resulting
// string is added to the row.

function table_row ()
{
	$attlist = "";
	$cellstring = "";

	$cells = func_get_args();
	while (list(,$cell) = each($cells))
	{
		if (is_array($cell))
		{
			$attlist .= get_attlist($cell);
		}
		else
		{
			//si no existe un td o no existe un th crea la fila
			if(!preg_match("/<td/i",$cell) && !preg_match("/<th/i",$cell))			
			{
				$cell = table_cell($cell);
			}

			$cellstring .= "  ".trim($cell)."\n";
		}
	}
	$output = <<<EOQ
 <tr $attlist>
$cellstring
 </tr>
EOQ;
	return $output;
}
//--------------------------------------------------------------------
function table_row_th ()
{
	$attlist = "";
	$cellstring = "";

	$cells = func_get_args();
	while (list(,$cell) = each($cells))
	{
		if (is_array($cell))
		{
			$attlist .= get_attlist($cell);
		}
		else
		{
			if(!preg_match("/<td/i",$cell) && !preg_match("/<th/i",$cell))	
			{
				$cell = table_cell_th($cell);
			}
			$cellstring .= "  ".trim($cell)."\n";
		}
	}
	$output = <<<EOQ
 <tr $attlist>
$cellstring
 </tr>
EOQ;
	return $output;
}
//--------------------------------------------------------------------
function result_table($result,$columns='')
{
	$number_cols = pg_num_fields($result);

	print start_table(array("border"=>1));
	print "<tr align=center>";

//	  foreach($columns as $i) 
	for ($i=0; $i<$number_cols; $i++)
	{
		echo "<th>" . pg_fieldname($result, $i). "</th>\n";
	}
	echo "</tr>\n";

	//layout table body
	$num_rows = pg_numrows($result);
	$i=0;
	while ($i<$num_rows) {
	        $row = pg_fetch_row($result,$i);

		echo"<tr align=left>\n";

//	  foreach($columns as $j) 

		for ($j=0; $j<$number_cols; $j++)
		{
			echo "<td>";
			if (!isset($row[$j]))
				{echo "&nbsp;";}
			else
			   {echo $row[$j];}
			echo "</td>\n";
		}
		echo "</tr>\n";
		++$i;
	}
echo end_table();
}
//Devuelve una cadena para ser impresa
function result_table_cad($result,$columns='')
{
        $number_cols = pg_numfields($result);
        $table_re="";

        $table_re.= start_table(array("border"=>1));
        $table_re.= "<tr align=center>";

        for ($i=0; $i<$number_cols; $i++)
        {
                $table_re.= "<th>" . pg_fieldname($result, $i). "</th>\n";
        }
        $table_re.= "</tr>\n";

        $num_rows = pg_numrows($result);
        $i=0;
        while ($i<$num_rows) {
                $row = pg_fetch_row($result,$i);

        $table_re.="<tr align=left>\n";

         for ($j=0; $j<$number_cols; $j++)
         {
          $table_re.= "<td>";
                        if (!isset($row[$j]))
                                {$table_re.= "&nbsp;";}
                        else
                           {$table_re.= $row[$j];}
                        $table_re.= "</td>\n";
                }
                $table_re.="</tr>\n";
                ++$i;
        }

$table_re.=end_table();
 return $table_re;
}
//--------------------------------------------------------------------------------------------------------------
?>
