<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../php/admin.php';

    $id = $_SESSION['id'];

    $charges = getCharges();
    $branches = getBranches();
    $employees = listEmployees($id);
    if($charges){
        echo "";
    }else{
        echo "No Charges made!";
    }

?>
<h2 class="lead font-weight-normal">List of Charges</h2>
<div class="row">
    <div class="col-6">
        <select name="chbranch" id="chbranch" class="form-control">
            <option value="0" selected>All Branch</option>
            <?php
                foreach($branches as $key=>$values){
                echo "<option value='".$values['branch_id']."'>".$values['branch_name']."</option>";
                }
            ?>
        </select>
    </div>
    <!-- <div class="col-4">
        <select name="chbranch" id="chemp" class="form-control">
            <option value="0" selected>Choose Employee</option>
            <?php
                foreach($employees as $key=>$values){
                echo "<option value='".$values['emp_id']."'>".$values['emp_firstname']." ".$values['emp_lastname']."</option>";
                }
            ?>
        </select>
    </div> -->
    <div class="col-6">
        <div id="reportrange" class="text-center form-control" style="background: #fff; cursor: pointer; border: 1px solid #ccc;">
            <i class="fa fa-calendar"></i>&nbsp;
            <span id="date"></span> <i class="fa fa-caret-down"></i>
            <input type="hidden" id="dates">
        </div>
    </div>
    <!-- <div class="col-4"></div> -->
</div>
<br><br>
<div class="float-right">
  <button class="btn btn-outline-info" onclick="loadChargesSpecificBranch();">Load Filters</button>
</div>
<br><br>
<table id="empTable" class="table table-striped">
    <thead>
        <th>Employee Name</th>
        <th>Transaction Date</th>
        <th>Branch Involved</th>
        <th>Total Charges Made</th>
        <th>Notes from Employee</th>
        <th>Charge Type</th>
        <th>Approved By</th>
        <th>Charges Status</th>
        <th colspan="2">Actions</th>
    </thead>
    <tbody id = "charges">
        <?php
            foreach($charges as $row => $values){
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
            
        ?>
    </tbody>
</table>
<script src="js/date.js"></script>