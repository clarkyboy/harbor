<?php
    session_start();
    if($_SESSION['logstat']!= "Active" || $_SESSION['emptype'] != 'M'){header('Location: ../index.php');}
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    include_once 'php/admin.php';
    $date = date('Y-m-d');
    $monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
    $friday = date( 'Y-m-d', strtotime( 'friday this week' ) );
    $display = date('M d, Y', strtotime($date));
    $week = date( 'M d, Y', strtotime( 'monday this week' ) ).' - '.date( 'M d, Y', strtotime( 'friday this week' ) );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin| Charges Management</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <!--Daterange-->

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
   
    
    
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
            <img src="../images/logo.jpg" alt="" width="100" height="100" class="rounded-circle mx-auto d-block img-thumbnail mb-3">
                <h3 class="lead text-center">Hello Admin!</h3>
            </div>

            <ul class="list-unstyled components" id="prevented">
                <p>Admin Dashboard</p>
                <li class="active">
                    <a href="" onclick="loadDashboard();">Dashboard</a>
                    <!-- <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="#">Home 1</a>
                        </li>
                        <li>
                            <a href="#">Home 2</a>
                        </li>
                        <li>
                            <a href="#">Home 3</a>
                        </li>
                    </ul> -->
                </li>
                <li>
                <a href="" onclick="loadAbout();">Employees</a>
                </li>
                <li>
                <a href="" onclick="loadProduct();">Product List</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Charges Management</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="" onclick="loadCharges();">Charges by Branch</a>
                        </li>
                        <li>
                            <a href="" onclick="loadEmpCharges();">Charges Per Employee</a>
                        </li>
                        <li>
                            <a href=""  onclick="loadMonthlyCharges();">Monthly Report</a>
                        </li>
                        <li>
                            <a href=""  onclick="loadCostCharges();">Costs Report</a>
                        </li>
                        <!-- <li>
                            <a href="#">Charges Already Approved</a>
                        </li> -->
                    </ul>
                </li>
                <li>
                    <a href="#">Messages</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="download">My Profile</a>
                </li>
                <li>
                    <a href="../logout.php" class="article">Logout</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <!-- <span>Toggle Sidebar</span> -->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Notifications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Messages</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div id="pageContent"></div>
            <div class="line"></div>
            <div class="container hidden" id="graph">
                <h3 class="lead">Sales Graph</h3>
                <br>
                <div class="row">
                    <div class="col-6">
                        <canvas id="chartContainer" style="height: 370px; width: 100%;"></canvas>
                    </div>
                    <div class="col-6">
                    <canvas id="pieContainer" style="height: 370px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            
            
            
            
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX)
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function(){
            showGraph();
            lineChart();
            pieChart();
            Chart.defaults.global.animation.duration = 3000;
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
            $('#prevented a').click(function (event) {
                event.preventDefault();
                // or use return false;
            });
            loadDashboard();
           
        })
        function lineChart(){
            {

                $.post("pages/linechart.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                     var marks = [];

                    for (var i in data) {
                        name.push(data[i].name);
                        marks.push(data[i].sales);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Weekly Sales <?php echo  $week ;?>',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                // fill: false,
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#chartContainer");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                                    // elements: {
                                    //     line: {
                                    //         tension: 0, // disables bezier curves
                                    //     }
                                    // }
                                }
                    });
                });
            }
        }
        function pieChart(){
            
            {

                $.post("pages/piechart.php",
                    function (data)
                    {
                        console.log(data);
                        var name = [];
                        var marks = [];

                        for (var i in data) {
                            name.push(data[i].name);
                            marks.push(data[i].sales);
                        }

                        var chartdata = {
                            labels: name,
                            datasets: [
                                {
                                    data: marks,
                                    backgroundColor: [
                                        "#ec6262",
                                        "#e1d276",
                                        "#99ea86",
                                        "#949FB1",
                                        "#4D5360",
                                    ]
                                }
                            ]
                        };

                        var graphTarget = $("#pieContainer");

                        var pieGraph = new Chart(graphTarget, {
                            type: 'pie',
                            data: chartdata,
                            options: {
                                    responsive: true,
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: "Today's Sales"
                                    },
                                    animation: {
                                        animateScale: false,
                                        animateRotate: true
                                    }
                                }
                        });
                    });
                    
            }
        }
        function showGraph(){
            $('#graph').removeClass('hidden');
        }
    </script>
    <script src="js/home.js"></script>
</body>

</html>