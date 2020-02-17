<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap-image-gallery.min.css'); ?>">

<div class="container-fluid" style="border-top: 10px solid #003232; margin-top: 30px;">

</div>
<div class="container" style="background-color: #FFF; min-height: 400px; ">
    <div class="row">
        <h2 class="text-center"><?php echo $empresa->nome; ?></h2>
        <pre class="lead text-justify" style="border: none"><?php echo $empresa->descricao; ?></pre>
    </div>

    <div class="row">
        <div id="links">
            <?php foreach ($imagens as $img) { ?>
                <a class="col-md-4" href="<?php echo base_url('uploads/empresa/' . $img->imagem); ?>" data-gallery="" style="margin-bottom: 10px">
                    <img class="img-thumbnail img-responsive" src="<?php echo base_url('uploads/empresa/' . $img->imagem); ?>" style="cursor: pointer;">
                </a>
            <?php } ?>
        </div>
    </div>
</div>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Anterior
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Próximo
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
