<div class="text-center">
    <h3>Cadastrar novo material de apoio</h3>
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>
<form id="form_novo_parceiro" method="post" action="<?php echo site_url('material_painel/salvar'); ?>" enctype="multipart/form-data" >
    <div class="col-md-offset-3 col-md-6 col-sm-6">
        <div class="form-group">
            <label for="imagem">Arquivo do Material de Apoio</label>
            <input type="file" id="imagem" name="imagem" accept="application/msword, application/vnd.ms-office, application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/msexcel,application/x-msexcel,application/x-ms-excel,application/x-excel,application/x-dos_ms_excel,application/xls,application/x-xls,application/excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/pdf" required="">
        </div>
        <div class="form-group">
            <label for="nome">Nome do Material</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Material de apoio">
        </div>
        
    </div>
    
    <div class="col-md-12 col-sm-12 text-center">
        <button class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Salvar</button>
        <a href="javascript:history.back()" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</a>
    </div>
</form>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit

                $("#form_novo_parceiro").validate({
                    rules: {                        
                        nome: {
                            required: true
                        }
                    },
                    messages: {
                        nome: {
                            required: 'É obrigatório definir o nome da empresa'
                        }
                    }

                });
</script>
