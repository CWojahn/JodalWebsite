<hr>
<div class="panel panel-success">
    <div class="panel-heading">
        <strong>Cadastrar novo Serviço</strong>
    </div>
    <div class="panel-body">
        <span class="help-block text-center">Cadastre o serviço e clique em "Salvar", irá aparecer o formulário para carregar as imagens do serviço logo abaixo.</span>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-success alert-danger text-center" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php } ?>

        <form id="form_novo_produto" method="post" action="<?php echo site_url('acessoria_painel/serv_novo_submit'); ?>" enctype="multipart/form-data">

            <div class="row">
                <div class="form-group col-md-4 col-md-offset-4">

                    <label class="col-md-4" for="categoria">Categoria</label>
                    <select class="input-sm col-md-8" id="categoria" name="categoria">
                        <?php foreach ($categorias as $value) { ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->nome; ?></option>
                        <?php } ?>

                    </select>

                </div>
                <div class="form-group col-md-4 col-md-offset-4">

                    <label class="col-md-4" for="estilo">Estilo</label>
                    <select class="input-sm col-md-8" id="estilo" name="estilo">
                        <option value="1">Selos</option>
                        <option value="2">Texto</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3 col-sm-6">

                <div class="form-group">
                    <label for="selo">Selo</label>
                    <input type="file" id="selo" name="selo" onchange="PreviewImage();" accept="image/*">
                    <div class="text-center">
                        <img id="uploadPreview" style="width: 150px; height: 150px;" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Serviço">
                </div>
                <div class="form-group">
                    <label for="desc_curta">Descrição curta</label>
                    <textarea class="form-control" id="desc_curta" name="desc_curta" placeholder="Descrição curta do Serviço" rows="4" maxlength="120"></textarea>
                </div>
                <div class="form-group">
                    <label for="desc_completa">Descrição completa</label>
                    <textarea class="form-control" id="desc_completa" name="desc_completa" placeholder="Descrição completa do serviço" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="arquivo">Arquivo de descrição do serviço</label>
                    <input type="file" id="arquivo" name="arquivo" accept="application/pdf">
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
                        $("#form_novo_produto").validate({
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
                                    required: 'É obrigatório definir o nome do serviço'
                                },
                                selo: {
                                    required: 'É obrigatório incluir um selo'
                                },                                
                                desc_curta: {
                                    required: 'É obrigatório uma descrição breve do serviço'
                                },
                                desc_completa: {
                                    required: 'É obrigatório uma descrição detalhada do serviço'
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

