<?php
    date_default_timezone_set("Asia/Manila");
    session_start();
    include_once '../../php/admin.php';
    $branch = $_POST['branch'];
    $cost = getCostCharges($branch);

?>
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
                    if($values['noofcharges'] != 0){
                        echo "<tr>";
                            echo "<td>".$values['prod_code']."</td>";
                            echo "<td>".$values['prod_name']."</td>";
                            echo "<td> P ".number_format($values['prod_costprice'], 2)."</td>";
                            echo "<td>".$values['noofcharges']."</td>";
                            echo "<td> P ".number_format(($values['prod_costprice'] * $values['noofcharges']), 2)."</td>";
                        echo "</tr>";
                    }
                   
                }
            }else{
                echo "<tr><td colspan='4'>No Sales</td></tr>";
            }
           
            
        ?>
    </tbody>

</table>
<!-- <div class="container ml-auto">
    <p class="text-right font-weight-bold">GRAND TOTAL P <?php echo number_format($total['grand_total'], 2) ?></p>
</div> -->
<button onclick='loadCharges();' class="btn btn-outline-danger my-0 my-lg-0">Back</button>