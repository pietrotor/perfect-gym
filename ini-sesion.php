<?php
session_start();
if (isset($_SESSION['$id_usuario'])){
  header("location: inicio.php");
}
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@300;600&display=swap" rel="stylesheet">

    <title>PerfectGym</title>
  </head>
  <body class="bg-dark">
    <section>
      <div class="row g-0">
        <div class="col-lg-7 d-none d-lg-block">
      <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel" data-pause="false">
        <div class="carousel-inner">
          <div class="carousel-item img-1 min-vh-100 img-fluid active">

          </div>
          <div class="carousel-item img-2 min-vh-100 img-fluid">

          </div>
          <div class="carousel-item img-3 min-vh-100 img-fluid">

          </div>
        </div>
      </div>
        </div>

        <div id="formulario" class="col-lg-5 d-flex flex-column align-items-end min-vh-100">
          <div class="px-lg-5 pt-lg-4 pb-lg-3 p-4 w-100 ">
            <!-- <img src="https://gestion.fitcolatam.com/hs-fs/hubfs/Fitco-November2017/Images/fitco-logo.png?width=236&height=102&name=fitco-logo.png" class="img-fluid" alt=""> -->
            <img src="imagenes-sistema/logo.png" style="height:150px;" class="img-fluid" alt="">
          </div>
          <div class="px-lg-5 py-lg-4 p-4 w-100">
            <h1 class="font-weight-bold mb-4">Bienvenido de vuelta</h1>
            <!-- <form method="POST" action="bd/loguear.php" id="formRegis"> -->
            <form id="formRegis">
              <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label font-weight-bold">Usuario</label>
                <input type="text" name="usuario" class="form-control bg-dark-x border-0" placeholder="Ingresa tu Usuario" id="in-usuario" aria-describedby="emailHelp">

              </div>
              <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label font-weight-bold">Contraseña</label>
                <input type="password" name="password" class="form-control bg-dark-x border-0 mb-2" placeholder="Ingresa tu Contraseña" id="in-password">
                <a href="#" id="emailHelp" class="form-text text-muted text-decoration-none ">¿Has olvidado tu contraseña?</a>
              </div>
              <button type="submit" id="bntIngresar" class="btn btn-primary btn-block font-weight-bold">Iniciar Sesión</button>
            </form>
          </div>
        </div>
      </div>

      </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-BOsAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>
    

    <!-- Option 2: Separate Popper.js and Bootstrap JS
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
    -->
    <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <script type="text/javascript" src="js/main-loguear.js"></script>


  </body>
</html>
