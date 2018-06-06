<?php
 
 try {
    require("/dbConn.php");
} catch (Exception $exc) {
    echo "Error occurred connecting to db<br />";
    print_r($exc); 
    die();
}
  
  $v_unumber = $_GET['x_unumber'];
  
  $v_sqlstring = "SELECT * FROM dbo.gabgaw WHERE unumber = ?";
  $v_sqlparams = array();
  $v_sqlparams = array($v_unumber);
  $v_rs = $db->doQueryP($v_sqlstring, $v_sqlparams) or die(print_r(sqlsrv_errors()));
  $v_json_array = array();
  while ($v_row = $db->fetchArray($v_rs)) {
    $v_json_array["unumber"]           = $v_row['unumber'];
    $v_json_array['start_date']        = $v_row['start_date'];
    $v_json_array['end_date']          = $v_row['end_date'];
    $v_json_array['outer_limit']       = $v_row['outer_limit'];
    $v_json_array['number_days']       = $v_row['number_days'];
    $v_json_array['grant_description'] = $v_row['grant_desc'];
    $v_json_array['granting_body']     = $v_row['granting_body'];
}
  header('Content-type: application/json');
  print_r(json_encode($v_json_array));
?>
