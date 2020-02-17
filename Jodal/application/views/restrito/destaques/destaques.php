<div class="col-md-12 col-sm-12">

    <div class="col-md-5 col-sm-5">
        <div class="form-group col-md-12 col-sm-12">
            <label for="disp">Todos os treinamentos do site</label>

            <div>
                <select id="prod_disp" name="prod_disp" class="dropdown-toggle form-control text-center" size="10">
                    <?php foreach ($treinamentos_disp as $prod_disp) { ?>
                        <option value="<?php echo $prod_disp->id ?>"><?php echo $prod_disp->nome_pt ?></option>     
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-2 text-center">
        <div class="row"><br></div><div class="row"><br></div><div class="row"><br></div>
        <div class="row">
            <button id="bt_libera" class="btn btn-success" title="Adicionar treinamento aos destaques do site"><span id="span_btn" class="glyphicon glyphicon-forward"></span></button>
        </div>
        <br>
        <div class="row">
            <button id="bt_remove" class="btn btn-danger" title="Remover treinamento dos destaques"><span id="span_btn" class="glyphicon glyphicon-remove"></span></button>
        </div>
    </div>

    <div class="col-md-5 col-sm-5">
        <div id="vers_liberadas" class="form-group col-md-12 col-sm-12"><div><label for="prods_destaques">Treinamentos em destaque</label>
                <select id="prods_destaques" name="prods_destaques" class="dropdown-toggle form-control text-center" size="10">
                    <?php foreach ($treinamentos_dest as $prod_dest) { ?>
                        <option value="<?php echo $prod_dest->id ?>"><?php echo $prod_dest->nome_pt ?></option>     
                    <?php } ?>
                </select></div></div>
    </div>
</div>

<script type="text/javascript">

    $("#bt_libera").click(function() {
        $.ajax(
                {
                    url: "<?php echo site_url('destaques_painel/set_destaque') ?>",
                    type: "POST",
                    data: {id: $("#prod_disp").val()},
                    success: function(dados)
                    {
                        $('#prods_destaques').html(dados);
                    },
                    error: function()
                    {
                        console.log('ERROR');
                    }
                });
    });
    
    $("#bt_remove").click(function() {
        $.ajax(
                {
                    url: "<?php echo site_url('destaques_painel/remove_destaque') ?>",
                    type: "POST",
                    data: {id: $("#prods_destaques").val()},
                    success: function(dados)
                    {
                        $('#prods_destaques').html(dados);
                    },
                    error: function()
                    {
                        console.log('ERROR');
                    }
                });
    });

</script>