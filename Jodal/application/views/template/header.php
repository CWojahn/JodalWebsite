<?php
if (isset($en)) {
    $this->lang->load('template/header', 'english');
} else {
    $this->lang->load('template/header', 'portugues');
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style-font.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css'); ?>">


        <!-- jQuery library -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.slides.min.js'); ?>"></script>
        <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
        <script src="<?php echo base_url('js/bootstrap-image-gallery.min.js'); ?>"></script>

        <script>

            $(function () {
                $("#slides").slidesjs({
                    width: 940,
                    height: 256,
                    play: {
                        active: false,
                        // [boolean] Generate the play and stop buttons.
                        // You cannot use your own buttons. Sorry.
                        effect: "slide",
                        // [string] Can be either "slide" or "fade".
                        interval: 4000,
                        // [number] Time spent on each slide in milliseconds.
                        auto: true,
                        // [boolean] Start playing the slideshow on load.
                        swap: true,
                        // [boolean] show/hide stop and play buttons
                        pauseOnHover: true,
                        // [boolean] pause a playing slideshow on hover
                        restartDelay: 2500
                                // [number] restart delay on inactive slideshow
                    },
                    effect: {
                        slide: {
                            // Slide effect settings.
                            speed: 1200
                                    // [number] Speed in milliseconds of the slide animation.
                        }}
                });
            });

        </script>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-57724075-2', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="text-center">
                        <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('img/logo_nova.png'); ?>" height="100" style="margin-top: 10px; margin-bottom: 10px; margin-right: 100px"></a>
                    </div>

                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="text-right" style="margin-top: 30px;">
                        <a href="<?php echo site_url('treinamentos/pt'); ?>"><img title="Treinamentos disponíveis em Português" src="<?php echo base_url('img/brasil-icon.png'); ?>" height="32"></a>
                        <a href="<?php echo site_url('treinamentos/en'); ?>"><img title="Treinamentos disponíveis em Inglês" src="<?php echo base_url('img/eua-icon.png'); ?>" height="32"></a>
                    </div>
                    <div style="padding:20px;">
                        <form class="form-search form-inline pull-right" action="<?PHP echo site_url('treinamentos/pesquisar'); ?>" method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control search-query" name="pesquisar" placeholder="<?php echo $this->lang->line('campo_pesquisar'); ?>" /> <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('pesquisar'); ?></button>
                                </span>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container-fluid">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav nav">
                            <li class="<?php echo $this->uri->segment(1) == '' ? 'active' : ''; ?>"><a href="<?php echo site_url() ?>"><?php echo $this->lang->line('home'); ?></a></li>
                            <li class="<?php echo $this->uri->segment(1) == 'empresa' ? 'active' : ''; ?>"><a href="<?php echo site_url('empresa') ?>"><?php echo $this->lang->line('empresa'); ?></a></li>
                            <li class="<?php echo $this->uri->segment(1) == 'treinamentos' ? 'active' : ''; ?>"><a href="<?php echo site_url('treinamentos') ?>"><?php echo $this->lang->line('treinamentos'); ?></a></li>
                            <li class="dropdown <?php echo $this->uri->segment(1) == 'servicos' ? 'active' : ''; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"><?php echo $this->lang->line('servicos'); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('servicos') ?>"><?php echo $this->lang->line('servicos1'); ?></a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo site_url('certificados') ?>"><?php echo $this->lang->line('certificados'); ?></a></li>

                                </ul>

<!--<a href="<?php //echo site_url('servicos')     ?>"><?php //echo $this->lang->line('servicos');     ?></a>-->
                            </li>
                            <li class="<?php echo $this->uri->segment(1) == 'contato' ? 'active' : ''; ?>"><a href="<?php echo site_url('contato') ?>"><?php echo $this->lang->line('contato'); ?></a></li>
                            <li><a href="<?php echo site_url('painel_controle') ?>" target="_blank"><?php echo $this->lang->line('restrito'); ?></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div>
            <div class="container-fluid div-background">
                <div class="container">
                    <div class="row" id="slides">
                        <?php foreach ($slides as $slide) { ?>
                            <?php if (isset($en)) { ?>
                                <img src="<?php echo base_url('uploads/slides/en/' . $slide->imagem); ?>" style="height: 100%; width: 100%">   
                            <?php } else { ?> 
                                <img src="<?php echo base_url('uploads/slides/pt/' . $slide->imagem); ?>" style="height: 100%; width: 100%"> 

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="container" style="min-height: 500px;">
                <!--<div class="row">
                    <h3 class="line-header">Texto teste</h3> 
                </div>-->
                <div class="row">
                    <h1><span><?php echo $header; ?></span></h1>
                </div>
