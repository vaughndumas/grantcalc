<?php
$v_date = date_create(date('Y-m-d'));
print_r($v_date);
$v_diff = date_add($v_date, DateInterval::createFromDateString("1 day"));
print_r($v_diff);
echo "<br />Date formatted:".$v_date->format("Ymd");
?>
