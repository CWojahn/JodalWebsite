<div class="text-center">
    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>
<div class="text-center">
    <h3>Dados do Relatório</h3>
</div>
<div class="form-row">
    <form>
        <div class="form-group row">
        <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-4">
                <label for="data_rel">Data</label>
                <input type="date" id="data_rel" name="data_rel" class ="form-control">
                <label for="local">Local</label>
                <input type="text" id="local" name="local" class ="form-control">
                <label for="obra">Obra</label>
                <input type="text" id="obra" name="obra" class ="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="as_01">01 - Uso de Epi's; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="as_02">02 - Condições e utilização das ferramentas manuais, elétricas e pneumáticas; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_03">03 - Trabalhos em altura; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_04">04 - Condições e utilização de equipamentos para trabalho a quente. (solda, corte e outros); </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_05">05 - Inspeção de andaimes; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_06">06 - Atenção na utilização de equipamentos elétricos; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_07">07 - Espaço confinado; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_08">08 - APR - Analisar os riscos antes do início das atividades; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_09">09 - Içamento e transporte de cargas que serão suspensas; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_10">10 - Serviços com equipamentos especiais (cadeira suspensa, linha de vida, jaú, pontos de ancoragem); </input>
                </div>
            </div>  
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_11">11 - Limpeza, remoção de entulhos. Manter a sua área limpa e desobstruída; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_12">12 - Sinalização de segurança; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_13">13 - Cumprimento das normas de segurança; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_14">14 - Trabalho em equipe; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_15">15 - DDS; </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-10">
                <div class="form-check">
                    <input type="checkbox" id="as_16">16 - Outros(especificar); </input>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class ="form-group col-sm-2"></div>
            <div class ="form-group col-sm-6">
                <div class="form-check">
                    <label for="outros">Outros</label>
                    <input type="text" id="outros" name="outros" class ="form-control">
                </div>
            </div>
        </div>
    </form>
</div>
<hr>
<p style="text-align: center;font-weight: 600;"> Novo Participante</p>
<div class="form-row text-center" style = "width: 100%">
    <form id="form-participante" style="margin-bottom: 15px;">     
        <div class ="form-group col-md-6">
            <label for="nome_par">Nome</label>
            <input type="text" id="nome_par" name="nome_par" class ="form-control">
        </div>
        <div class ="form-group col-md-6">
            <label for="funcao">Função</label>
            <input type="text" id="funcao" name="funcao" class ="form-control">
        </div>
        <div class="col-md-12 col-sm-12 text-center">
            <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_upload" type="submit"><span class="glyphicon glyphicon-plus"></span> Acrescentar Parcipante</button>
        </div>
    </form>
</div>
<hr>
<div class="form-row text-center" style = "width: 100%">
  <form id="form_nova_imagem" style="margin-bottom: 15px;">     
      <div class ="form-group col-md-6">
          <label for="imagem">Imagem</label>
          <input type="file" id="imagem" name="imagem"
          onchange="PreviewImage_pt();" accept="image/*" capture="camera" class="form-control-file">
      </div>
      <div class="form-group col-md-2">
          <img id="uploadPreview_pt" style="width: 150px; height: 125px;" />
      </div>
      <div class="col-md-12 col-sm-12 text-center">
          <button class="btn btn-success" data-loading-text="Incluindo..." id="btn_upload" type="submit"><span class="glyphicon glyphicon-plus"></span> Acrescentar Imagem</button>
      </div>
  </form>
</div>

<div id="imagens1">
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="text-align: center">Imagem</th>
                <th style="text-align: center">Excluir</th>
            </tr>
        </thead>
        <tbody id="imagensadicionadas">
        </tbody>
    </table>
</div>
<hr>
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="text-align: center">Nome</th>
                <th style="text-align: center">Função</th>
                <th style="text-align: center">Excluir</th>
            </tr>
        </thead>
        <tbody id="participantes">
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 text-center">
        <button id="btn_save" class="btn btn-success" onclick="SalvarRelatorio()"><span class="glyphicon glyphicon-floppy-disk"></span> Salvar Relatório</button>
    </div>
