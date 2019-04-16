<?php

    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../../php/admin.php';

    $branch = $_POST['branch'];

    $filter = getEmpCharges($branch);
    if(!empty($filter)){
        foreach($filter as $row => $values){
            echo "<tr>";
                echo "<td>".$values['emp_firstname']." ".$values['emp_lastname']."</td>";
                echo "<td> P ".number_format($values['grandtotal'], 2)."</td>";
            echo "</tr>";
        }
    }else{
        echo "<tr><td colspan='9'>No Result Found</td></tr>";
    }
   
?>