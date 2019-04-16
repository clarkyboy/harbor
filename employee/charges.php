<?php
    session_start();
    include_once 'php/employee.php';
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    if($_SESSION['logstat']!= "Active" || $_SESSION['emptype'] !='E'){header('Location: ../index.php');}
    $products = getProducts();
    $branches = getBranches();
    $user = $_SESSION['id'];
    if(isset($_POST['submit'])){
        $arr = $_POST['image'];
        $str = "";
        $totalprice = $_POST['totals'];
        $branch = $_POST['branches'];
        $id="";
        $counter = count($arr);

        $date = date('Y-m-d');

        if(!empty($branch)){
            for($j=0; $j<$counter; $j++){
                $str .= $arr[$j].",";
            }
            $checker = checkChargeDate($date, $branch, $user);
            $branchs = checkBranch($checker['charges_id']);
            if(!empty($checker) AND $branchs['branch_id'] == $branch){
                //you can only update if date and branch is the same
                updateCharges($checker['charges_id'], $branchs['branch_id'], $totalprice);
            }else{
                $charges_id = addCharges($user, $branch, $totalprice, $date);
            }
            
            for($i=0; $i<$counter; $i++){
                $prodqk = "prodq-".$arr[$i];
                $totalk = "total-".$arr[$i];
                $price = getProductPrice($arr[$i]);
                
    
                $total = $_POST[$totalk];
                $quantity = $_POST[$prodqk];
    
                // $totalprice += $total;
                if(!empty($checker) AND $branchs['branch_id'] == $branch){
                    addChargesDetails($checker['charges_id'], $arr[$i], $quantity, $price['prod_priceprunit'], $total, $date);
                }else{
                    addChargesDetails($charges_id, $arr[$i], $quantity, $price['prod_priceprunit'], $total, $date);
                }
                
            }
            header('Location: charges_details.php');
        }else{
            header('Location:'. $_SERVER['REQUEST_URI']);
        }
       
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'link.php';?>
    <title>Charges</title>
    <style>
        *{
            box-sizing: border-box;
        }
        
    </style>
</head>
<body>
    <?php require_once 'nav.php';?>
    <div class="container-fluid bgcolor p-3 divs" style="overflow-x: auto;">
            <h1 class="display-4 text-dark">Choose Product:</h1>
           <h4>Please follow the left-right sequence of entering the product and quantity</h4>
            <div id="loader"></div>
            <form method="post">
                <br>
                <div class="form-group">
                    <label for="branches" class="font-weight-bolder">Select a Branch</label>
                    <select name="branches" id="branches" class="form-control">
                        <option value="">----</option>
                        <?php
                            foreach($branches as $key => $value){
                                echo '<option value="'.$value['branch_id'].'">'.$value['branch_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <?php if(!empty($products)){
                      foreach($products as $key=>$value){?>
                            <div class="col-xs-4 col-sm-3 col-md-2 nopad text-center m-5">
                                <label class="image-checkbox">
                                    <img class="img-responsive rounded zoom" src="<?php echo $value["prod_img"];?>" width="200" height="150"/>
                                    <input type="checkbox" name="image[]"  value="<?php echo $value["prod_id"];?>" />
                                    <i class="fa fa-check hidden"></i>
                                </label>
                                <h5><?php echo $value["prod_name"];?></h5>
                                <h5><?php echo "P".$value["prod_priceprunit"];?></h5>
                                <div id="price-<?php echo $value["prod_id"];?>" class="hidden"><?php echo $value["prod_priceprunit"];?></div>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" name="prodq-<?php echo $value["prod_id"];?>" min="1" id="prodq-<?php echo $value["prod_id"];?>" onblur="total(); getTotal();" placeholder="Quantity"  maxlength="4" size="4" class="hidden form-control">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="total-<?php echo $value["prod_id"];?>" id="total-<?php echo $value["prod_id"];?>" class="hidden form-control" placeholder="Total" readonly>
                                    </div>
                                </div>
                                
                                
                            </div>
                <?php }}else{ ?>
                    <h1 class="display-4 text-white">No Products Available</h1>
                <?php }?>
                <div class="form-group text-center p-3">
                    <label for="totals" name="total" id="total" class="display-4 font-weight-bold"></label>
                    <input type="hidden" name="totals" id="totals">
                </div>
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary float-right absolute-right" type="submit" name="submit" id="next" onclick="checkEmpty();" disabled="true">Submit</button>
                    </div>
                    <div class="col-6">
                    <button  class="btn btn-danger" onclick="clear();" id="clear" >Clear</button>
                    </div>
                </div>
                
            </form>
    </div>
    <?php require_once 'footer.php';?>
</body>
<script src="js/script.js"></script>
</html>