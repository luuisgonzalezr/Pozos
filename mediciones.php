<?php
$id = $_GET['id'];

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

</head>
<body>
    <div class="bienvenida">
        <h1 class="text-center text-uppercase m-4">Mediciones del pozo <?php echo $id?></h1>
    </div>

    <a href="index.html" class="btn btn-primary btn-inicio" ><i class="fas fa-long-arrow-alt-left"></i>Volver a inicio</a>

    <div class="menu-pacientes container text-center ">
        <button class="btn btn-success btn-agregar mt-4 " id="btn-agregar-medicion">Agregar nueva medicion</button>
    </div>

    <div class="menu-pacientes container text-center ">
        <button class="btn btn-primary btn-agregar mt-4 " id="btn-grafica">Visualizar en gráfica</button>
    </div>

    <div class="container zona-mediciones mt-4">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Hora</td>
                        <td>Medicion</td>
                    </tr>
                </thead>
                <tbody id="mediciones">
                   
                </tbody>
            </table>
        </div>
    </div>


    <div class="container registro-medicion invisible" id='div-medicion'>
        <form action="" class="form" id='form-medicion'>
            <input type="hidden" name="pozo-medicion" id="pozo-medicion" value="<?php echo $id?>">
            <div class="mb-3">
                <label for="hora-medicion" class="form-label">Hora</label>
                <input required type="time" class="form-control" id="hora-medicion" name="hora-medicion" >
            </div>
            <div class="mb-3">
                <label for="fecha-medicion" class="form-label">Fecha</label>
                <input required type="date" min='2021-06-01' class="form-control" id="fecha-medicion" name="fecha-medicion" >
            </div>
            <div class="mb-3">
                <label for="valor-medicion" class="form-label">Medicion (BAR)</label>
                <input required type="number" class="form-control" id="valor-medicion" name="valor-medicion" >
            </div>
            <div class="mb-3">
                <input class="btn btn-success" type="submit" id="agregar-medicion" value="Agregar">
                <button id="btn-cancelar-medicion" type="button" class="btn btn-danger">Cancelar</button>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>