<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel de Controle</title>
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.slides.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css'); ?>">

    </head>
    <body class="container">
        <div class="row hidden-print">
            <div class="col-md-12 text-center">
                <h2>Painel de Controle Jodal</h2>
            </div>
        </div>
        <div class="row hidden-print">
            <div class="col-md-12 panel panel-default" style="background-color: #008030">
                <div class="panel-body">
                    <a href="<?php echo site_url('treinamento_painel'); ?>" id="btn_produto" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Treinamentos">
                        <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo site_url('destaques_painel'); ?>" id="btn_destaques" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerencias produtos em destaque">
                        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo site_url('slides_painel'); ?>" id="btn_slides" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Slides">
                        <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo site_url('empresa_painel'); ?>" id="btn_empresa" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar texto sobre a empresa">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo site_url('servicos_painel'); ?>" id="btn_servicos" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Serviços">
                        <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                    </a>
                    <!--<a href="<?php //echo site_url('parceiros_painel'); ?>" id="btn_parceiros" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Parceiros">
                        <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                    </a>-->
                    <a href="<?php echo site_url('user_painel'); ?>" id="btn_user" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Usuários">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo site_url('certificado_painel'); ?>" id="btn_user" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Certificados">
                        <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo site_url('cotacao_painel'); ?>" id="btn_user" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Cotação">
                        <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                    </a>
                    <a href="<?php echo site_url('clientes_painel'); ?>" id="btn_user" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Clientes">
                        <span class="glyphicon glyphicon-glass" aria-hidden="true"></span>
                    </a>
                     <a href="<?php echo site_url('acessoria_painel'); ?>" id="btn_acessoria" class="btn btn-default btn-lg" aria-label="Left Align" title="Gerenciar Site de Acessoria">
                        <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                    </a>
                    
                    <a href="<?php echo site_url('painel_controle/logout');?>" id="btn_logout" class="btn btn-default btn-lg" aria-label="Left Align" title="Sair do Painel" style="float: right;">
                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" id="div_painel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><?php echo $header?></strong>
                </div>
                <div class="panel-body">
                    <?php echo isset($body) ? $body : '';?>

