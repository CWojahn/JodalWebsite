<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style-font.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles-menu.css'); ?>">
        <link href="<?php echo base_url('css/lightbox.css'); ?>" rel="stylesheet">

        <!-- jQuery library -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.slides.min.js'); ?>"></script>
        <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
        <script src="<?php echo base_url('js/bootstrap-image-gallery.min.js'); ?>"></script>
        

    </head>
    <body>
        <script src="<?php echo base_url('js/lightbox.min.js'); ?>"></script>
        <div id="cssmenu">
            <ul>
                <li class="<?php echo $this->uri->segment(1) == 'home' ? 'active' : ''; ?>"><a href="<?php echo site_url('acessoria'); ?>"><span>Home</span></a></li>
                <li class="<?php echo $this->uri->segment(3) == 'empresa' ? 'active' : ''; ?>"><a href="<?php echo site_url('acessoria/empresa'); ?>"><span>A Empresa</span></a></li>
                <li class="<?php echo $this->uri->segment(2) == 'material' ? 'active' : ''; ?>"><a href="<?php echo site_url('acessoria/material'); ?>"><span>Material de Apoio</span></a></li>
                <li class="<?php echo $this->uri->segment(2) == 'clientes' ? 'active' : ''; ?>"><a href="<?php echo site_url('acessoria/clientes'); ?>" ><span>Clientes</span></a></li>
                <li class="<?php echo $this->uri->segment(2) == 'contato' ? 'active' : ''; ?>"><a href="<?php echo site_url('acessoria/contato'); ?>">Contato</a></li>
            </ul>
        </div>
        <div class="div-color" style="min-height: 500px;">
            <div class="text-center">
                <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('img/logo_nova.png'); ?>" height="110" style="margin-top: 25px; "></a>
            </div>

