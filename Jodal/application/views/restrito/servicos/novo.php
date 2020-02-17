<div class="text-center">
    <h3>Cadastrar novo serviço</h3>
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>
<form id="form_novo_servico" method="post" action="<?php echo site_url('servicos_painel/salvar'); ?>" enctype="multipart/form-data" >
    <div class="col-md-offset-3 col-md-6 col-sm-6">
        <div class="form-group">
            <label for="imagem">Imagem</label>
            <input type="file" id="imagem" name="imagem" onchange="PreviewImage_pt();" accept="image/*">
            <div class="text-center">
                <img id="uploadPreview_pt" style="width: 150px; height: 125px;" />
            </div>
        </div>
        <div class="form-group">
            <label for="nome">Título</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Título do serviço">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição do serviço" rows="4"></textarea>
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

                $("#form_novo_servico").validate({
                    rules: {
                        imagem: {
                            required: true
                        },
                        nome: {
                            required: true
                        },
                        descricao: {
                            required: true
                        }
                    },
                    messages: {
                        imagem: {
                            required: 'É obrigatório incluir uma imagem para o serviço'
                        },
                        nome: {
                            required: 'É obrigatório definir o nome do serviço'
                        },
                        descricao: {
                            required: 'É obrigatório uma descrição do serviço'
                        }
                    }

                });
</script>

<script type="text/javascript">
    function PreviewImage_pt() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imagem").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview_pt").src = oFREvent.target.result;
        };
    }
    ;
</script>
