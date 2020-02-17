<hr>
<div class="panel panel-warning">
    <div class="panel-heading">
        <strong>Editar Produto</strong>
    </div>
    <div class="panel-body">
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-success alert-danger text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

        <form id="form_editar_produto" method="post" action="<?php echo site_url('acessoria_painel/serv_editar_submit') ?>" enctype="multipart/form-data">
            <input type="text" name="id_servico" id="id_servico" hidden value="<?php echo $servico->id; ?>">
            <div class="row">
                <div class="form-group col-md-4 col-md-offset-4">
                    <label class="col-md-4" for="categoria">Tipo</label>
                    <select class="input-sm col-md-8" id="categoria" name="categoria">
                        <?php foreach ($categorias as $value) { ?>
                            <option value="<?php echo $value->id; ?>" <?php echo $value->id == $servico->categoria ? 'selected' : ''; ?>><?php echo $value->nome; ?></option>
                        <?php } ?>

                    </select>

                </div>
                <div class="form-group col-md-4 col-md-offset-4">

                    <label class="col-md-4" for="estilo">Estilo</label>
                    <select class="input-sm col-md-8" id="estilo" name="estilo">
                        <option value="1" <?php echo $servico->estilo == "1" ? 'selected' : ''; ?>>Selos</option>
                        <option value="2" <?php echo $servico->estilo == "2" ? 'selected' : ''; ?>>Texto</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3 col-sm-6">

                <div class="form-group">
                    <label for="selo">Selo</label>
                    <input type="file" id="selo" name="selo" onchange="PreviewImage();" accept="image/*">
                    <div class="text-center">
                        <img id="uploadPreview" style="width: 150px; height: 150px;" src="<?php echo base_url('uploads/acessoria/servico/' . $servico->selo); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Serviço" value="<?php echo $servico->nome; ?>">
                </div>
                <div class="form-group">
                    <label for="desc_curta">Descrição curta</label>
                    <textarea class="form-control" id="desc_curta" name="desc_curta" placeholder="Descrição curta do Serviço" rows="4" maxlength="120"><?php echo $servico->desc_curta; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="desc_completa">Descrição completa</label>
                    <textarea class="form-control" id="desc_completa" name="desc_completa" placeholder="Descrição completa do Serviço" rows="10"><?php echo $servico->desc_completa; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="arquivo">Arquivo de descrição do serviço</label>
                    <input type="file" id="arquivo" name="arquivo" accept="application/pdf">
                    <?php if ($servico->arquivo != NULL) { ?><a href="<?php echo base_url('uploads/acessoria/grades/' . $servico->arquivo); ?>" target="_blank" ><img src="<?php echo base_url('img/pdf-icon.png') ?>" style="height: 64px; width: 64px; margin-top: 10px"><?php echo $servico->arquivo; ?><?php } ?></a>
                </div>

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
                        $('#desc_curta').maxlength({
                            alwaysShow: true
                        });
                        $("#form_novo_treinamento").validate({
                            rules: {
                                nome: {
                                    required: true
                                },
                                selo: {
                                    required: true
                                },
                                desc_curta: {
                                    required: true
                                },
                                desc_completa: {
                                    required: true
                                }
                            },
                            messages: {
                                nome: {
                                    required: 'É obrigatório definir o nome do produto'
                                },
                                selo: {
                                    required: 'É obrigatório incluir um selo'
                                },
                                desc_curta: {
                                    required: 'É obrigatório uma descrição breve do produto'
                                },
                                desc_completa: {
                                    required: 'É obrigatório uma descrição detalhada do produto'
                                }
                            }

                        });
                        function PreviewImage() {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById("selo").files[0]);

                            oFReader.onload = function (oFREvent) {
                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                            };
                        }
                        ;
</script>