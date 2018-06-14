<!DOCTYPE html>
<html lang="en">
<head>        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>    
    <div class="container">
    <canvas id="line-chart" width="800" height="450"></canvas>

    <script>
        var scores = {!! json_encode($scores) !!};
        var names = {!! json_encode($names) !!}

        new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: names,
            datasets: [{ 
                data: scores,
                label: "students",
                borderColor: "#8e5ea2",
                fill: false
            }]
        },
        options: {
            title: {
            display: true,
            text: 'students scores in the online quiz'
            }
        }
        });
    </script> 
</div> 
</body>
</html> 