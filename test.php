<?php 
session_start();
require_once './config/config.php';

@header("Content-Disposition: attachment; filename=mysql_to_excel.csv");

$db = getDbInstance();

$customers = $db->get("et_customers");

foreach ($customers as $row) {
  $data.= htmlspecialchars($row['f_name']." ".$row['l_name']);
  $data.= htmlspecialchars($row['phone']);
  $data.= "|";
}  

echo $data;
exit();