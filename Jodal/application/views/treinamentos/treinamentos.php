<div class="row">
    <?php foreach ($treinamentos as $trein) { ?>
        <?php if ($trein->versao_pt == TRUE) { ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img class="nocopy" data-src="holder.js/100%x200" alt="100%x200" src="<?php echo base_url('uploads/selos/' . $trein->selo_pt); ?>" data-holder-rendered="true" style="height: 170px; width: 170px; display: block;">
                    <div class="caption">
                        <h3 id="thumbnail-label" class="text-center"  style="height: 70px; font-size: 16px; font-family: HandelGotDBol"><?php echo $trein->nome_pt ?><a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                        <p class="text-center p-height"><?php echo $trein->descricao_curta_pt; ?></p>
                        <p class="text-center">
                            <a href="<?php echo site_url('treinamentos/detalhes/' . $trein->id) ?>" class="btn btn-jodal">SAIBA +</a>
                            <a href="<?php echo site_url('treinamentos/cotacao/' . $trein->id) ?>" class="btn btn-jodal">COTAR</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <img class="nocopy" data-src="holder.js/100%x200" alt="100%x200" src="<?php echo base_url('uploads/selos/' . $trein->selo_en); ?>" data-holder-rendered="true" style="height: 170px; width: 170px; display: block;">
                    <div class="caption">
                        <h3 id="thumbnail-label" class="text-center"  style="height: 70px; font-size: 16px;font-family: HandelGotDBol"><?php echo $trein->nome_en ?><a class="anchorjs-link" href="#thumbnail-label"><span class="anchorjs-icon"></span></a></h3>
                        <p class="text-center p-height"><?php echo $trein->descricao_curta_en; ?></p>
                        <p class="text-center">
                            <a href="<?php echo site_url('treinamentos/detalhes/' . $trein->id . '/en') ?>" class="btn btn-jodal">SEE +</a>
                            <a href="<?php echo site_url('treinamentos/cotacao/' . $trein->id . '/en') ?>" class="btn btn-jodal">QUOTE</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>
</div>
<script type="text/javascript">
    $('.nocopy').bind('contextmenu', function (e) {
        return false;
    });
    $(".nocopy").mousedown(function () {
        return false;
    });
</script>
