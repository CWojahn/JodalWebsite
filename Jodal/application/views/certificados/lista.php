
<?php if ($sucesso == TRUE) { ?>
    <div class="alert alert-success" role="alert"><?php echo $rows ?> registros encontrados!</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <!--<th class="text-center" style="width: 10%;">#</th>-->
                <th class="text-center" style="width: 20%;">Visualizar</th>
                <th class="text-center" style="width: 40%;">Aluno</th>
                <th class="text-center" style="width: 40%;">Treinamento</th>

            </tr>
        </thead>

        <tbody>
            <?php foreach ($certificados as $cert) { ?>

                <tr>
                    <!--<td class="text-center" style="width: 10%;"><input type="radio" name="radio" required value="<?php// echo $cert->id; ?>"></td>-->
                    <td class="text-center" style="width: 20%;">
                        <button class="btn btn-default" title="Visualizar" onclick="buscar_certificado(<?php echo $cert->id;?>)"><span class="glyphicon glyphicon-list-alt"></span></button>                            
                    </td>
                    <td class="text-center" style="width: 40%;"><?php echo $cert->aluno_nome; ?></td>
                    <td class="text-center" style="width: 40%;"><?php echo strip_tags($cert->nome_pt); ?></td>

                </tr>

            <?php } ?>
        </tbody>

    </table>
<?php } else { ?>
    <div class="alert alert-danger" role="alert"><?php echo $msg ?></div>
<?php
} 
