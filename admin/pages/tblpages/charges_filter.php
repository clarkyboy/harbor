<?php

    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../../php/admin.php';

    $branch = $_POST['branch'];
    $emp = $_POST['emp'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $filter = getChargesFilter($branch, $emp, $start, $end);
    if(!empty($filter)){
        foreach($filter as $row => $values){
            echo "<tr>";
                echo "<td>".$values['emp_firstname']." ".$values['emp_lastname']."</td>";
                echo "<td>".date('M d, Y', strtotime($values['charges_date']))."</td>";
                echo "<td>".$values['branch_name']."</td>";
                echo "<td> P ".number_format($values['total_charge'], 2)."</td>";
                echo "<td>".$values['notes']."</td>";
                echo "<td>";
                    $chtype = getChargesType($values['charge_type']);
                    echo $chtype['chtype_name'];
                echo "</td>";
                if($values['approver_id'] == null){
                    echo "<td><button class='btn btn-success' onclick='updater(".$values['charges_id'].",1)'><i class='fas fa-check'></i> Approve</button></td>";
                }else{
                    $approver = getApprover($values['approver_id']);
                    echo "<td><small>".$approver['approver']."</small> <button class='btn btn-outline-danger' style='font-size:10px;' onclick='updater(".$values['charges_id'].",2)'><i class='fa fa-window-close'></i> Cancel</button></td>";
                }
                if($values['charge_status'] == 'A'){
                    echo "<td> Approved </td>";
                }else{
                    echo "<td> Pending </td>";
                }
                // echo "<td><a href='details.php?id=".$values['emp_id']."' role='button' class='btn btn-info'><i class='fas fa-arrow-right'></i> Details</a></td>";
                echo "<td><button class='btn btn-info' onclick='details(".$values['charges_id'].")'><i class='fas fa-arrow-right'></i> Details</button></td>";
            echo "</tr>";
        }
    }else{
        echo "<tr><td colspan='9'>No Result Found</td></tr>";
    }
   
?>