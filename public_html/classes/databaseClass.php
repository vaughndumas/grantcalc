<?php
require ("dbConn.php");
function mssql_escape($str)
{
//if (ini_get("magic_quotes_sybase") == '1') return $str;
return str_replace("'", "''", $str);
}

function mssql_unescape($str)
{
if (ini_get("magic_quotes_sybase") != '1') return $str;
return str_replace("''", "'", $str);
}


class Database
{
protected $db_con;

// Rest is public by default

	function connect()
  	{
	    if (($this->db_con = sqlsrv_connect("rsb0001382", array("UID" => "calcuser", "PWD" => "calc123", "Database" => "grantscalc"))) === false)
		{
		  print_r(sqlsrv_errors());
		  die("<br><br>Database GRANTSCALC is not available (password)");
		}
    	//sqlsrv_select_db("workbooks2009NovFullCopy") or die("Database is not available (database name)");
	}

	function doQuery($query)
	{
    	return @sqlsrv_query($this->db_con, $query, array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	}
	
	function doQueryP($query, $param_array)
	{
    	return @sqlsrv_query($this->db_con, $query, $param_array, array("Scrollable" => SQLSRV_CURSOR_STATIC));
	}

	function fetchArray($resultId)
	{
	return @sqlsrv_fetch_array($resultId, SQLSRV_FETCH_ASSOC);
	}

	function getNumRows($resultId)
	{
    	return @sqlsrv_num_rows($resultId);
	}

	function serverInfo()
	{
	return @sqlsrv_server_info($this->db_con);
	}

}

?>