<!DOCTYPE html>
<html lang="en">
<head>        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>    
    <div class="container">
    <canvas id="line-chart" width="800" height="450"></canvas>

    <script>
        new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
            datasets: [{ 
                data: [282,350,411,502,635,809,947,1402,3700,5267],
                label: "Asia",
                borderColor: "#8e5ea2",
                fill: false
            }]
        },
        options: {
            title: {
            display: true,
            text: 'World population per region (in millions)'
            }
        }
        });
    </script> 
</div> 
</body>
</html> 