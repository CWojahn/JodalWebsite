<hr>
<div class="panel panel-success">
    <div class="panel-heading">
        <strong>Cadastrar Novidade</strong>
    </div>
    <div class="panel-body">
        <span class="help-block text-center">Cadastre a novidade e clique em "Salvar", as imagens deverão ser incluídas na próxima página.</span>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-success alert-danger text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>
        
        <form id="form_novo_artigo1" method="post" enctype="multipart/form-data" action="<?php echo site_url('novidades_painel/submit') ?>">

            <div class="form-group col-md-offset-4 col-md-4">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Título da Novidade">
            </div>

            <div class="form-group col-md-offset-4 col-md-4">
                <label for="desc_curta">Descrição curta</label>
                <textarea class="form-control" id="desc_curta" name="desc_curta" placeholder="Descrição breve da Novidade" rows="5" maxlength="200"></textarea>
            </div>
            <div class="form-group col-md-offset-1 col-md-10">
                <label for="desc_completa">Texto da Novidade</label>
                <textarea class="form-control" id="desc_completa" name="desc_completa" placeholder="Texto completo da Novidade" rows="20"></textarea>
            </div>
            <div class="col-md-12 col-sm-12 text-center">
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Salvar</button>
                <a href="javascript:history.back()" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</a>
            </div>

        </form>

        

    </div>
</div>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="<?php echo base_url('js/bootstrap-maxlength.min.js'); ?>"></script>
<script>
// just for the demos, avoids form submit
    $('#descricao').maxlength({
        alwaysShow: true
    });
    $("#form_novo_evento").validate({
        rules: {
            nome: {
                required: true
            },
            data: {
                required: true
            },
            cidade: {
                required: true
            },
            descricao: {
                required: true
            }
        },
        messages: {
            nome: {
                required: 'É obrigatório definir o nome do evento'
            },
            data: {
                required: 'É obrigatório definir a data do evento'
            },
            cidade: {
                required: 'É obrigatório informar a cidade'
            },
            descricao: {
                required: 'É obrigatório descrever o evento'
            }

        }

    });
</script>