</div>

<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>
// just for the demos, avoids form submit

                $("#form_nova_imagem").validate({
                    rules: {
                        imagem: {
                            required: true
                        },
                        descricao: {
                            required: true
                        }
                    },
                    messages: {
                        imagem: {
                            required: 'É obrigatório incluir uma imagem.'
                        },
                        descricao: {
                            required: 'É obrigatório uma descrição da imagem.'
                        }
                    }

                });
</script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#form_nova_imagem').submit(function(e){
            e.preventDefault(); 
            $.ajax({
                url:'<?php echo site_url('relatorio_painel/do_upload') ?>',
                type:"post",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(dados){
                    $('#imagensadicionadas').append(dados);
                    $("#imagem").val(null)
                    $('#uploadPreview_pt').hide();
                }
            });
        });
    });

    $par = 1;
    $(document).ready(function(){
        $('#form-participante').submit(function(e){
            e.preventDefault(); 
            $html = "<tr id=part" + $par + "><td>" + document.getElementById("nome_par").value + "</td><td>" + document.getElementById("funcao").value +"</td><td style='text-align: center;'><button class='btn btn-danger' id='delete' onclick='excluirpart("+ $par +")'><span class='glyphicon glyphicon-remove'></span> Excluir</td></tr>";

            $('#participantes').append($html);
            $par = $par + 1;
        });
    });

    function excluir(id){
        document.getElementById("linha"+id).remove();     
    };

    function PreviewImage_pt() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imagem").files[0]);

        oFReader.onload = function (oFREvent) {
            $('#uploadPreview_pt').show();
            document.getElementById("uploadPreview_pt").src = oFREvent.target.result;
        };
    };

    function excluirpart(id){
        document.getElementById("part"+ id).remove();     
    };

    function SalvarRelatorio(){
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar') ?>",
                    type: "POST",
                    data: {cliente: document.getElementById("cliente").value, obra: document.getElementById("obra").value, data: document.getElementById("data_rel").value, tst: '', obs: '',local: document.getElementById("local").value, tipo: 'DST'},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                        salvardst(dados);
                        salvarAssuntos(dados);
                        salvarImagens(dados);
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
    };

    function salvarAssuntos(dados){
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
                    url: "<?php echo site_url('relatorio_painel/salvarassunto') ?>",
                    type: "POST",
                    data: {as_1: as_1,as_2: as_2,as_3: as_3,as_4: as_4,as_5: as_5,as_6: as_6,as_7: as_7,as_8: as_8,as_9: as_9,as_10: as_10,as_11: as_11, as_12: as_12,as_13: as_13,as_14: as_14,as_15: as_15,as_16: as_16,outros: outros,
                        id_relatorio : dados},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                        console.log(dados);
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
    }

    function salvardst(dados){
        $("#participantes tr").each(function (row,tr) {
        $.ajax(
                {
                    url: "<?php echo site_url('relatorio_painel/salvar_dst') ?>",
                    type: "POST",
                    data: {nome : $(this).find("td").eq(0).text(), 
                        funcao : $(this).find("td").eq(1).text(),
                        id_relatorio : dados},
                    datatype: "json",
                    async:false,
                    success: function(dados){
                      alert('Relatório salvo com sucesso');
                    },
                    error: function(){
                        alert('erro');
                    }
                }
        );
        });
    };

function salvarImagens(dados) {
    let countrows =0;
    let count =0;
    $("#imagensadicionadas tr").each(function (row,tr) {
        $.ajax(               
            {
                url: "<?php echo site_url('relatorio_painel/salvarImagensPcmat') ?>",
                type: "POST",
                data: {image_path : $(this).find("td").eq(0).find("img").attr('src'),
                      observacao:'', id_relatorio : dados},
                datatype: "json",
                async:false,
                success: function(dados){
                    console.log('Imagem ' + row + ' foi cadastrada');
                    count = count+1;
                },
                error: function(){
                    alert('erro');
                }
        });
        countrows = countrows +1;
    });

    if (count == countrows) {
        alert('Todas as imagens foram cadastradas com sucesso.');
    }
};

</script>