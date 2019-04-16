<!DOCTYPE html>
<html>
<head>
<title>Chart</title>
<style type="text/css">
BODY {
    width: 550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>


</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("php/data.php",
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
                                label: 'Weekly Sales <?php echo  $week = '" '. date( 'M d, Y', strtotime( 'monday this week' ) ).' - '.date( 'M d, Y', strtotime( 'friday this week' ) ).'"';?>',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                fill: false,
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata,
                        options: {
                                    elements: {
                                        line: {
                                            tension: 0, // disables bezier curves
                                        }
                                    }
                                }
                    });
                });
            }
        }
        </script>

</body>
</html>