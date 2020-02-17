<div class="text-center" style="margin-bottom: 20px;">
    <img class="nocopy" src="<?php echo base_url('uploads/selos/' . $selo_pt); ?>" style="height: 150px; width: 150px;">
</div>
<form class="form-horizontal">
    <div class="form-group">
        <label class="col-sm-6 control-label">Certificado nº</label>
        <div class="col-sm-6">
            <p class="form-control-static text-uppercase"><?php echo $id; ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-6 control-label">Participante</label>
        <div class="col-sm-6">
            <p class="form-control-static text-uppercase"><strong><?php echo $aluno_nome; ?></strong></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-6 control-label">RG</label>
        <div class="col-sm-6">
            <p class="form-control-static text-uppercase"><?php echo $aluno_rg; ?></p>
        </div>
    </div>
    <?php if (isset($aluno_cpf) && !empty($aluno_cpf)) { ?>
        <div class="form-group">
            <label class="col-sm-6 control-label">CPF</label>
            <div class="col-sm-6">
                <p class="form-control-static text-uppercase"><?php echo $aluno_cpf; ?></p>
            </div>
        </div>
    <?php } ?>

    <div class="form-group">
        <label class="col-sm-6 control-label">Treinamento</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo strip_tags($nome_pt); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-6 control-label">Carga Horária</label>
        <div class="col-sm-6">
            <p class="form-control-static"><?php echo $horas; ?> horas</p>
        </div>
    </div>
    <?php if (!empty($data)) { ?>
        <div class="form-group">
            <label class="col-sm-6 control-label">Data de expedição</label>
            <div class="col-sm-6">
                <p class="form-control-static"><?php echo date('d/m/Y', strtotime($data)); ?></p>
            </div>
        </div>
    <?php } ?>

    <?php if (isset($observacao) && !empty($observacao)) { ?>
        <div class="form-group">
            <div class="col-md-offset-1 col-md-10">
                <pre class="form-control-static"><?php echo $observacao; ?></pre>
            </div>
        </div>
    <?php } ?>
</form>
<script type="text/javascript">
    $('.nocopy').bind('contextmenu', function (e) {
        return false;
    });
    $(".nocopy").mousedown(function () {
        return false;
    });
</script>