<?php
namespace grantsutils;

class calcutil {
    
    public function __construct()
    {
    }
    
    /**
     * 
     * @param string $x_startdate Service Record start date
     * @param string $x_enddate   Service Record end date
     * @param number $x_fte       FTE ratio
     * @param string $x_svc_type  Service Record Service type
     * @param array  $x_service_types Array of service types
     * returns object New End Date and Date difference
     */
    public function AnalyseServiceRecord ($x_startdate, $x_enddate,
                                          $x_fte, 
                                          $x_svc_type, $x_service_types) {
 
        $v_total_days = date_diff($x_startdate, $x_enddate)->format('%a');
        $v_return = ["new_end_date"      => $x_enddate->format("Ymd"), 
                     "days_between_incl" => $v_total_days,
                     "days_to_add"       => 0,
                     "rounded_down"      => 0,
                     "rounded_up"        => 0];
        
        if (!( ($x_fte === "1.00") || ($x_service_types["extend_date_yn"] === "N"))) {
            $v_rounded_up = 0;
            $v_rounded_down = 0;
            $v_tmp_worked = round(floatval($x_fte) * $v_total_days);
            $v_days_worked = floatval($x_fte) * $v_total_days;
            if (floatval($v_days_worked) >= $v_tmp_worked) {
                $v_rounded_down = $v_days_worked - floatval($v_tmp_worked);
                $v_rounded_up = 0;
            } else {
                $v_rounded_down = 0;
                $v_rounded_up = floatval($v_tmp_worked) - $v_days_worked;
            }
            $v_days_to_extend = $v_total_days - $v_days_worked;
            $v_tmpdate = $x_enddate;
            $v_new_enddate = date_add($v_tmpdate, \DateInterval::createFromDateString(intval($v_days_to_extend)." days"));
            $v_return = ["new_end_date"      => $v_new_enddate->format("Ymd"),
                         "days_between_incl" => $v_days_worked,
                         "days_to_add"       => $v_days_to_extend,
                         "rounded_down"      => $v_rounded_down,
                         "rounded_up"        => $v_rounded_up];
        }
        return $v_return;        
    }
    
    
    public function getServiceTypes () {
        try {
            require("/dbConn.php");
        } catch (Exception $exc) {
            echo "Error occurred connecting to db<br />";
            print_r($exc);
            die();
        }       
        $v_sqlstring = "SELECT * FROM gacstp ORDER BY svc_code";
        $v_rs = $db->doQuery($v_sqlstring) or die(print_r(sqlsrv_errors()));
        $v_return_array = [];
        while ($v_row = $db->fetchArray($v_rs)) {
            $v_return_array[$v_row['svc_code']] = ["svc_desc" => $v_row['svc_desc'], 
                                                   "extend_date_yn" => $v_row['extend_date_yn']];
        }
        return $v_return_array;
    }
}
?>
