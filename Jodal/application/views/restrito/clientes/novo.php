<div class="text-center">
    <h3>Cadastrar novo Cliente</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-success alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ATENÇÃO!</strong> Erro ao cadastrar novo cliente, verifique se o CNPJ não está cadastrado.
        </div>
    <?php } ?>
</div>
<form id="form_novo_certificado" class="form-horizontal" method="post" action="<?php echo site_url('clientes_painel/salvar'); ?>">
    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
        <div class="form-group">
            <label for="cnpj" class="control-label col-md-4">CPF ou CNPJ:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="empresa" class="control-label col-md-4">CLIENTE:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="empresa" name="empresa" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="razao_social" class="control-label col-md-4">RAZÃO SOCIAL:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="razao_social" name="razao_social" placeholder="DIGITE AQUI">
            </div>
        </div>
        
        <div class="form-group">
            <label for="ie" class="control-label col-md-4">IE:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="ie" name="ie" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="telefone" class="control-label col-md-4">TELEFONE:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="responsavel" class="control-label col-md-4">RESPONSÁVEL:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="responsavel" name="responsavel" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="endereco" class="control-label col-md-4">ENDEREÇO:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="bairro" class="control-label col-md-4">BAIRRO:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="cidade" class="control-label col-md-4">CIDADE:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="cep" class="control-label col-md-4">CEP:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="cep" name="cep" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="site" class="control-label col-md-4">SITE:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="site" name="site" placeholder="DIGITE AQUI">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-md-4">E-MAIL:</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="email" name="email" placeholder="DIGITE AQUI">
            </div>
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
    jQuery(function ($) {
        //$("#cnpj").mask("99.999.999/9999-99");
        $("#telefone").mask("(99) 9999-9999");
        $("#cep").mask("99999-999");
    });
    $("#form_novo_certificado").validate({
        rules: {
            cnpj: {
                required: true
            },
            empresa: {
                required: true
            },
            razao_social: {
                required: true
            },
            telefone: {
                required: true
            },
            responsavel: {
                required: true
            }
        },
        messages: {
            cnpj: {
                required: 'É obrigatório incluir o CNPJ'
            },
            empresa: {
                required: 'É obrigatório incluir o nome da empresa'
            },
            razao_social: {
                required: 'É obrigatório incluir a razão social'
            },
            telefone: {
                required: 'É obrigatório incluir o telefone de contato'
            },
            responsavel: {
                required: 'É obrigatório definir o responável'
            }
        }

    });
</script>