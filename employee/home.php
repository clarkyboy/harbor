<?php
    session_start();
    $message = null;
    $class = "hidden";
    if($_SESSION['logstat']!= "Active" || $_SESSION['emptype'] != 'E'){header('Location: ../index.php');}
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    include_once 'php/employee.php';
    if(isset($_POST['send'])){
        $date = date('Y-m-d');
        $name = $_POST['name'];
        $userid = $_SESSION['id'];
        $message = $_POST['message'];
        $email = $_POST['email'];
        $result = getMessage($userid, $name, $message, $email, $date);
        if($result == true){
            $message = "Message Sent to the administrator";
            $class = "alert alert-success alert-dismissible fade show";
        }else{
            $message = "ERROR! Please try again!";
            $class = "alert alert-danger alert-dismissible fade show";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'link.php';?>
    <title>Employee Home</title>
</head>
<body>
    <?php require_once 'nav.php';?>
   
    <div  class="container-fluid bgcolor p-5 ">
        <div class="<?php echo $class; ?>" role="alert">
            <strong><?php echo $message;?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <h1 class="display-4 text-center">Welcome <?php echo $_SESSION['name'];?></h1>
        <p class="text-center lead">This is the official charges management for Harbour City Employees <br><small>Version 1.0.0</small></p>
        <h4 class="lead font-weight-bold">How to use this site</h4>
        <div class="row bg-light p-5 h-100 rounded border">
            <div class="col-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Introduction</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">How to add Charges</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">How to view Charges in Charges Summary</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Contact the Web Master</a>
                </div>
            </div>
            <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <h3 class="lead font-weight-normal text-center">Pages Summary</h3>
                    <div class="row">
                        <div class="col-2"><p class="lead font-weight-bold">Charges</p></div>
                        <div class="col-10">
                            <p class="lead text-justify float-right">
                                This Page will let you choose what product you want to order and it will be saved in the database
                                once it is approved
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2"><p class="lead font-weight-bold">Charges Summary</p></div>
                        <div class="col-10">
                            <p class="lead text-justify float-right">
                                This page will display the summary of all your charges reflected to the specific date of the month.
                                You can change the dates if you want.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <h3 class="lead font-weight-normal text-center">How to add Charges</h3>

                    <div class="row">
                        <div class="col-4">
                            <p>
                                 <figure>
                                    <img src="../images/steps/3.png" width="200" height="200" alt="" class="rounded mx-auto d-block">
                                    <figcaption class="lead font-weight-bold text-center">Step 1</figcaption>
                                 </figure>
                            </p>
                        </div>
                        <div class="col-8">
                            <p></p>
                            <p class="lead text-justify float-right">
                               Choose a branch first. You can only transact 1 Branch every day.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <p>
                                 <figure>
                                    <img src="../images/steps/1.png" width="180" height="200" alt="" class="rounded mx-auto d-block">
                                    <figcaption class="lead font-weight-bold text-center">Step 2</figcaption>
                                 </figure>
                            </p>
                        </div>
                        <div class="col-8">
                            <p></p>
                            <p class="lead text-justify float-right">
                                Click First on the chosen item. A textbox will appear that will ask how much do you want for this product.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p>
                                 <figure>
                                    <img src="../images/steps/2.png" width="180" height="200" alt="" class="rounded mx-auto d-block">
                                    <figcaption class="lead font-weight-bold text-center">Step 3</figcaption>
                                 </figure>
                            </p>
                        </div>
                        <div class="col-8">
                            <p></p>
                            <p class="lead text-justify float-right">
                               Enter the desired quantity and the total will automatically appear. Take note that you should enter before you proceed to another product
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <p>
                                 <figure>
                                    <img src="../images/steps/3.png" width="300" height="200" alt="" class="rounded mx-auto d-block">
                                    <figcaption class="lead font-weight-bold text-center">Step 4</figcaption>
                                 </figure>
                            </p>
                        </div>
                        <div class="col-8">
                            <p></p>
                            <p class="lead text-justify float-right">
                               Repeat Steps 2 and 3. Take note that you should enter before you proceed to another product
                            </p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-4">
                            <p>
                                 <figure>
                                    <img src="../images/steps/5.png" width="300" height="200" alt="" class="rounded mx-auto d-block">
                                    <figcaption class="lead font-weight-bold text-center">Step 5</figcaption>
                                 </figure>
                            </p>
                        </div>
                        <div class="col-8">
                            <p></p>
                            <p class="lead text-justify float-right">
                               Repeat Steps 1 and 2. Take note that you should enter before you proceed to another product
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <p>
                                 <figure>
                                    <img src="../images/steps/4.png" width="300" height="200" alt="" class="rounded mx-auto d-block">
                                    <figcaption class="lead font-weight-bold text-center">Step </figcaption>
                                 </figure>
                            </p>
                        </div>
                        <div class="col-8">
                            <p></p>
                            <p class="lead text-justify float-right">
                               Once you are done choosing products with their quantities, please check the total and click submit. If you are not satisfied, please click reset
                            </p>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <h3 class="lead font-weight-normal text-center">How to view Charges in Charges Summary</h3>
                        <div class="row">
                                <div class="col-5">
                                    <p>
                                        <figure>
                                            <img src="../images/steps/cs1.png" width="300" height="200" alt="" class="rounded mx-auto d-block">
                                            <figcaption class="lead font-weight-bold text-center">Date Range Picker</figcaption>
                                        </figure>
                                    </p>
                                </div>
                                <div class="col-7">
                                    <p></p>
                                    <p class="lead text-justify float-right">
                                    You can check your date of charges summary by clicking this dropdown here.
                                    </p>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-5">
                                    <p>
                                        <figure>
                                            <img src="../images/steps/cs2.png" width="300" height="200" alt="" class="rounded mx-auto d-block">
                                            <figcaption class="lead font-weight-bold text-center">Date Range Picker Content</figcaption>
                                        </figure>
                                    </p>
                                </div>
                                <div class="col-7">
                                    <p></p>
                                    <p class="lead text-justify ml-3">You can choose the following</p>
                                    <dl class="lead text-justify ml-3">
                                    
                                            <dt>Today</dt>
                                            <dd>If you want to display reports for today</dd>

                                            <dt>Yesterday</dt>
                                            <dd>If you want to dsplay reports for yesterday</dd>

                                            <dt>Last 30 days</dt>
                                            <dd>If you want to retrieve reports from the last 30 days</dd>

                                            <dt>This Month</dt>
                                            <dd>If you want to retrieve reports from the this month</dd>

                                            <dt>Last Month</dt>
                                            <dd>If you want to retrieve reports from the last month</dd>

                                            <dt>Custom Range</dt>
                                            <dd>If you want to retrieve reports from the customized date range</dd>
                                    </dl>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-5">
                                    <p>
                                        <figure>
                                            <img src="../images/steps/cs3.png" width="300" height="200" alt="" class="rounded mx-auto d-block">
                                            <figcaption class="lead font-weight-bold text-center">Reports Grouped By Date</figcaption>
                                        </figure>
                                    </p>
                                </div>
                                <div class="col-7">
                                    <p></p>
                                    <p class="lead text-justify float-right">
                                        The Reports being displayed are grouped by date to easy separate the charges by date.
                                    </p>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-5">
                                    <p>
                                        <figure>
                                            <img src="../images/steps/cs4.png" width="300" height="200" alt="" class="rounded mx-auto d-block">
                                            <figcaption class="lead font-weight-bold text-center">Total Showed at the right side</figcaption>
                                        </figure>
                                    </p>
                                </div>
                                <div class="col-7">
                                    <p></p>
                                    <p class="lead text-justify float-right">
                                        The Reports also has the total charges showned at the right side.
                                    </p>
                                </div>
                        </div>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <h3 class="lead font-weight-normal text-center">Contact Us</h3>
                    <p class="lead text-center">We would like to hear from you!</p>
                    <div class="container align-center">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <input type="submit" value="Send" name="send" class="btn btn-info">
                        </form>
                    </div>
                   
                </div>
            </div>

            </div>
        </div>
    </div>
    <?php require_once 'footer.php';?>
</body>
</html>