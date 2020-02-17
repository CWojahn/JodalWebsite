<div class="text-center">
    <h3>Cadastrar novo Certificado</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-success alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ATENÇÃO!</strong> Erro ao cadastrar novo certificado, verifique o número do certificado.
        </div>
    <?php } ?>
</div>
<form id="form_novo_certificado" method="post" action="<?php echo site_url('certificado_painel/salvar'); ?>">
    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
        <div class="form-group">
            <label for="numero">Número do Certificado(RIT)</label>
            <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" value="<?php echo $next;?>">
        </div>
        <div class="form-group">
            <label for="treinamento">Treinamento</label>
            <select class="form-control" id="treinamento" name="treinamento">
                <?php foreach ($treinamentos as $treinam) { ?>
                    <option value="<?php echo $treinam->id ?>"><?php echo $treinam->nome_pt; ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="form-group">
            <label for="horas">Carga horária</label>
            <input class="form-control" id="horas" name="horas" placeholder="Carga Horária do treinamento">
        </div>
        <div class="form-group">
            <label for="aluno">Nome do Aluno</label>
            <input class="form-control" id="aluno" name="aluno" placeholder="Nome do aluno"/>
        </div>      
        <div class="form-group">
            <label for="cpf">CPF do aluno</label>
            <input class="form-control" id="cpf" name="cpf" placeholder="CPF do aluno">
        </div>
        <div class="form-group">
            <label for="rg">RG do aluno</label>
            <input class="form-control" id="rg" name="rg" placeholder="RG do aluno">
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" placeholder="Data de expedição" value="<?php echo date('Y-m-d');?>">
        </div>
        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" placeholder="Observação" rows="6"></textarea>
        </div>

    </div>
    <div class="col-md-12 col-sm-12 text-center">
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
    //jQuery(function ($) {
    //    $("#cpf").mask("999.999.999-99");
    //});
    $("#form_novo_certificado").validate({
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
            rg: {
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
            rg: {
                required: 'É obrigatório definir o RG do participante'
            }
        }

    });
</script>