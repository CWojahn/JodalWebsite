<div class="text-center">
    <h3>Editar treinamento</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('unchecked'); ?>
        </div>
    <?php } ?>
</div>
<form id="form_novo_treinamento" method="post" action="<?php echo site_url('treinamento_painel/salvar_edit'); ?>" enctype="multipart/form-data" >
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <input type="text" id="id" name="id" value="<?php echo $treinamentos->id; ?>" hidden="">
            <div class="text-center">
                <input type="checkbox" id="check_pt" name="check_pt" <?php echo $treinamentos->versao_pt ? 'checked' : ''; ?> >
                <img src="<?php echo base_url('img/brasil-icon.png'); ?>" height="48">
            </div>
            <div class="form-group">
                <label for="selo_pt">Selo do Treinamento</label>
                <input type="file" id="selo_pt" name="selo_pt"  <?php echo $treinamentos->versao_pt ? '' : 'disabled'; ?> accept="image/*" onchange="PreviewImage_pt();">
                <div class="text-center">
                    <img id="uploadPreview_pt" style="width: 150px; height: 150px;" src="<?php echo base_url('uploads/selos/' . $treinamentos->selo_pt); ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="nome_pt">Nome</label>
                <input type="text" class="form-control" <?php echo $treinamentos->versao_pt ? '' : 'disabled'; ?> id="nome_pt" name="nome_pt" placeholder="Nome do Treinamento" value="<?php echo $treinamentos->nome_pt; ?>">
            </div>
            <div class="form-group">
                <label for="desc_curta_pt">Descrição curta</label>
                <textarea class="form-control" <?php echo $treinamentos->versao_pt ? '' : 'disabled'; ?> id="desc_curta_pt" name="desc_curta_pt" placeholder="Descrição curta do treinamento" rows="4" maxlength="120"><?php echo $treinamentos->descricao_curta_pt; ?></textarea>
            </div>
            <div class="form-group">
                <label for="desc_completa_pt">Descrição completa</label>
                <textarea class="form-control" <?php echo $treinamentos->versao_pt ? '' : 'disabled'; ?> id="desc_completa_pt" name="desc_completa_pt" placeholder="Nome do Treinamento" rows="10"><?php echo $treinamentos->descricao_pt; ?></textarea>
            </div>
            <div class="form-group">
                <label for="grade_pt">Arquivo de descrição do treinamento</label>
                <input type="file" id="grade_pt" name="grade_pt" <?php echo $treinamentos->versao_pt ? '' : 'disabled'; ?> accept="application/pdf">
                <a href="<?php echo base_url('uploads/grades/' . $treinamentos->grade_curso_pt); ?>" target="_blank" ><img src="<?php echo base_url('img/pdf-icon.png') ?>" style="height: 64px; width: 64px; margin-top: 10px"><?php echo $treinamentos->grade_curso_pt; ?></a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="text-center">
                <input type="checkbox" id="check_en" name="check_en" <?php echo $treinamentos->versao_en ? 'checked' : ''; ?>>
                <img src="<?php echo base_url('img/eua-icon.png'); ?>" height="48">
            </div>
            <div class="form-group">
                <label for="selo_en">Selo do Treinamento</label>
                <input type="file" id="selo_en" name="selo_en" onchange="PreviewImage_en();" accept="image/*" <?php echo $treinamentos->versao_en ? '' : 'disabled'; ?>>
                <div class="text-center">
                    <img id="uploadPreview_en" style="width: 150px; height: 150px;" src="<?php echo isset($treinamentos->selo_en) ? base_url('uploads/selos/' . $treinamentos->selo_en) : ''; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="nome_en">Nome</label>
                <input type="text" class="form-control" id="nome_en" name="nome_en" placeholder="Nome do Treinamento" <?php echo $treinamentos->versao_en ? '' : 'disabled'; ?> value="<?php echo isset($treinamentos->nome_en) ? $treinamentos->nome_en : ''; ?>">
            </div>
            <div class="form-group">
                <label for="desc_curta_en">Descrição curta</label>
                <textarea class="form-control" id="desc_curta_en" name="desc_curta_en" placeholder="Descrição curta do treinamento" rows="4" <?php echo $treinamentos->versao_en ? '' : 'disabled'; ?> maxlength="120"><?php echo isset($treinamentos->descricao_curta_en) ? $treinamentos->descricao_curta_en : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="desc_completa_en">Descrição completa</label>
                <textarea class="form-control" id="desc_completa_en" name="desc_completa_en" placeholder="Nome do Treinamento" rows="10" <?php echo $treinamentos->versao_en ? '' : 'disabled'; ?>><?php echo isset($treinamentos->descricao_en) ? $treinamentos->descricao_en : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="grade_en">Arquivo de descrição do treinamento</label>
                <input type="file" id="grade_en" name="grade_en" <?php echo $treinamentos->versao_en ? '' : 'disabled'; ?> accept="application/pdf">
                <?php if (isset($treinamentos->grade_curso_en)) { ?>
                    <a href="<?php echo base_url('uploads/grades/' . $treinamentos->grade_curso_en); ?>" target="_blank"><img src="<?php echo base_url('img/pdf-icon.png') ?>" style="height: 64px; width: 64px;"><?php echo $treinamentos->grade_curso_en; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-5 col-md-2 col-sm-12">
            <div class="form-group">
                <label for="custo">Valor por aluno(R$)</label>
                <input type="text" class="form-control text-center" id="custo" name="custo" placeholder="Custo por aluno" value="<?php echo $treinamentos->valor_aluno; ?>">
            </div>
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
<script src="<?php echo base_url('js/jquery.maskMoney.min.js'); ?>"></script>

<script>
// just for the demos, avoids form submit
//               var maxLength = 120;
//                $('#desc_curta_pt').keyup(function () {
//                    var length = $(this).val().length;
//                    var length = maxLength - length;
//                    $('#chars_pt').text(length);
//                });
                    $("#custo").maskMoney({
                        prefix: 'R$ ', 
                        allowNegative: true, 
                        thousands: '.', 
                        decimal: ',', 
                        affixesStay: false
                    });
                    $('#desc_curta_pt, #desc_curta_en').maxlength({
                        alwaysShow: true
                    });

                    $("#form_novo_treinamento").validate({
                        rules: {
                            selo_pt: {
                                required: false
                            },
                            nome_pt: {
                                required: true
                            },
                            desc_curta_pt: {
                                required: true
                            },
                            desc_completa_pt: {
                                required: true
                            },
                            grade_pt: {
                                required: false
                            },
                            selo_en: {
                                required: false
                            },
                            nome_en: {
                                required: true
                            },
                            desc_curta_en: {
                                required: true
                            },
                            desc_completa_en: {
                                required: true
                            },
                            grade_en: {
                                required: false
                            }
                        },
                        messages: {
                            selo_pt: {
                                required: 'É obrigatório incluir um selo para o treinamento'
                            },
                            nome_pt: {
                                required: 'É obrigatório definir o nome do treinamento'
                            },
                            desc_curta_pt: {
                                required: 'É obrigatório uma descrição breve do treinamento'
                            },
                            desc_completa_pt: {
                                required: 'É obrigatório uma descrição detalhada do treinamento'
                            },
                            grade_pt: {
                                required: 'É obrigatório definir a grade para o treinamento'
                            },
                            selo_en: {
                                required: 'É obrigatório incluir um selo para o treinamento'
                            },
                            nome_en: {
                                required: 'É obrigatório definir o nome do treinamento'
                            },
                            desc_curta_en: {
                                required: 'É obrigatório uma descrição breve do treinamento'
                            },
                            desc_completa_en: {
                                required: 'É obrigatório uma descrição detalhada do treinamento'
                            },
                            grade_en: {
                                required: 'É obrigatório definir a grade para o treinamento'
                            }
                        }

                    });
</script>
<script type="text/javascript">
    $("#check_en").click(function () {
        if ($("#check_en").is(":checked")) {
            //console.log('checado');
            $('#selo_en').removeAttr('disabled');
            $('#nome_en').removeAttr('disabled');
            $('#desc_curta_en').removeAttr('disabled');
            $('#desc_completa_en').removeAttr('disabled');
            $('#grade_en').removeAttr('disabled');

        } else {
            //console.log('não checado');
            $('#selo_en').attr('disabled', 'true');
            $('#nome_en').attr('disabled', 'true');
            $('#desc_curta_en').attr('disabled', 'true');
            $('#desc_completa_en').attr('disabled', 'true');
            $('#grade_en').attr('disabled', 'true');
        }
    });
    $("#check_pt").click(function () {
        if ($("#check_pt").is(":checked")) {
            //console.log('checado');
            $('#selo_pt').removeAttr('disabled');
            $('#nome_pt').removeAttr('disabled');
            $('#desc_curta_pt').removeAttr('disabled');
            $('#desc_completa_pt').removeAttr('disabled');
            $('#grade_pt').removeAttr('disabled');

        } else {
            //console.log('não checado');
            $('#selo_pt').attr('disabled', 'true');
            $('#nome_pt').attr('disabled', 'true');
            $('#desc_curta_pt').attr('disabled', 'true');
            $('#desc_completa_pt').attr('disabled', 'true');
            $('#grade_pt').attr('disabled', 'true');
        }
    });
</script>
<script type="text/javascript">
    function PreviewImage_pt() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("selo_pt").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview_pt").src = oFREvent.target.result;
        };
    }
    ;
    function PreviewImage_en() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("selo_en").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview_en").src = oFREvent.target.result;
        };
    }
    ;
</script>