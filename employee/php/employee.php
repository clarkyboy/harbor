<?php
    include 'connection.php';
   
    function getProducts(){
        $conn = connection();
        $sql = "SELECT * FROM products WHERE `prod_status` = 'A'";
        $result = $conn->query($sql);

        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    function getProductPrice($id){
        $conn = connection();
        $sql = "SELECT prod_priceprunit FROM products WHERE `prod_status` = 'A' AND `prod_id` = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function getBranch($userid){
        $conn = connection();
        $sql = "SELECT DISTINCT branch_id FROM `charges` WHERE  `emp_id` = '$userid'";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
         }
        return $rows;
    }
    function addChargesDetails($user, $prod, $quantity, $price, $total, $date){
        $conn = connection();
        $sql = "INSERT INTO charges_details (`charges_id`, `prod_id`, `quantity`, `price_saved`, `total`, `cd_status`, `date_transacted`) VALUES ('$user', '$prod', '$quantity', '$price', '$total', 'P', '$date')";
        $result = $conn->query($sql);
    }
    function addCharges($user, $branch, $totalprice, $date){
        $conn = connection();
        $sql = "INSERT INTO charges (`emp_id`, `branch_id`, `total_charge`, `charges_date`, `charge_status`) VALUES ('$user', '$branch', '$totalprice', '$date', 'P')";
        $result = $conn->query($sql);
        $last_id = $conn->insert_id;
        return $last_id;
    }
    function getDetails($userid, $branch, $start, $end){

        $conn = connection();
        $sql = "SELECT * FROM `charges` INNER JOIN `charges_details` ON `charges`.`charges_id` = `charges_details`.`charges_id` INNER JOIN `branch` ON `charges`.`branch_id` = `branch`.`branch_id` INNER JOIN `products` ON `charges_details`.`prod_id` = `products`.`prod_id` WHERE charges.emp_id = '$userid' AND `charges`.`branch_id` = '$branch' AND `charges`.`charges_date` BETWEEN '$start'  AND '$end' ORDER BY `charges`.`charges_id`, `charges`.`branch_id`";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
         }
        return $rows;
    }
    function getDetailSpecific($userid, $branch, $date){

        $conn = connection();
        $sql = "SELECT * FROM charges INNER JOIN branch ON charges.branch_id = branch.branch_id  WHERE emp_id = '$userid' and `charges`.branch_id = '$branch' and charges_date = '$date'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function getChargesDetails($charges_id, $date){
        $conn = connection();
        $sql = "SELECT * FROM `charges_details` INNER JOIN `products` ON `charges_details`.`prod_id` = `products`.`prod_id` WHERE `charges_details`.`charges_id` = '$charges_id' AND `charges_details`.`date_transacted` = '$date'";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
         }
        return $rows;
    }

    function checkChargeDate($date, $branch, $emp_id){
        $conn = connection();
        $sql = "SELECT  `charges_id` FROM charges WHERE `charges_date` = '$date' AND branch_id = '$branch' AND `emp_id` = '$emp_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function checkBranch($charges_id){
        $conn = connection();
        $sql = "SELECT `branch_id` FROM charges WHERE charges_id ='$charges_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function updateCharges($charges_id, $branch, $newtotal){
        $conn = connection();
        $sql = "UPDATE `charges` SET total_charge = total_charge + '$newtotal' WHERE charges_id = '$charges_id' AND branch_id = '$branch'";
        $result = $conn->query($sql);
    }

    function getBranches(){
        $conn = connection();
        $sql = "SELECT * FROM branch WHERE branch_id != '1'";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
         }
        return $rows;
    }

    function getMessage($userid, $name, $message, $email, $date){
        $conn = connection();
        $sql = "INSERT INTO `message` (`emp_id`, `name`, `email`, `message`, `date_sent`, `m_status`) VALUES ('$userid', '$name', '$email', '$message', '$date', 'P')";
        $result = $conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

?>