<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>

        <script type="text/javascript">

            function init() {
                //google.load("visualization", "1.1", { packages:["corechart"], callback: 'drawCharts' });
                google.load("visualization", "1.1", { packages: 'corechart', callback: 'drawCharts' });
                const miDiv = document.getElementById("test");

                // Agrega texto al div utilizando textContent
                miDiv.textContent = "Este es el texto que se agregará al div.";
            }

            function drawCharts() {
                drawAccountImpressions('chart-account-impressions');
            }
            
            function drawAccountImpressions(containerId) {
                var data = google.visualization.arrayToDataTable([
                    ['Day', 'This month'],
                    ['01', 1000],
                    ['05', 800,],
                    ['09', 1000],
                    ['13', 1000],
                    ['17', 660,],
                    ['21', 660,],
                    ['23', 750,],
                    ['27', 800,]
                ]);

                var options = {
                    title: 'TEST'
                   /* width: 700,
                    height: 400,
                    hAxis: { title: 'Day',  titleTextStyle: { color: '#333' } },
                    vAxis: { minValue: 0 },
                    curveType: 'function',
                    chartArea: {
                        top: 30,
                        left: 50,
                        height: '70%',
                        width: '100%'
                    },
                    legend: 'bottom'*/
                };

                var chart = new google.visualization.PieChart(document.getElementById(containerId));
                chart.draw(data, options);
            }
        </script>
    </head>
    
    <body onload="init()">
        <h1>HOLA</h1>
        <div id="chart-account-impressions" style="width:900px;height: 900px;"></div>
        <div id="test"></div>
    </body>
</html>