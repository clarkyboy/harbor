<?php
    session_start();
    include_once 'php/employee.php';
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    if($_SESSION['logstat']!= "Active" || $_SESSION['emptype'] !='E'){header('Location: ../index.php');}

    $start = $_POST['start'];
    $end = $_POST['end'];
    $userid = $_SESSION['id'];

    $branch_id = getBranch($userid);
    

    foreach($branch_id as $key=>$id){
        $product = getDetails($userid, $id['branch_id'], $start, $end);
        $lastgroupheader = ""; $lastcharges_id = ""; $msg = ""; $last_branch = "";
        if(!empty($product)){
            foreach($product as $key=>$value){
                if($lastgroupheader != $value['date_transacted'] || $last_branch != $value['branch_id']){
                    $lastcharges_id = $value['charges_id'];
                    if($value['charge_status'] == 'P'){
                        $msg = "Print Claim Ticket";
                    }else{
                        $msq = "View Details";
                    }
                    echo "<tr>";
                        echo "<td class='bg-secondary text-white' colspan='7'>Date: ".
                            date('M d, Y', strtotime($value['date_transacted']))." | Branch: ".$value['branch_name'].
                            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='charges_details_ticket.php?request=".$value['charges_date']."&branch=".$value['branch_id']."' class='text-warning'>".$msg."</a>".
                            "<p class='float-right font-weight-bold'>Total Charges: P".
                            $value['total_charge'].
                        "</td>";
                    echo "</tr>";
                    $lastgroupheader = $value['date_transacted'];
                    $last_branch = $value['branch_id'];
                    
                }
                echo "<tr>";
                    echo "<td><figure><img src='".$value['prod_img']."' width='100' height='90' class='rounded mx-auto d-block'><figcaption class='text-center'>".$value['prod_name']."</figcaption></figure></td>";
                    echo "<td>".$value['branch_name']."</td>";
                    echo "<td>".$value['quantity']." pcs. </td>";
                    echo "<td> P".$value['price_saved']."</td>";
                    echo "<td> P".$value['total']."</td>";
                    if($value['cd_status'] == 'P'){
                        echo "<td>Unclaimed</td>";
                        echo "<td></td>";
                    }
                    else{
                        echo "<td>Claimed</td>";
                        echo "<td></td>";
                    }
                echo "</tr>";
    
                // if($lastcharges_id != $value['charges_id']){
                //     echo "<tr>";
                       
                //     echo "</tr>";
                //     $lastcharges_id = $value['charges_id'];
                // }
            }
        }
    }



    


?>