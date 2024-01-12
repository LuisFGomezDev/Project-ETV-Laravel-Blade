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
// void dbconnect ([string database name [, string user name [, string password [, string server name]]]])

// This function will connect to a MySQL database. If the attempt to connect
// fails, an error message prints out and the script will exit.

function dbconnect ($dbname="comercial_kima",$user="postgres",$password="kimaarm",$server="127.0.0.1")
 {
  global $connection;
	if (!($connection = pg_connect("host=$server dbname=$dbname user=$user password=$password" )))
	{
		echo "<h3>No hay conexión con la Base de Datos</h3>\n host=$server dbname=$dbname user=$user password=$password";
		exit;
	}
}

function dbclose()
{
    global $connection;
    pg_close($connection);
}

// int safe_query ([string query])

// This function will execute an SQL query against the currently open
// MySQL database. If the global variable $query_debug is not empty,
// the query will be printed out before execution. If the execution fails,
// the query and any error message from MySQL will be printed out, and
// the function will return FALSE. Otherwise, it returns the MySQL
// result set identifier.

function safe_query ($query = "")
{
	global	$query_debug;
	global	$connection;
	$query = str_replace("''","NULL",$query);
	$query = str_replace("'\012'","NULL",$query);
	
	//echo $query;
	if (empty($query)) { return FALSE; }

	if (!empty($query_debug)) { print "<pre>$query</pre>\n"; }
	
	/*
		$f_osc=fopen($GLOBALS['server_sys']."/oscar_backup.sql","w+");	
		fwrite($f_osc,$query."\n\n\n\n\n");
		fclose($f_osc);
	*/
	
	$result =$GLOBALS['db']->Execute($query);
	
	/*$result = pg_exec($connection,$query)
		or die("ack! query failed: "
			."<li>error=".pg_errormessage($connection)
			."<li>query=".$query
			."<li>connection=".$connection
			."<li>result=".$result
		);*/
		
		
	return $result;
}

function query ($query = "")
{
	global	$query_debug;
	global	$connection;
	$query = str_replace("''","NULL",$query);
	$query = str_replace("'\012'","NULL",$query);
	if (empty($query)) { return FALSE; }
	
	if (!empty($query_debug)) { print "<pre>$query</pre>\n"; }

	$result =$GLOBALS['db']->Execute($query);
	//$result = pg_exec($connection,$query);
	return $result;
}

// void set_result_variables (int result identifier)

// This function creates global variables using the field names from a
// MySQL data set, setting the values of those variables to the values
// from the first row from that data set.

function set_result_variables ($result)
{
	if (!$result || !pg_numrows($result)) { return; }
	$row = pg_fetch_array($result,0,PGSQL_ASSOC);
	if (!is_array($row)) 
	{ 
print $query."<li>no array returned : result=$result row=$row"; 
		return $result; 
	}
	while (list($key,$value) = each($row))
	{
		global $$key;
		$$key = $value;
	}
}

// int fetch_record (string table name [, mixed key [, mixed value]])

// This function will select values from the MySQL table specified by
// the first argument.  If the optional second and third arguments
// are not empty, the select will get the row from that table where
// the column named in the second argument has the value given by
// the third argument.  The second & third arguments may also be
// arrays, in which case the query builds its WHERE clause using
// the values of the second argument array as the table column names
// and the corresponding values of the third argument array as
// the required values for those table columns. If the second and third
// arguments are not empty, the data from the first row returned
// (if any) is set to global variables by the set_result_variables()
// function (see above).

function fetch_record ($table, $key="", $value="")
{
	$query = "select * from $table ";
	if (!empty($key) && !empty($value))
	{
		if (is_array($key) && is_array($value))
		{
			$query .= " where ";
			$and = "";
			while (list($i,$v) = each($key))
			{
				$query .= "$and $v = ".$value[$i];
				$and = " and";
			}
		}
		else
		{
			$query .= " where $key = $value ";
		}
	}
	$result = safe_query($query);
	if (!empty($key) && !empty($value))
	{
		set_result_variables($result);
	}
	return $result;
}

// array db_values_array ([string table name [, string value field [, string label field [, string sort field [, string where clause]]]]])

// This function builds an associative array out of the values in
// the MySQL table specified in the first argument. The data from the column 
// named in the second argument will be set to the keys of the array.
// If the third argument is not empty, the data from the column it names
// will be the values of the array; otherwise, the values will be equal
// to the keys. If the fourth argument is not empty, the data will be
// ordered by the column it names; otherwise, it will be ordered by
// the key column. The optional fifth argument specifies any additional
// qualification for the query against the database table; if it is empty,
// all rows in the table will be retrieved.

// If either the first or second argument is empty, no query is run and
// an empty array is returned.

// The function presumes that whoever calls it knows what they're about -
// e.g., that the table exists, that all the column names are correct, etc.

function db_values_array ($table="", $value_field="", $label_field=""
        , $sort_field="", $where=""
)
{
        $values = array();

        if (empty($table) || empty($value_field)) { return $values; }

        if (empty($label_field)) { $label_field = $value_field; }
        if (empty($sort_field)) { $sort_field = $label_field; }
        if (empty($where)) { $where = "1=1"; }

        $query = "select $value_field 
                , $label_field 
                from $table 
                where $where
                order by $sort_field
        ";
        $result = safe_query($query);

        if ($result)
        {
                $i=0;
				while(!$result->EOF)                
                {				 	
				
                 if(!empty($result->fields[2]))
                  $values[$result->fields[0]] = $result->fields[1]." ".$result->fields[2];
                  else
                   $values[$result->fields[0]] = $result->fields[1];
				   
                 $i++;
				 
				 $result->MoveNext();
                }
        }
		
        return $values;
}
// int get_seq (string [string])

// This function will advance the sequence counter by one and return
// a unique number.  If the optional prefix is included the prefix and
// seq number will be concatenated.

function get_seq ($table = "", $db_prefix= "", $tb_prefix= "")
{
	// Construct sequence table name from passed values
	$table_col_seq = $table;
	$table_col_seq .= "_seq";

    // Get next sequence number for record insertion
    $query = "select nextval('$table_col_seq')";
	
	$result = $GLOBALS['db']->Execute($query);
	
    list($key,$seq)= each($result->fields);

	// Format output with prifix and left padded 0's
	$prefix = $db_prefix . $tb_prefix;
	$result = sprintf("$prefix%04d",$seq);

	return $result;
}
//--------------------------------------------------------------------------------------------
//Particionar cadena
function crear_arreglo($text)
{
   $registros=array();
  
   $cadena_re=explode("|]",$text);	
   
   if($cadena_re[0]!='[|OK')
   {
    //echo $cadena_re[0];
    return array();
   }
    
    $num_re=str_replace("[|","",$cadena_re[1]);
    $contador=0;	
	//echo "<br>Numeros=$num_re<br>";
	for($i=2;$i<$num_re+2;$i++)
	{
	 $tem_cad=str_replace("[|","",$cadena_re[$i]);
	 $temp2=explode(",",$tem_cad);
	 $num_reg=count($temp2);
	 //echo $tem_cad;
	 for($j=0;$j<$num_reg;$j++)
	 {
	   $registros[$contador][$j]=$temp2[$j];
	   //echo $registros[$contador][$j].",";
	 }  
	  //echo "<br>";
	  $contador++;  
	} 
	//echo "PArada:: $contador<br>";	
	return $registros;
}
?>
