<?php
 
 try {
    require("/dbConn.php");
} catch (Exception $exc) {
    echo "Error occurred connecting to db<br />";
    print_r($exc); 
    die();
}
  
  $v_unumber = $_GET['x_unumber'];
  
  $v_sqlstring = "SELECT * FROM dbo.gaasvc WHERE unumber = ? ORDER BY svc_start_date";
  $v_sqlparams = array();
  $v_sqlparams = array($v_unumber);
  $v_rs = $db->doQueryP($v_sqlstring, $v_sqlparams) or die(print_r(sqlsrv_errors()));
  $v_json_array = array();
  while ($v_row = $db->fetchArray($v_rs)) {
      array_push($v_json_array, $v_row);
}
  header('Content-type: application/json');
  print_r(json_encode($v_json_array));
?>
