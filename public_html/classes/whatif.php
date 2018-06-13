<?php
namespace grantsutils;
require_once 'calcutil.php';

/*
 * This code will be used to do the calculations to determine if someone can 
 * complate in time based on entered perde-meters.
 */
$v_calcutil = new calcutil();

$v_start_date = $_GET['x_start_date'];
$v_fte_ratio = $_GET['x_fte_ratio'];
$v_days_to_extend = $_GET['x_days_to_extend'];
$v_days_left = $_GET['x_days_left'];
//$v_calc_end_date = $_GET['x_calc_end_date'];
//$v_outer_limit = $_GET['x_outer_limit'];

/* Calculate the end date based on days left and the fte ratio.
 * Then add the days to extend and add all of this to the start date
 * 
 */
$v_days_consumed = (floatval($v_days_left) / floatval($v_fte_ratio)) + $v_days_to_extend;
$v_end_date = date_add(date_create($v_start_date), \DateInterval::createFromDateString(intval($v_days_consumed)." days"));
header('Content-type: application/json');
print_r(json_encode(["calc_end_date" => $v_end_date]));
?>