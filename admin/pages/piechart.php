<?php
header('Content-Type: application/json');
include_once '../php/admin.php';
$date = date('Y-m-d');

$pieChart = forPieChart($date);
$data = array();
foreach($pieChart as $row){
    $data[] = $row;
}
echo json_encode($data);
?>