<?php
 
 try {
    require("/dbConn.php");
} catch (Exception $exc) {
    echo "Error occurred connecting to db<br />";
    print_r($exc); 
    die();
}
  
  $v_unumber = $_GET['x_unumber'];
  
  $v_sqlstring = "SELECT CONVERT(varchar, svc_start_date, 112) as v_svc_start_date, "
               . "CONVERT(varchar, svc_end_date, 112) as v_svc_end_date, "
               . "svc_type, fte_ratio "
               . "FROM dbo.gaasvc WHERE unumber = ? ORDER BY svc_start_date";
  
  $v_sqlparams = array();
  $v_sqlparams = array($v_unumber);
  $v_rs = $db->doQueryP($v_sqlstring, $v_sqlparams) or die(print_r(sqlsrv_errors()));
  $v_json_array = array();
  while ($v_row = $db->fetchArray($v_rs)) {
      
      $v_date1 = date_create($v_row['v_svc_start_date']);
      $v_date2 = date_create(date('Ymd'));
      if (!is_null($v_row['v_svc_end_date'])) {
          $v_date2 = date_create($v_row['v_svc_end_date']);
      }
      $v_diff = (date_diff($v_date1, $v_date2)->format("%a")) + 1;
      //echo "diff:  ".$v_row['v_svc_start_date']." to ".$v_date2->format('Y-m-d').":  ".$v_diff."<br />";
      $v_tmparr = ["svc_start_date"=>$v_row['v_svc_start_date'],
                   "svc_end_date"=>$v_row['v_svc_end_date'],
                   "days_between"=>$v_diff,
                   "svc_type"=>$v_row['svc_type'],
                   "fte_ratio"=>$v_row['fte_ratio']
                  ];     
      array_push($v_json_array, $v_tmparr);
}
  header('Content-type: application/json');
  print_r(json_encode($v_json_array));
?>
