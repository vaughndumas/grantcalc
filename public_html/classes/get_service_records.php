<?php
namespace grantsutils;
require_once 'calcutil.php';
 
try {
    require("/dbConn.php");
} catch (Exception $exc) {
    echo "Error occurred connecting to db<br />";
    print_r($exc); 
    die();
}

/**
 * Get the service types into an array;
 */
$v_calcutil = new calcutil();
$v_st_arr = $v_calcutil->getServiceTypes();

$v_unumber = $_GET['x_unumber'];

$v_sqlstring = "SELECT CONVERT(varchar, svc_start_date, 112) as v_svc_start_date, "
           . "CONVERT(varchar, svc_end_date, 112) as v_svc_end_date, "
           . "svc_type, fte_ratio "
           . "FROM dbo.gaasvc WHERE unumber = ? ORDER BY svc_start_date";

$v_sqlparams = [];
$v_sqlparams = [$v_unumber];
$v_rs = $db->doQueryP($v_sqlstring, $v_sqlparams) or die(print_r(sqlsrv_errors()));
$v_json_array = array();
while ($v_row = $db->fetchArray($v_rs)) {
//print_r($v_row);
//echo "<hr />";
    $v_date1 = date_create($v_row['v_svc_start_date']);
    $v_date2 = date_create(date('Ymd'));
    if (!is_null($v_row['v_svc_end_date'])) {
        $v_date2 = date_create($v_row['v_svc_end_date']);
    }
    $v_analysis = $v_calcutil->AnalyseServiceRecord($v_date1, $v_date2, 
                                                    $v_row['fte_ratio'], $v_row['svc_type'], 
                                                    $v_st_arr[$v_row['svc_type']]);
    //$v_diff = (date_diff($v_date1, $v_date2)->format("%a")) + 1;
    $v_tmparr = ["svc_start_date" => $v_row['v_svc_start_date'],
        "svc_end_date" => $v_row['v_svc_end_date'],
        "days_between" => $v_analysis["days_between_incl"],
        "svc_type" => $v_row['svc_type'],
        "svc_desc" => $v_st_arr[$v_row['svc_type']]["svc_desc"],
        "fte_ratio" => $v_row['fte_ratio'],
        "extend_date" => $v_st_arr[$v_row['svc_type']]["extend_date_yn"],
        "new_end_date" => $v_analysis["new_end_date"],
        "days_to_add" => $v_analysis["days_to_add"]
    ];
    array_push($v_json_array, $v_tmparr);
}
header('Content-type: application/json');
print_r(json_encode($v_json_array));
?>
