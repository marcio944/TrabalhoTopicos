<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Área da Manutenção</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/res/maitenance/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/maitenance/dist/css/ADMINLTE.min.css">

  <link rel="stylesheet" href="/res/maitenance/dist/css/skins/skin-blue.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="\maitenance" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Click</b> Vendas</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        
            <a href="/maitenance/logout" class="btn btn-primary">Logout</a>     
      </div>
    </nav>
  </header>
  
  <aside class="main-sidebar">

    <section class="sidebar">
  
        <ul class="sidebar-menu">
        <li class="header">CLICK VENDAS</li>
        <li class=""><a href="/maitenance/users"><i class="fa fa-users"></i> <span>Usuários</span></a></li>
        <li><a href="/maitenance/products"><i class="fa fa-shopping-cart"></i> <span>Pedidos de Manutenção</span></a></li>
    
      </ul>
    </section>
  </aside>