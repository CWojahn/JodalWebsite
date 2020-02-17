<div class="text-center">
    <h3>Editar Material de Apoio</h3>
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>
<form id="form_editar_parceiro" method="post" action="<?php echo site_url('material_painel/salvar_edit'); ?>" enctype="multipart/form-data" >
    <div class="col-md-offset-3 col-md-6 col-sm-6">
        <input type="text" id="id" name="id" value="<?php echo $material->id; ?>" hidden="">
        <div class="form-group">
            <label for="imagem">Logo</label>
            <input type="file" id="imagem" name="imagem" accept="application/msword, application/vnd.ms-office, application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/msexcel,application/x-msexcel,application/x-ms-excel,application/x-excel,application/x-dos_ms_excel,application/xls,application/x-xls,application/excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/pdf">
            <a class="icone" href="<?php echo base_url('uploads/acessoria/material/' . $material->arquivo); ?>" target="_blank"><?php echo $material->arquivo; ?></a>
        </div>
        <div class="form-group">
            <label for="nome">Empresa</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da empresa" value="<?php echo $material->nome;?>">
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

                $("#form_editar_parceiro").validate({
                    rules: {
                        imagem: {
                            required: false
                        },
                        nome: {
                            required: true
                        }
                    },
                    messages: {
                        imagem: {
                            required: 'É obrigatório incluir uma imagem para a empresa'
                        },
                        nome: {
                            required: 'É obrigatório definir o nome da empresa'
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
