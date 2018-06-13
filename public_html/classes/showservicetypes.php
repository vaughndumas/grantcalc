<?php
namespace grantsutils;

require_once 'calcutil.php';
$v_calcutil = new calcutil();

try {
    $v_service_types = $v_calcutil->getServiceTypes();
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
header('Content-type: text/plain');
//print_r($v_service_types['AL']["svc_desc"]);
//echo "*\n*";
//echo $v_service_types['AL']["extend_date_yn"];
print_r($v_service_types);
?>
