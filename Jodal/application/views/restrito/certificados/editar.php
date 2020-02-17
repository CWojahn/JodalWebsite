<div class="text-center">
    <h3>Editar Certificado</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('unchecked'); ?>
        </div>
    <?php } ?>
</div>
<form id="form_certificado" method="post" action="<?php echo site_url('certificado_painel/salvar_edit'); ?>">
    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
        <div class="form-group">
            <label for="numero">Número do Certificado(RIT)</label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" readonly value="<?php echo $certificado->id; ?>">
        </div>
        <div class="form-group">
            <label for="treinamento">Treinamento</label>
            <select class="form-control" id="treinamento" name="treinamento">
                <?php foreach ($treinamentos as $treinam) { ?>
                    <option value="<?php echo $treinam->id ?>" <?php echo $treinam->id == $certificado->treinamento ? 'selected' : ''; ?>><?php echo $treinam->nome_pt; ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="form-group">
            <label for="horas">Carga horária</label>
            <input class="form-control" id="horas" name="horas" placeholder="Carga Horária do treinamento" value="<?php echo $certificado->horas; ?>">
        </div>
        <div class="form-group">
            <label for="aluno">Nome do Aluno</label>
            <input class="form-control" id="aluno" name="aluno" placeholder="Nome do aluno" value="<?php echo $certificado->aluno_nome; ?>"/>
        </div>

        <div class="form-group">
            <label for="rg">RG do aluno</label>
            <input class="form-control" id="rg" name="rg" placeholder="RG do aluno" value="<?php echo $certificado->aluno_rg; ?>">
        </div>
        <div class="form-group">
            <label for="rg">CPF do aluno</label>
            <input class="form-control" id="cpf" name="cpf" placeholder="CPF do aluno" value="<?php echo $certificado->aluno_cpf; ?>">
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" placeholder="Data de expedição" value="<?php echo $certificado->data; ?>">
        </div>
        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" placeholder="Observação" rows="6"><?php echo $certificado->observacao; ?></textarea>
        </div>

    </div>

    <div class="col-md-12 text-center">
        <button class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Salvar</button>
        <a href="javascript:history.back()" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</a>
    </div>
</form>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url('js/bootstrap-maxlength.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script>
// just for the demos, avoids form submit
            jQuery(function ($) {
            $("#cpf").mask("999.999.999-99");
            });
            $("#form_certificado").validate({
    rules: {
    numero: {
    required: true
    },
            treinamento: {
            required: true
            },
            horas: {
            required: true
            },
            aluno: {
            required: true
            },
            cpf: {
            required: true
            }
    },
            messages: {
            numero: {
            required: 'É obrigatório incluir o número do certificado'
            },
                    treinamento: {
                    required: 'É obrigatório definir o treinamento'
                    },
                    horas: {
                    required: 'É obrigatório definir a duração do treinamento'
                    },
                    aluno: {
                    required: 'É obrigatório incluir o nome do participante'
                    },
                    cpf: {
                    required: 'É obr