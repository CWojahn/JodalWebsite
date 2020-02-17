
<?php if ($idioma == 'pt') { ?>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <img class="nocopy" src="<?php echo base_url('uploads/selos/' . $treinamento_detail->selo_pt); ?>" data-holder-rendered="true" style="height: 170px; width: 170px;">
            </div>
            <div class="text-center" style="margin-top: 60px">
                <p class="text-center"><strong>DOWNLOAD DA GRADE DO CURSO</strong></p>
                <a href="<?php echo base_url('uploads/grades/' . $treinamento_detail->grade_curso_pt); ?>" target="_blank"><img src="<?php echo base_url('img/pdf-icon.png') ?>" style="height: 64px; width: 64px;"></a>
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="text-center" style="font-family: HandelGotDBol"><?php echo $treinamento_detail->nome_pt ?></h3>
            <!--<p class="text-center lead">-->
            <pre style="font-family: verdana,arial,sans-serif"><?php echo $treinamento_detail->descricao_pt;?></pre>
            <!--</p>-->

        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <img class="nocopy" src="<?php echo base_url('uploads/selos/' . $treinamento_detail->selo_en); ?>" data-holder-rendered="true" style="height: 170px; width: 170px;">
            </div>
            <div class="text-center" style="margin-top: 60px">
                <p class="text-center"><strong>DOWNLOAD DA GRADE DO CURSO</strong></p>
                <a href="<?php echo base_url('uploads/grades/' . $treinamento_detail->grade_curso_en); ?>" target="_blank"><img src="<?php echo base_url('img/pdf-icon.png') ?>" style="height: 64px; width: 64px;"></a>
            </div>
        </div>
        <div class="col-md-8">
            <h3 class="text-center"><?php echo $treinamento_detail->nome_en ?></h3>

            <pre style="font-family: verdana,arial,sans-serif"><?php echo $treinamento_detail->descricao_en ?></pre>


        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    $('.nocopy').bind('contextmenu', function (e) {
        return false;
    });
    $(".nocopy").mousedown(function () {
        return false;
    });
</script>