<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../php/admin.php';
    $mode = $_POST['mode'];
    $branch = 0;
    $cost = getCostCharges($branch);
    $branches = getBranches();
    $total = 0;

?>
<h2 class="lead font-weight-normal">Cost Charges</h2>
<!-- <select name="chbranch" id="chbranch" class="form-control w-50">
      <option value="0" selected>Choose Branch</option>
            <?php
                foreach($branches as $key=>$values){
                echo "<option value='".$values['branch_id']."'>".$values['branch_name']."</option>";
                }
            ?>
  </select>
<div class="float-right">
  <button class="btn btn-outline-info" onclick="loadCostChargesSpecific();">Load Filter</button>
</div> -->
<br><br>
<div id="costly">
<table id="empTable" class="table table-striped">
    <thead>
       <th>Product Code</th>
       <th>Product Name</th>
       <th>Product Cost</th>
       <th>Number of Charges</th>
       <th>Total Costs</th>
    </thead>
    <tbody>
        <?php
            if(!empty($cost)){
                foreach($cost as $row => $values){
                    echo "<tr>";
                        echo "<td>".$values['prod_code']."</td>";
                        echo "<td>".$values['prod_name']."</td>";
                        echo "<td> P ".number_format($values['prod_costprice'], 2)."</td>";
                        echo "<td>".$values['noofcharges']."</td>";
                        echo "<td> P ".number_format(($values['prod_costprice'] * $values['noofcharges']), 2)."</td>";
                    echo "</tr>";
                    $total += ($values['prod_costprice'] * $values['noofcharges']);
                }
            }else{
                echo "<tr><td colspan='4'>No Sales</td></tr>";
            }
           
            
        ?>
    </tbody>

</table>
<div class="container ml-auto">
    <p class="text-right font-weight-bold">GRAND TOTAL P <?php echo number_format($total, 2) ?></p>
</div>
<button onclick='loadCharges();' class="btn btn-outline-danger my-0 my-lg-0">Back</button>
</div>
<script src="js/date.js"></script>