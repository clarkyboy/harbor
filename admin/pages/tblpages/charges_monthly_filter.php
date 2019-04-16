<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../../php/admin.php';
    $start = $_POST['start'];
    $end = $_POST['end'];
    $charges = getChargesByMonth($start, $end);
    $total = getTotal($start, $end);

?>


<table id="empTable" class="table table-striped">
    <thead>
       <th>Product Code</th>
       <th>Product Name</th>
       <th>Total Quantity</th>
       <th>Total Sales</th>
    </thead>
    <tbody>
        <?php
          if(!empty($charges)){
            foreach($charges as $row => $values){
                echo "<tr>";
                    echo "<td>".$values['prod_code']."</td>";
                    echo "<td>".$values['prod_name']."</td>";
                    echo "<td>".$values['salesqty']."</td>";
                    echo "<td> P ".number_format($values['total'], 2)."</td>";
                echo "</tr>";
            }
          }else{
              echo "<tr><td colspan='4'>No Sales</td></tr>";
          }
            
            
        ?>
    </tbody>

</table>
<div class="container ml-auto">
    <p class="text-right font-weight-bold">GRAND TOTAL P <?php echo number_format($total['grand_total'], 2) ?></p>
</div>
<button onclick='loadCharges();' class="btn btn-outline-danger my-0 my-lg-0">Back</button>