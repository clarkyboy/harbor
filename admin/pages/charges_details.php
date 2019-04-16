<?php
    session_start();
    include_once '../php/admin.php';
    $charges_id = $_POST['charges_id'];
    $charges = getChargesDetails($charges_id);
    $details = getChargesInfo($charges_id);
    if($charges){
        echo "";
    }else{
        echo "No Employees Yet!";
    }

?>
<h2 class="lead font-weight-normal">Details of Charges Ticket No. <?php echo $charges_id; ?></h2>
<div class="line"></div>
    <div class="row">
        <div class="col-6">
            <p class="lead font-weight-normal">
                Employee Id: <?php echo $details['emp_id']; ?> <br>
                Employee Name: <?php echo $details['emp_firstname']." ".$details['emp_lastname']; ?><br>
                Charge Type:
                <?php
                    $chtype = getChargesType($details['charge_type']);
                    echo $chtype['chtype_name'];
                ?>
            </p>
        </div>
        <div class="col-6">
            <p class="lead font-weight-normal">
                Transaction Date: <?php echo date('M d, Y', strtotime($details['charges_date']));?> <br>
                Branch: <?php echo $details['branch_name']; ?> <br>
                Status: 
                <?php 
                    if($details['charge_status'] == 'A'){
                        echo "Claimed";
                    }else{
                        echo "Pending";
                    }
                ?>
            </p>
        </div>
    </div>
<div class="line"></div>
<h5>Products</h5>
<table id="empTable" class="table table-striped">
    <thead>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price per Unit</th>
        <th>Total</th>
    </thead>
    <tbody>
        <?php
            foreach ($charges as $key => $value) {
                echo "<tr>";
                    echo "<td>".$value['prod_code']."</td>";
                    echo "<td>".$value['prod_name']."</td>";
                    echo "<td>".$value['quantity']."</td>";
                    echo "<td>".$value['prod_priceprunit']."</td>";
                    echo "<td>".$value['total']."</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
<br>
<div class="container">
    <label for="" class="font-weight-bold">Additional Notes</label>
    <p class="lead"><?php echo $details['notes']; ?></p>
</div>
<div class="container ml-auto">
    <p class="text-right font-weight-bold">GRAND TOTAL P <?php echo number_format($details['total_charge'], 2) ?></p>
</div>
<button onclick='loadCharges();' class="btn btn-outline-danger my-0 my-lg-0">Back</button>