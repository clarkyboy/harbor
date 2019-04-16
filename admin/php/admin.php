<?php
    date_default_timezone_set("Asia/Manila");
    include 'connection.php';

    function forPieChart($date){
        $conn = connection();
        $sql = "SELECT SUM(`charges_details`.`total`) AS sales, `products`.`prod_name` as `name` FROM `charges_details` INNER JOIN products ON charges_details.prod_id = products.prod_id WHERE date_transacted = '$date' GROUP BY `products`.`prod_id`";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    function forLineChart($mon, $fri){
        $conn = connection();
        $sql = "SELECT SUM(`charges_details`.`total`) AS sales, `products`.`prod_name` as `name` FROM `charges_details` INNER JOIN products ON charges_details.prod_id = products.prod_id WHERE date_transacted BETWEEN '$mon' AND '$fri' GROUP BY `products`.`prod_id`";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    function salesCount($date){
        $conn = connection();
        $sql = "SELECT SUM(total_charge) as `salesToday` FROM `charges` WHERE charges_date = '$date'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function salesCountWk($mon, $fri){
        $conn = connection();
        $sql = "SELECT SUM(total_charge) as `salesThisWeek` FROM `charges` WHERE charges_date BETWEEN '$mon' AND '$fri'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function bestSeller($mon, $fri){
        $conn = connection();
        $sql = "SELECT SUM(`charges_details`.`total`) AS sales, `products`.`prod_name` FROM `charges_details` INNER JOIN products ON charges_details.prod_id = products.prod_id WHERE date_transacted BETWEEN '$mon' AND '$fri' GROUP BY `products`.`prod_id` ORDER BY sales DESC LIMIT 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function listEmployees($userid){
        $conn = connection();
        $sql = "SELECT * FROM employee INNER JOIN branch on employee.emp_branch = branch.branch_id WHERE employee.emp_id != '$userid'";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    function getCharges(){
        $conn = connection();
        $sql = "SELECT * FROM charges INNER JOIN employee ON charges.emp_id = employee.emp_id INNER JOIN branch ON charges.branch_id = branch.branch_id";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    function getCostCharges($branch){
        $conn = connection();
        if($branch == 0){
            $sql = "SELECT prod_id, prod_code, prod_name, prod_costprice, (SELECT COUNT(charges_details.prod_id) FROM charges_details JOIN charges ON charges_details.charges_id = charges.charges_id WHERE charges_details.prod_id = products.prod_id) AS noofcharges FROM products";
        }else{
            $sql = "SELECT prod_id, prod_code, prod_name, prod_costprice, (SELECT COUNT(charges_details.prod_id) FROM charges_details JOIN charges ON charges_details.charges_id = charges.charges_id WHERE charges.branch_id = '$branch' AND charges_details.prod_id = products.prod_id) AS noofcharges FROM products";
        }
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }


    function getChargesFilter($branch, $emp, $start, $end){
        $conn = connection();
        $sql = "SELECT * FROM charges INNER JOIN employee ON charges.emp_id = employee.emp_id INNER JOIN branch ON charges.branch_id = branch.branch_id WHERE charges.charges_date BETWEEN '$start' AND '$end'";
        if($branch != 0 && $emp != 0){
                $sql .= " AND charges.branch_id = '$branch' AND charges.emp_id = '$emp'";
        }elseif($emp != 0 && $branch == 0){
            $sql .= " AND charges.emp_id = '$emp'";
        }elseif($emp == 0 && $branch != 0){
            $sql .= " AND charges.branch_id = '$branch'";
        }else{
        }
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    function getEmpCharges($branch){
        $conn = connection();
        if($branch == 0){
            $sql = "SELECT employee.emp_firstname, employee.emp_lastname, SUM(charges.total_charge) as grandtotal FROM charges JOIN employee ON charges.emp_id = employee.emp_id JOIN branch ON charges.branch_id = branch.branch_id GROUP BY charges.emp_id";
        }else{
            $sql = "SELECT employee.emp_firstname, employee.emp_lastname, SUM(charges.total_charge) as grandtotal FROM charges JOIN employee ON charges.emp_id = employee.emp_id JOIN branch ON charges.branch_id = branch.branch_id WHERE charges.branch_id = '$branch' GROUP BY charges.emp_id";
        }
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    function getChargesByMonth($start, $end){
        $conn = connection();
        $sql = "SELECT products.prod_code, products.prod_name, SUM(charges_details.quantity) as salesqty, SUM(charges_details.total) as total FROM charges_details INNER JOIN products ON charges_details.prod_id = products.prod_id WHERE charges_details.date_transacted BETWEEN '$start' AND '$end' GROUP BY charges_details.prod_id";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }
    function getChargesType($id){
        $conn = connection();
        $sql = "SELECT * FROM charge_type WHERE chtype_id = '$id' AND chtype_status='A'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    function getTotal($start, $end){
        $conn = connection();
        $sql = "SELECT SUM(total) as grand_total FROM charges_details WHERE date_transacted BETWEEN '$start' AND '$end'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    function getBranches(){
        $conn = connection();
        $sql = "SELECT * FROM branch WHERE branch_id != 1 and branch_status = 'A'";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    function getApprover($userid){
        $conn = connection();
        $sql = "SELECT CONCAT(emp_firstname,' ', emp_lastname) as `approver` FROM employee WHERE emp_id = '$userid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function approve($userid, $id, $newstat){
        $conn = connection();
        $sql = "UPDATE charges SET approver_id = '$userid', charge_status ='$newstat' WHERE charges_id = '$id'";
        $result = $conn->query($sql);
        if($result){
           return "Success";
        }else{
            return "Failed";
        }
            
    }
    function approveDetails($id, $newstat){
        $conn = connection();
        $sql = "UPDATE charges_details SET cd_status = '$newstat' WHERE charges_id = '$id'";
        $result = $conn->query($sql);
    }
    function disapprove($userid, $id, $newstat){
        $conn = connection();
        $sql = "UPDATE charges SET approver_id = null, charge_status ='$newstat' WHERE charges_id = '$id'";
        $result = $conn->query($sql);
        if($result){
           return "Success";
        }else{
            return "Failed";
        }
            
    }
    function disapproveDetails($id, $newstat){
        $conn = connection();
        $sql = "UPDATE charges_details SET cd_status = '$newstat' WHERE charges_id = '$id'";
        $result = $conn->query($sql);
    }
    function getChargesInfo($charges_id){
        $conn = connection();
        $sql = "SELECT * FROM charges INNER JOIN branch ON charges.branch_id = branch.branch_id INNER JOIN employee ON charges.emp_id = employee.emp_id WHERE charges.charges_id = '$charges_id'";
        // echo $sql;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }
    function getChargesDetails($charges_id){
        $conn = connection();
        $sql = "SELECT * FROM `charges_details` INNER JOIN `products` ON `charges_details`.`prod_id` = `products`.`prod_id` WHERE `charges_details`.`charges_id` = '$charges_id'";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
         }
        return $rows;
    }
    function getProducts(){
        $conn = connection();
        $sql = "SELECT * FROM `products`";
        $result = $conn->query($sql);
        $rows = [];
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
         }
        return $rows;
    }
?>