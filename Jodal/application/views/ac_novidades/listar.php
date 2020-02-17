<div class="container-fluid" style="border-top: 10px solid #003232; margin-top: 30px;">

</div>
<div class="container" style="min-height: 400px;background-color: white;">
    <h2><?php echo $header; ?></h2>
    <?php if (count($novidades) > 0) { ?>

        <?php foreach ($novidades as $art) { ?>
            <div class="media">
                <div class="media-left media-middle">
                    <a href="<?php echo site_url('acessoria/novidade/' . $art->id) ?>">
                        <img class="media-object img-rounded" alt="64x64" src="<?php echo base_url('uploads/novidades/' . $art->path); ?>" data-holder-rendered="true" style="width: 100px; height: 100px;">
                    </a>
                </div>
                <div class="media-body media-middle">
                    <h3 class="media-heading"><?php echo $art->nome; ?></h3>
                    <p><?php echo $art->desc_curta; ?></p>


                </div>
                <div class="media-right media-middle">
                    <a class="btn btn-jodal" href="<?php echo site_url('acessoria/novidade/' . $art->id) ?>">Saiba +</a>

                </div>


            </div>
            <?php
        }
    } else {
        ?>
        <div class="col-md-12 text-center">No momento não há artigos.</div>
    <?php } ?>
</div>


