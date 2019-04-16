<?php
    session_start();
    include_once '../php/admin.php';
    //$userid = $_SESSION['id'];

    //$emps = listEmployees($userid);
    $prods = getProducts();

    if($prods){
        echo "";
    }else{
        echo "No Employees Yet!";
    }

?>
<h2 class="lead font-weight-normal">Product Table</h2>
<div class="line"></div>
<button class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</button>
<br>
<br>
<table id="empTable" class="table table-striped">
    <thead>
        <th>Image</th>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Product Description</th>
        <th colspan="2">Actions</th>
    </thead>
    <tbody>
        <?php
            foreach($prods as $row => $values){
                echo "<tr>";
                    echo "<td><img src = '".$values['prod_img']."' width='100' height='90' class='rounded mx-auto d-block' /></td>";
                    echo "<td>".$values['prod_code']."</td>";
                    echo "<td>".$values['prod_name']."</td>";
                    echo "<td> P ".number_format($values['prod_priceprunit'], 2)."</td>";
                    echo "<td>".$values['prod_desc']."</td>";
                    echo "<td><a href='edit.php?id=".$values['prod_id']."' role='button' class='btn btn-warning'><i class='far fa-edit'</i></a></td>";
                    echo "<td><a href='delete.php?id=".$values['prod_id']."' role='button' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                echo "</tr>";
            }
            
        ?>
    </tbody>
</table>