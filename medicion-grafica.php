<?php
$pozo = $_GET['pozo'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pozos</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/dd425220c4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js"></script>

</head>
<body>
    <div class="bienvenida">
        <h1 class="text-center text-uppercase m-4">Gráfica de últimas 10 mediciones del pozo <?php echo $pozo?></h1>
    </div>

    <a href="mediciones.php?id=<?php echo $pozo ?>" class="btn btn-primary btn-inicio" ><i class="fas fa-long-arrow-alt-left"></i>Volver a mediciones</a>

    <div class="container">
    <canvas id="myChart" style="width: 50vh; height: 15vh"></canvas>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
   
    <script>
        var labels = new Array();
        var dataset = new Array();
        $(document).ready(function(){
            
            pozo = <?php echo $pozo?>;
            $.ajax({
                type: 'get',
                url: 'obtener-mediciones-grafica.php',
                data: {'pozo':pozo},
                success:function(response){
                    if((!response === false) && (response != null)){
                        
                        let mediciones = JSON.parse(response);
                        mediciones.forEach(element => {
                            labels.push(element.fecha + ' / ' + element.hora);
                            dataset.push(element.medicion);
                            console.log('labels: ' + labels);
                            console.log('datasets: ' + dataset);
                            console.log(labels);
                    });

                            const ctx = document.getElementById('myChart');
                            const myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Medición de presión (BAR)',
                                    data: dataset,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    
                    }else{
                        console.log('error');
                        document.location.href = `mediciones.php?id=${pozo}`;
                    }
                }
            })


            console.log(labels);


            
        });
    </script>
    <script>
        
</script>
</body>
</html>