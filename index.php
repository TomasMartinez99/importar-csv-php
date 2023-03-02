<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type="text/css" rel="shortcut icon" href="img/logo-mywebsite-urian-viera.svg"/>
  <title>Cómo Importar Excel a MYSQL con PHP sin Libreria</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/cargando.css">
  <link rel="stylesheet" type="text/css" href="css/cssGenerales.css">
</head>
<body>

<div class="cargando">
  <div class="loader-outter"></div>
  <div class="loader-inner"></div>
</div>

<nav class="navbar navbar-expand-lg navbar-light navbar-dark fixed-top" style="background-color: #563d7c !important;">
    <!-- <ul class="navbar-nav mr-auto collapse navbar-collapse">
      <li class="nav-item active">
        <a href="index.php"> 
          <img src="" alt="Tomas Martinez" width="120">
        </a>
      </li>
    </ul> -->
    <div class="my-2 my-lg-0">
      <h5 class="navbar-brand"> Tomas Martinez </h5>
    </div>
</nav>

<div class="container">

<h3 class="text-center">
  Importar Excel a MYSQL con PHP sin Libreria
</h3>
<hr>
<br>

  <div class="row justify-content-center">
    <div class="col-md-2">
      <form action="recibe_excel_validando.php" method="POST" enctype="multipart/form-data"/>
        <div class="file-input text-center">
          <input type="file" name="dataCliente" id="file-input" class="file-input__input"/>
          <label class="file-input__label" for="file-input">
            <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
            <span>Elegir Archivo Excel</span>
          </label>
        </div>
        <div class="text-center mt-2">
            <input type="submit" name="subir" class="btn-enviar" value="Subir Excel"/>
        </div>
      </form>
    </div>
  </div>

  <br><br>

 <div class="row justify-content-center">
    <div class="col-md-10">
      <?php
        header("Content-Type: text/html;charset=utf-8");
        include('config.php');
        $sqlClientes = ("SELECT * FROM clientes ORDER BY id ASC");
        $queryData   = mysqli_query($con, $sqlClientes);
        $total_client = mysqli_num_rows($queryData);
      ?>

      <h6 class="text-center">
        Lista de Clientes <strong>(<?php echo $total_client; ?>)</strong>
      </h6>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>Nombre</th>
              <th>Tipo IVA</th>
              <th>CUIT</th>
              <th>Localidad</th>
              <th>Provincia</th>
              <th>Lista de Precio</th>
              <th>Saldo cta. corriente</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $i = 1;
              while ($data = mysqli_fetch_array($queryData)) { ?>
              <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $data['codigo']; ?></td>
                <td><?php echo $data['nombre']; ?></td>
                <td><?php echo $data['tipoIva']; ?></td>
                <td><?php echo $data['cuit']; ?></td>
                <td><?php echo $data['localidad']; ?></td>
                <td><?php echo $data['provincia']; ?></td>
                <td><?php echo $data['listaPrecio']; ?></td>
                <td><?php echo $data['saldoCtaCorriente']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

    </div>
  </div>

</div>

<script src="js/jquery.min.js"></script>
<script src="'js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $(window).load(function() {
        $(".cargando").fadeOut(1000);
    });      
  });
</script>

</body>
</html>