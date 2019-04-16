<?php
    session_start();
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    include_once 'php/employee.php';
    if($_SESSION['logstat']!= "Active" || $_SESSION['emptype'] !='E'){header('Location: ../index.php');}
    $userid = $_SESSION['id'];
    $date = $_GET['request'];
    $branch = $_GET['branch'];

    $details = getDetailSpecific($userid, $branch, $date);
    $charge_details = getChargesDetails($details['charges_id'], $date);
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

    <div class="container-fluid bgcolor p-3 divs" style="overflow-x: auto;">
        <h1 class="display-4 text-center">Welcome <?php echo $_SESSION['name'];?></h1>
        <p class="text-center lead">This is the official charges management for Harbour City Employees <br><small>Version 1.0.0</small></p>
        <h4 class="lead font-weight-bold text-center mt-5">
            <?php
                if($details['charge_status'] == 'P'){
                    echo "Here's your claim ticket. Please present this to Branch: ".$details['branch_name'];
                }else{
                    echo "Ticket already claimed. Can't print anymore";
                }
            ?>
        </h4>
        <div id="divtoprint" class="container-fluid text-center mt-5 p-3 border border-secondary bg-light" style="height:auto;">
            <h1 class="display-4 text-center">Ticket No: #<?php echo $details['charges_id'];?></h1>
            <div class="row p-5">
                <div class="col-3 lead">
                    Employee ID:
                    <br>
                    Employee Name:
                </div>
                <div class="col-9 lead font-weight-bold">
                    <?php echo "No. ".$_SESSION['id'];?>
                    <br>
                    <?php echo $_SESSION['name'];?>
                </div>
            </div>
                <h4 class="lead font-weight-bold">Details</h4>
                <table class="table table-borderless">
                        <thead>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price per Unit</th>
                            <th>Total</th>
                        </thead>
                        <tbody>
                        <?php
                            foreach($charge_details as $key => $value){
                                echo "<tr>";
                                    echo "<td>".$value['prod_name']."</td>";
                                    echo "<td>".$value['quantity']."</td>";
                                    echo "<td>".$value['prod_priceprunit']."</td>";
                                    echo "<td>".$value['total']."</td>";
                                echo "</tr>";
                            }
                        ?>
                        </tbody>
                </table>
                <p class="float-right lead font-weight-bold">Grand Total: P<?php echo $details['total_charge']; ?></p>
                <br>
                <div class="float-light">
                <?php
                    if($details['charge_status'] == 'P'){
                        echo "<button class='btn btn-danger' onclick='print();'>Print Ticket</button>";
                    }
                ?>
                </div>
                
        </div>
    </div>  

    <?php require_once 'footer.php';?>
</body>
<script src="print.js"></script>
</html>