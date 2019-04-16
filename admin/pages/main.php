<?php
    include_once '../php/admin.php';
    $date = date('Y-m-d');
    $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
    $friday = date( 'Y-m-d', strtotime( 'friday this week' ) );
    

    $countToday = salesCount($date);
    $countWeek = salesCountWk($monday, $friday);
    $best = bestSeller($monday, $friday);
    $mode = $_POST['mode'];
    if(isset($mode)){
        echo "";
    }
    else{
        echo "<h1 class='display-4'>Failed to Load Page</h1>";
    }
?>
<h3 class="lead">Quick Reports</h3>
<div class="row">
    <div class="col-4">
        <div class="bg-primary text-center text-white rounded" style="width: 300px; height: 200px; padding: 40px; margin:10px;">
            <h4>Daily Sales</h4>
            <h5><?php echo "P ".number_format($countToday['salesToday'], 2);?></h5>
            <!-- <button class="btn btn-outline-light text-white">view</button> -->
            <a href="#" role="button" class="btn btn-outline-light">View</a>
        </div>
    </div>
    <div class="col-4">
        <div class="bg-success text-center text-white rounded" style="width: 300px; height: 200px; padding: 40px; margin:10px;">
            <h4>Weekly Sales</h4>
            <h5><?php echo "P ".number_format($countWeek['salesThisWeek'], 2);?></h5>
            <!-- <button class="btn btn-outline-light text-white">view</button> -->
            <a href="#" role="button" class="btn btn-outline-light">View</a>
        </div>
    </div>
    <div class="col-4">
        <div class="bg-danger text-center text-white rounded" style="width: 300px; height: 200px; padding: 40px; margin:10px;">
            <h4>Weekly Best Seller</h4>
            <h5><?php echo $best['prod_name']." ~ P ".number_format($best['sales'], 2);;?></h5>
            <!-- <button class="btn btn-outline-light text-white">view</button> -->
            <a href="#" role="button" class="btn btn-outline-light">View</a>
        </div>
    </div>
    
</div>