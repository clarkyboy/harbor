<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    if($_SESSION['logstat']!= "Active" || $_SESSION['emptype'] !='E'){header('Location: ../index.php');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'link.php';?>
    <title>Charges Details</title>
    <style>
        *{
            box-sizing: border-box;
        }
        
    </style>
</head>
<body>
    <?php require_once 'nav.php';?>

    <div class="container-fluid bgcolor divs p-3" style="overflow-x: auto;">
            <div class="col-4">
                <h5 class="lead font-weight-normal">Display Charges Summary on:</h5>
                <div id="reportrange" class="text-center" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; display:inline-block">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span id="date"></span> <i class="fa fa-caret-down"></i>
                    <input type="hidden" id="dates">
                </div>
            </div><!--end of col-4-->
            <!-- <div class="container p-4" style="position: relative; top: 0; left: 0; height: 100%; width: 100%;"> -->
                <table class="table table-bordered table-striped mt-5">
                    <thead class="thead-dark">
                        <th>Product</th>
                        <th>Branch</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Total Price</th>
                        <th>Claim Status</th>
                        <th>Checked By</th>
                    </thead>
                    <tbody id="tbody">
                      
                    </tbody>
                </table>
            <!-- </div> -->
    </div>  

    <?php require_once 'footer.php';?>
</body>
<script src="js/charges.js"></script>
</html>