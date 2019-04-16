<?php
header('Content-Type: application/json');
include_once 'admin.php';
$monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
$friday = date( 'Y-m-d', strtotime( 'friday this week' ) );
$lineChart = forLineChart($monday, $friday);
$data = array();
foreach($lineChart as $row){
    $data[] = $row;
}
echo json_encode($data);
?>