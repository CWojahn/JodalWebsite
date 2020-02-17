<div class="container">
    <div class="row" style="margin-top: 45px; margin-bottom: 45px;">

        <?php foreach ($categorias as $value) { ?>
        <div class="col-sm-6 col-md-3">
            <a href="<?php echo site_url('acessoria/categoria/'.$value->id)?>" class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url('uploads/acessoria/categoria/home/' . $value->banner_home); ?>" alt="...">
                <div class="text-center div-jodal text-uppercase" style="background-color: <?php echo $value->color;?>"><?php echo $value->nome;?></div>
            </a>
        </div>
        <?php } ?>
        <!--<div class="col-sm-6 col-md-3">
            <a href="<?php echo site_url('acessoria/categoria/2')?>" class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url('img/n002.jpg'); ?>" alt="...">
                <div class="text-center div-jodal" style="background-color: #4C4C4C">ENG. SEGURANÇA</div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="<?php echo site_url('acessoria/categoria/3')?>" class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url('img/n003.jpg'); ?>" alt="...">
                <div class="text-center div-jodal" style="background-color: #552F2E">MED. OCUPACIONAL</div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="<?php echo site_url('acessoria/categoria/4')?>" class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url('img/n004.jpg'); ?>" alt="...">
                <div class="text-center div-jodal" style="background-color: #003399">EXAMES COMPLEMENTARES</div>
            </a>

        </div>-->
    </div>
</div>