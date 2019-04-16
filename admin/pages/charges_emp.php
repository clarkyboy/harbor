<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../php/admin.php';

    $id = $_SESSION['id'];
    $branch = 0;
    $charges = getEmpCharges($branch);

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
    <div class="col-4">
        <select name="chbranch" id="chbranch" class="form-control">
            <option value="0" selected>All Branch</option>
            <?php
                foreach($branches as $key=>$values){
                echo "<option value='".$values['branch_id']."'>".$values['branch_name']."</option>";
                }
            ?>
        </select>
    </div>
    <!-- <div class="col-6">
        <select name="chbranch" id="chemp" class="form-control">
            <option value="0" selected>Choose Employee</option>
            <?php
                foreach($employees as $key=>$values){
                echo "<option value='".$values['emp_id']."'>".$values['emp_firstname']." ".$values['emp_lastname']."</option>";
                }
            ?>
        </select>
    </div> -->
    <!-- <div class="col-6">
        <div id="reportrange" class="text-center form-control" style="background: #fff; cursor: pointer; border: 1px solid #ccc;">
            <i class="fa fa-calendar"></i>&nbsp;
            <span id="date"></span> <i class="fa fa-caret-down"></i>
            <input type="hidden" id="dates">
        </div>
    </div> -->
    <!-- <div class="col-4"></div> -->
</div>
<br><br>
<div class="float-right">
  <button class="btn btn-outline-info" onclick="loadChargesSpecificEmp();">Load Filters</button>
</div>
<br><br>
<table id="empTable" class="table table-striped">
    <thead>
        <th>Employee Name</th>
        <th>Grand Total</th>
    </thead>
    <tbody id = "charges">
        <?php
            foreach($charges as $row => $values){
                echo "<tr>";
                    echo "<td>".$values['emp_firstname']." ".$values['emp_lastname']."</td>";
                    echo "<td> P ".number_format($values['grandtotal'], 2)."</td>";
                echo "</tr>";
            }
            
        ?>
    </tbody>
</table>
<script src="js/date.js"></script>