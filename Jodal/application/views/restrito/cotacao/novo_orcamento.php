<?php setlocale(LC_ALL, 'pt_BR'); ?>
<tr>
    <td><?php echo $count_orc; ?></td>
    <td><?php echo strip_tags($sel_treinamento->nome_pt); ?></td>
    <td id="nalunos_<?php echo $count_orc; ?>"><?php echo $nro_alunos; ?></td>
    <td id="valor_<?php echo $count_orc; ?>" contenteditable='true'><?php echo number_format($sel_treinamento->valor_aluno, 2, ',', '.'); ?></td>
    <td><button class="btn btn-default btn-sm" onclick="updateOrc(<?php echo $count_orc; ?>,<?php echo $sel_treinamento->id; ?>)"><span class="glyphicon glyphicon-refresh"></span></button></td>
    <td id="total_<?php echo $count_orc; ?>"><strong><?php echo money_format("%.2n", $sel_treinamento->valor_aluno * $nro_alunos); ?></strong></td>
</tr>