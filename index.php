<?php   
    session_start();
    include_once 'login.php';
    $message = null;
    $class = "hidden";
    $url = null;
    if(isset($_SESSION['url'])){
        $url = $_SESSION['url'];
        header('Location:'.$url);
    }
    
    
    if(isset($_POST['login'])){

        $user = trim($_POST['username']);
        $pass = md5(trim($_POST['userpass']));
        $credentials = login($user, $pass);

        if(!empty($credentials)){
            if($credentials['emp_status'] == 'I'){
                $message = "User not activated!";
            }
            if($credentials['emp_type'] == 'M'){
    
                $_SESSION['id'] = $credentials['emp_id'];
                $_SESSION['name'] = $credentials['emp_firstname'];
                $_SESSION['emptype'] = $credentials['emp_type'];
                $_SESSION['logstat'] = "Active";
    
                header('Location: admin/home.php');
            }else{
    
                $_SESSION['id'] = $credentials['emp_id'];
                $_SESSION['name'] = $credentials['emp_firstname'];
                $_SESSION['emptype'] = $credentials['emp_type'];
                $_SESSION['logstat'] = "Active";
    
                header('Location: employee/home.php');
            }
    
        }else{
            $message = "User not found!";
            $class = "alert alert-danger";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Charges Management</title>
</head>
<body>
    <div class="bg-image"></div>
	<div class="bg-text">
        <div id="message" class="<?php echo $class;?>">
            <?php echo $message;?>
        </div>
        <img src="images/logo.jpg" alt="" width="100" height="100" class="rounded-circle mx-auto d-block img-thumbnail mb-3">
        <h3 class="text-center">Charges Management</h3>
            <form method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" onblur="checkEmpty();" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="userpass" id="userpass" onblur="checkEmpty();" class="form-control" required>
                    </div>
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                    <!-- <button class="btn btn-primary" onclick="login();">Login</button> -->
                </form>
        <footer class="text-center">Copyright &copy; Harbour City 2019</footer>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  
</html>