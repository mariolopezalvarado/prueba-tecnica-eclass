
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Buscador Spotify | eClass</title>

  <?php 
    echo $this->Html->css('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    echo $this->Html->css('adminlte.min.css');
    echo $this->Html->script('https://kit.fontawesome.com/f9b8592fc9.js');
    echo $this->Html->script('https://cdn.jsdelivr.net/npm/vue/dist/vue.js');
    echo $this->Html->script('https://unpkg.com/axios/dist/axios.min.js');
  ?>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <div class="container">
        <i class="fab fa-spotify fa-2x"></i> <span class="brand-text font-weight-light"> SpotifySearch</span>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <span class="nav-link" >
            Mario López Alvarado
          </span>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-3">
    <!-- Main content -->
    <div class="content">
      <div class="container">
          <?php  echo $this->fetch('content'); ?>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<?php 
  echo $this->Html->script('https://code.jquery.com/jquery-3.4.1.min.js');
  echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
  echo $this->Html->script('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
  echo $this->Html->script('adminlte.min.js');
?>

</body>
</html>
