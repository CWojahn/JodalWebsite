<?php
$bg = array('001.jpg', '002.jpg', '003.jpg'); // array of filenames

$i = rand(0, count($bg) - 1); // generate random number size of the array
$selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
?>

<!DOCTYPE HTML>
<html >
    <head>
        <meta charset="utf-8">
        <title>Primee - Acesso restrito</title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>">
        <style type="text/css">
            <!--
            html, body {
                height:100%;
            } 
            body{
                background: url(<?php echo base_url('img/' . $selectedBg); ?>) no-repeat;
                background-size: 100% 100%;
                background-position: left top;
            }
            -->
        </style>
    </head>
    <body>
        <!--<div class="row text-center" style="border-style: solid">
            <h1>Página de Resultado</h1>
            
            <h2>O Resultado é: <?php //echo $result;    ?></h2>
        </div>-->
        <div class="center-block">
            <div class="col-md-offset-7 col-md-3 col-sm-offset-4 col-sm-4" style="background-color: white; border-radius: 5px;">
                <div class="row text-center">
                    <div class="col-md-12 text-center" style="margin-top: 40px; margin-bottom: 10px">
                        <a href="<?php echo site_url(); ?>">
                            <img class="img-responsive" alt="..." src="<?php echo base_url('img/logo.png'); ?>"></a>
                    </div>
                </div>
                <div>
                    <h4>
                        Entre em sua conta
                    </h4>
                    <div style="margin-bottom: 20px">
                        <?php echo validation_errors(); ?>

                        <form role="form" action="<?php echo site_url('verifylogin'); ?>" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Usuário de acesso">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                            </div>

                            <button type="submit" class="col-md-12 col-sm-12 btn btn-danger" style="margin-bottom: 20px;">Entrar</button>
                        </form>     
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
