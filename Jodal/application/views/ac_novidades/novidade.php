<div class="container-fluid" style="border-top: 10px solid #003232; margin-top: 30px;">

</div>
<div class="container" style="background-color: white;">

    <div>
        <h2>Novidades Jodal</h2>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <div>
                <a href="<?php echo base_url('uploads/novidades/' . $imagens[0]->path); ?>" data-lightbox="roadtrip">
                    <img class="img-rounded img-responsive" src="<?php echo base_url('uploads/novidades/' . $imagens[0]->path); ?>" data-holder-rendered="true">
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="text-center" style="font-family: HandelGotDBol"><?php echo $novidade->nome; ?></h3>

<!--<p class="text-center lead">-->
            <pre style="font-family: verdana,arial,sans-serif"><?php echo $novidade->desc_completa; ?></pre>
            <!--</p>-->

        </div>
    </div>
    <hr>
    <div class="row">
        <?php for ($index = 1; $index < count($imagens); $index++) { ?>
            <a class="col-md-2" href="<?php echo base_url('uploads/novidades/' . $imagens[$index]->path); ?>" data-lightbox="roadtrip">
                        <!--<img src="images/thumbnails/banana.jpg" alt="Banana">-->
                <img class="img-rounded img-responsive" src="<?php echo base_url('uploads/novidades/' . $imagens[$index]->path); ?>" style="cursor: pointer;">
            </a>
        <?php } ?>

    </div>
    <hr>
</div>

<script type="text/javascript">
    $('.nocopy').bind('contextmenu', function (e) {
        return false;
    });
    $(".nocopy").mousedown(function () {
        return false;
    });
</script>

