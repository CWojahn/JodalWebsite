<div class="row">
    <div class="col-md-offset-3 col-md-6 text-center">
        <div class="page-header">
            <h3>Buscar certificado</h3>
            <span>Preencha apenas um dos campos</span>
        </div>


        <form class="form-horizontal" id="form_certificado" method="post">
            <div class="form-group">
                <label for="aluno" class="col-sm-5 col-md-4 control-label">Nome do participante</label>
                <div class="col-sm-5 col-md-7">
                    <input type="text" class="form-control input-jodal" id="aluno" name="aluno" placeholder="Digite aqui">
                </div>
            </div>
            <!--<div class="form-group">
                <label for="cpf" class="col-sm-5 col-md-4 control-label">CPF</label>
                <div class="col-sm-5 col-md-7">
                    <input type="text" class="form-control input-jodal" id="cpf" name="cpf" placeholder="Digite aqui">
                </div>
            </div>-->
            <div class="form-group">
                <label for="rit" class="col-sm-5 col-md-4 control-label">Número RIT</label>
                <div class="col-sm-5 col-md-7">
                    <input type="text" class="form-control input-jodal" id="rit" name="rit" placeholder="Digite aqui">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-sm-10 text-center">
                    <button type="submit" class="btn btn-jodal">BUSCAR</button>
                </div>
            </div>
        </form>
        <div id="result">

        </div> 

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificado</h4>
            </div>
            <div class="modal-body">
                <div id="result_cert">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script>
// just for the demos, avoids form submit
    jQuery(function ($) {
        $("#cpf").mask("999.999.999-99");
    });
    function buscar_certificado(id) {
        console.log(id);
        $.ajax(
                {
                    url: "<?php echo site_url('certificados/buscar_cert') ?>",
                    type: "POST",
                    data: {cod: id},
                    success: function (dados)
                    {
                        //if (dados.sucesso == true) {
                        //    console.log('true');
                        $("#result_cert").html(dados);
                        $('#myModal').modal('show')
                        //} else {
                        //    console.log('false');
                        //    $("#result").html('<div class="alert alert-danger" role="alert">' + dados.msg + '</div>');
                        // }
                    },
                    error: function ()
                    {
                        console.log('ERROR');
                    }
                });
    }
    $("#form_certificado").submit(function (e) {
        e.preventDefault();
        var postData = jQuery(this).serialize();
        $("#result").html('<img src="<?php echo base_url('img/loader.gif'); ?>">');
        $.ajax(
                {
                    url: "<?php echo site_url('certificados/buscar') ?>",
                    type: "POST",
                    data: postData,
                    success: function (dados)
                    {
                        //if (dados.sucesso == true) {
                        //    console.log('true');
                        $("#result").html(dados);
                        //} else {
                        //    console.log('false');
                        //    $("#result").html('<div class="alert alert-danger" role="alert">' + dados.msg + '</div>');
                        // }
                    },
                    error: function ()
                    {
                        $("#result").html('<div class="alert alert-danger" role="alert">Erro inesperado, tente novamente.</div>');
                    }
                });
    });

</script>