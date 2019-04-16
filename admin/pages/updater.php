<?php
    session_start();
    include_once '../php/admin.php';
    $id = $_POST['id'];
    $mode = $_POST['mode'];
    $newstat = "";

   if($mode == 1){
     $newstat = "A";
     if(approve($_SESSION['id'], $id, $newstat) === "Success"){
          approveDetails($id, $newstat);
     }
   }else{
     $newstat = "P";
     if(disapprove($_SESSION['id'], $id, $newstat) === "Success"){
          disapproveDetails($id, $newstat);
     }
   }
  

?>