<div class="text-center">
    <h3>Editar Documento de Segurança do Trabalho - DST</h3>
    <?php if ($this->session->flashdata('unchecked')) { ?>
        <div class="alert alert-success alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>ATENÇÃO!</strong> Erro ao editar o relatório.
        </div>
    <?php } ?>
</div>
<!-- class="form-horizontal"  -->
<form id="form_edit_apr" method="post" action="<?php echo site_url('relatorio_painel/salvar_edit_pcmat'); ?>">
<div class="form-row">
    <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
        <div class="col-md-12">
            <div class="form-group">
                <label for="idrel" class="control-label col-md-4">Código:</label>
                <div class="col-md-8">
                    <input readonly type="text" class="form-control" id="idrel" name="idrel" value="<?php echo $relatorio->id;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="cliente">Selecione o Cliente</label>
                <select class="form-control" id="cliente" name="cliente">
                    <option value="<?php echo $relatorio->id_cliente ?>"><?php echo $relatorio->empresa ?></option>
                    <?php foreach ($clientes as $client) { ?>
                        <option value="<?php echo $client->id ?>"><?php echo $client->empresa; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="obra" class="control-label col-md-4">Obra:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="obra" name="obra" placeholder="Função" value="<?php echo $relatorio->obra;?>">
                </div>
            </div>
            <div class="form-group">
                <label for="local" class="control-label col-md-4">Local:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="local" name="local" placeholder="Unidade" value="<?php echo $relatorio->local;?>">
                </div>
            </div>            
            <div class="form-group">
                <label for="data_rel" class="control-label col-md-4">Data:</label>
                <div class="col-md-8">
                    <input type="date" class="form-control" id="data_rel" name="data_rel" placeholder="Data" value="<?php echo $relatorio->data;?>">
                </div>
            </div>
            <table style="width: 100%;border-spacing: 0px; margin-bottom:20px;">
                <tbody>
                    <tr><td style="text-align:left;">ASSUNTOS ABORDADOS:</td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_01" <?php echo $array_info->as_1?>>01 - Uso de Epi's; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_02" <?php echo $array_info->as_2?>>02 - Condições e utilização das ferramentas manuais, elétricas e pneumáticas; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_03" <?php echo $array_info->as_3?>>03 - Trabalhos em altura; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_04" <?php echo $array_info->as_4?>>04 - Condições e utilização de equipamentos para trabalho a quente. (solda, corte e outros); </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_05" <?php echo $array_info->as_5?>>05 - Inspeção de andaimes; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_06" <?php echo $array_info->as_6?>>06 - Atenção na utilização de equipamentos elétricos; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_07" <?php echo $array_info->as_7?>>07 - Espaço confinado; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_08" <?php echo $array_info->as_8?>>08 - APR - Analisar os riscos antes do início das atividades; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_09" <?php echo $array_info->as_9?>>09 - Içamento e transporte de cargas que serão suspensas; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_10" <?php echo $array_info->as_10?>>10 - Serviços com equipamentos especiais (cadeira suspensa, linha de vida, jaú, pontos de ancoragem); </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_11" <?php echo $array_info->as_11?>>11 - Limpeza, remoção de entulhos. Manter a sua área limpa e desobstruída; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_12" <?php echo $array_info->as_12?>>12 - Sinalização de segurança; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_13" <?php echo $array_info->as_13?>>13 - Cumprimento das normas de segurança; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_14" <?php echo $array_info->as_14?>>14 - Trabalho em equipe; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_15" <?php echo $array_info->as_15?>>15 - DDS; </input></td></tr>
                    <tr><td style="border:0;text-align:left;"><input type="checkbox" id="as_16" <?php echo $array_info->as_16?>>16 - Outros(especificar); </input></td></tr>
                </tbody>
            </table>      
            <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <label for="outros">(16) Outros</label>
                    <input type="text" id="outros" name="outros" class ="form-control" value ="<?php echo $array_info->outros?>">
                </div>
            </div>
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
<script src="<?php echo base_url('js/bootbox.min.js'); ?>"></script>

<script>
// just for the demos, avoids form submit

    $("#form_edit_cliente").validate({
        rules: {
            cliente: {
                required: true
            },
            obra: {
                required: true
            },
            local: {
                required: true
            },
            data: {
                required: true
            },
            nometst: {
                required: true
            }
        },
        messages: {
            cliente: {
                required: 'É obrigatório incluir o cliente'
            },
            obra: {
                required: 'É obrigatório incluir o nome da obra'
            },
            local: {
                required: 'É obrigatório incluir o local da obra'
            },
            data: {
                required: 'É obrigatório incluir a data do relatório'
            },
            nometst: {
                required: 'É obrigatório definir o responável do relatório'
            }
        }
    });
</script>

<script>
    var array_rel = [];

     $("#form_edit_apr").submit(function (e) {
        e.preventDefault();
        var input = $("<input>").attr("type", "hidden").attr("name", "count_rel").val(array_rel.length);
        jQuery(this).append(input);
        var postData = jQuery(this).serialize();
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar_edit_pcmat') ?>",
                    type: "POST",
                    data: {postData, obs:'', nometst:''},
                    dataType: "json",
                    success: function (dados)
                    {
                        salvarassuntos(postData);
                        salvareditApr(postData);
                        // console.log(dados);
                        // if (dados.msg == true) {
                            
                        // } else {
                            
                        //     bootbox.alert('É necessário preencher todos os campos');
                        // }
                    },
                    error: function ()
                    {
                        alert('Erro ao editar este relatorio!');
                    }
                });
    });

     function salvareditApr(postData){
        $.ajax(
            {
                url: "<?php echo site_url('relatorio_painel/salvar_edit_dst') ?>",
                type: "POST",
                data: postData,
                dataType: "json",
                success: function (dados)
                {
                    console.log(dados);
                    
                    // if (dados.msg == true) {
                    //     salvarassuntos(postData);
                        
                    // } else {
                    //     bootbox.alert('É necessário preencher todos os campos');
                    // }
                },
                error: function (xhr)
                {
                    console.log(xhr.responseText);
                }
            });
    };

    function salvarassuntos(postData){
        var Ias_1 = document.getElementById("as_01");
        var Ias_2 = document.getElementById("as_02");
        var Ias_3 = document.getElementById("as_03");
        var Ias_4 = document.getElementById("as_04");
        var Ias_5 = document.getElementById("as_05");
        var Ias_6 = document.getElementById("as_06");
        var Ias_7 = document.getElementById("as_07");
        var Ias_8 = document.getElementById("as_08");
        var Ias_9 = document.getElementById("as_09");
        var Ias_10 = document.getElementById("as_10");
        var Ias_11 = document.getElementById("as_11");
        var Ias_12 = document.getElementById("as_12");
        var Ias_13 = document.getElementById("as_13");
        var Ias_14 = document.getElementById("as_14");
        var Ias_15 = document.getElementById("as_15");
        var Ias_16 = document.getElementById("as_16");
        var outros = document.getElementById("outros").value;
        as_1 = Ias_1.checked;
        as_2 = Ias_2.checked;
        as_3 = Ias_3.checked;
        as_4 = Ias_4.checked;
        as_5 = Ias_5.checked;
        as_6 = Ias_6.checked;
        as_7 = Ias_7.checked;
        as_8 = Ias_8.checked;
        as_9 = Ias_9.checked;
        as_10 = Ias_10.checked;
        as_11 = Ias_11.checked;
        as_12 = Ias_12.checked;
        as_13 = Ias_13.checked;
        as_14 = Ias_14.checked;
        as_15 = Ias_15.checked;
        as_16 = Ias_16.checked;

        as_1 = (as_1)?'checked': 'unchecked';
        as_2 = (as_2)?'checked': 'unchecked';
        as_3 = (as_3)?'checked': 'unchecked';
        as_4 = (as_4)?'checked': 'unchecked';
        as_5 = (as_5)?'checked': 'unchecked';
        as_6 = (as_6)?'checked': 'unchecked';
        as_7 = (as_7)?'checked': 'unchecked';
        as_8 = (as_8)?'checked': 'unchecked';
        as_9 = (as_9)?'checked': 'unchecked';
        as_10 = (as_10)?'checked': 'unchecked';
        as_11 = (as_11)?'checked': 'unchecked';
        as_12 = (as_12)?'checked': 'unchecked';
        as_13 = (as_13)?'checked': 'unchecked';
        as_14 = (as_14)?'checked': 'unchecked';
        as_15 = (as_15)?'checked': 'unchecked';
        as_16 = (as_16)?'checked': 'unchecked';

        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar_edit_assunto') ?>",
                    type: "POST",
                    data: {as_1: as_1,as_2: as_2,as_3: as_3,as_4: as_4,as_5: as_5,as_6: as_6,as_7: as_7,as_8: as_8,as_9: as_9,as_10: as_10,as_11: as_11, as_12: as_12,as_13: as_13,as_14: as_14,as_15: as_15,as_16: as_16,outros: outros,
                        postData},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                        bootbox.alert('Relatório editado com sucesso', function(){
                        history.back();
                        });
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
    };

</script>