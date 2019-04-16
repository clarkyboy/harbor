<?php
    session_start();
    include_once '../php/admin.php';
    $userid = $_SESSION['id'];

    $emps = listEmployees($userid);

    if($emps){
        echo "";
    }else{
        echo "No Employees Yet!";
    }

?>
<h2 class="lead font-weight-normal">Employee Table</h2>
<div class="line"></div>
<button class="btn btn-primary"><i class="fas fa-plus"></i> Add Employee</button>
<br>
<br>
<table id="empTable" class="table table-striped">
    <thead>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>Branch Assigned</th>
        <th>Position</th>
        <th>Employment Status</th>
        <th colspan="2">Actions</th>
    </thead>
    <tbody>
        <?php
            foreach($emps as $row => $values){
                echo "<tr>";
                    echo "<td>".$values['emp_firstname']."</td>";
                    echo "<td>".$values['emp_lastname']."</td>";
                    echo "<td>".$values['emp_address']."</td>";
                    echo "<td>".$values['branch_name']."</td>";
                    if($values['emp_type'] == 'M'){
                        echo "<td> Manager </td>";
                    }elseif($values['emp_type'] == 'C'){
                        echo "<td> Cashier </td>";
                    }else{
                        echo "<td> Regular Employee </td>";
                    }

                    if($values['emp_status'] == 'A'){
                        echo "<td> Active </td>";
                    }else{
                        echo "<td> Separated </td>";
                    }
                    echo "<td><a href='edit.php?id=".$values['emp_id']."' role='button' class='btn btn-warning'><i class='far fa-edit'</i></a></td>";
                    echo "<td><a href='delete.php?id=".$values['emp_id']."' role='button' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                echo "</tr>";
            }
            
        ?>
    </tbody>
</table>