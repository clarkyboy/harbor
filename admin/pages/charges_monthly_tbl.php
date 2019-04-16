<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../php/admin.php';
    $mode = $_POST['mode'];
    $start = date('Y-m-01');
    $end = date('Y-m-t');
    $charges = getChargesByMonth($start, $end);
    $total = getTotal($start, $end);

    if($mode){
        echo "";
    }else{
        echo "No Charges made!";
    }

?>
<h2 class="lead font-weight-normal">Monthly Charges</h2>

<div id="reportrange" class="text-center w-50 form-control" style="background: #fff; cursor: pointer; border: 1px solid #ccc;">
    <i class="fa fa-calendar"></i>&nbsp;
    <span id="date"></span> <i class="fa fa-caret-down"></i>
    <input type="hidden" id="dates">
</div>
<div class="float-right">
  <button class="btn btn-outline-info" onclick="loadMonthlyChargesSpecific();">Load Filter</button>
</div>
<br><br>
<div id="monthly">
<table id="empTable" class="table table-striped">
    <thead>
       <th>Product Code</th>
       <th>Product Name</th>
       <th>Total Quantity</th>
       <th>Total Sales</th>
    </thead>
    <tbody>
        <?php
            foreach($charges as $row => $values){
                echo "<tr>";
                    echo "<td>".$values['prod_code']."</td>";
                    echo "<td>".$values['prod_name']."</td>";
                    echo "<td>".$values['salesqty']."</td>";
                    echo "<td> P ".number_format($values['total'], 2)."</td>";
                echo "</tr>";
            }
            
        ?>
    </tbody>

</table>
<div class="container ml-auto">
    <p class="text-right font-weight-bold">GRAND TOTAL P <?php echo number_format($total['grand_total'], 2) ?></p>
</div>
<button onclick='loadCharges();' class="btn btn-outline-danger my-0 my-lg-0">Back</button>
</div>
<script src="js/date.js"></script>