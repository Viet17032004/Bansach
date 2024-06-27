<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $data['titlePage']; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- my css -->
  <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE_ADMIN.'/assets/'; ?>css/main.css?var=<?php echo rand(); ?>">
</head>



<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>


    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->


      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link text-primary" data-toggle="dropdown" href="#">
          <span class="mr-3 text-warning"><?php echo _MY_DATA['fullname']; ?></span>
          <i class="fa fa-address-book"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header text-primary">SMART<span class="text-warning">FL</span></span>
          <div class="dropdown-divider"></div>
          <a href="?module=profile" class="dropdown-item">
            <i class="fa fa-address-card mr-2"></i> Tài khoản
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo _WEB_HOST_ROOT; ?>" class="dropdown-item">
          <i class="fa fa-archway mr-2"></i> Website
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo _WEB_HOST_ROOT.'?module=auth&action=logout'; ?>" class="dropdown-item">
          <i class="fa fa-angle-double-left mr-2"></i> Đăng xuất
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer text-primary">Profile</a>
        </div>
      </li>


      
    </ul>
  </nav>
  <!-- /.navbar -->

  