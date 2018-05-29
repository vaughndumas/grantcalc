require ("dbConn.php");
<?php
  $v_unumber = $_GET['x_unumber'];
  
  $v_sqlstring = "SELECT * FROM dbo.gabgaw WHERE unumber = ?";
  $v_sqlparams = array();
  $v_sqlparams = array($v_unumber);
  $v_rs = $db->doQueryP($v_sqlstring, $v_sqlparams) or die(print_r(sqlsrv_errors()));
  $v_json_array = array();
  while ($v_row = $db->fetchArray($v_rs)) {
	  array_push($v_json_array, $v_row);
  }
  print_r($v_json_array);
?>
