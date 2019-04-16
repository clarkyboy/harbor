<?php

    //$pass = "gabriel@harbor123"; // for Gab
    //$pass = "jdoe@harbor123"; // for Jane
    // $pass = "jhdoe@harbor123"; // for John
    $pass = "B@rral$7294";
    $newpass = md5($pass);
    echo $newpass;

?>

<script>
    // // $(document).ready(function(){
    // //     checkEmpty();
    // // });
    function checkEmpty(){
        var username = document.getElementById('username').value;
        var password = document.getElementById('userpass').value;
        var arr = [];
        var message = "";

        if(username == null || username == NaN || username == ''){
            arr.push("Username field is empty <br>");
           $('#username').css('border:red');
           //document.getElementById('username').style.borderColor='red';
        }
        if(password== null || password == NaN || password ==''){
            arr.push("Password field is empty");
            $('#password').css('border:red');
            //document.getElementById('password').style.borderColor='red';
        }

        for(var i =0; i<arr.length; i++){
           message += arr[i] + '<br>';
        }
        if(message != null || message != NaN){
            document.getElementById('message').innerHTML = message;
            $('#message').dialog();
        }else{
            $('#message').dialog('close');
        }
        
       
    };

    // function login(){
    //    var username = $('#username').val();
    //    var userpass = $('#userpass').val();
    //     $.ajax({
    //         type: "POST",
    //         url: "login.php",
    //         data: {username, userpass},
    //         success: function (data) {
    //             data.split("|");
    //             if(data[0] == '1'){
    //                 $('#message').html(data[2]);
    //             }else{
    //                 $('#message').html(data[1]);
    //             }
    //             $('#message').dialog();
    //         }
    //     });
    // }
</script>