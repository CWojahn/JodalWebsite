<?php setlocale(LC_ALL, 'pt_BR'); ?>

      <tr id="linha<?php echo $ids; ?>">
        <td>
          <img style="width: auto; height: 100px;" src="<?php echo base_url('uploads/relatorios/' . $imagem); ?>"/>
        </td>
        <td>
          <textarea class="form-control" id="descricao" name="descricao"
            placeholder="Descrição da Imagem" rows="4"><?php echo $descricao; ?></textarea>
        </td>
        <td style="text-align: center;"><button class="btn btn-danger"  id="delete" onclick="excluir(<?php echo $ids; ?>)"><span class="glyphicon glyphicon-remove"></span> Excluir</td>
      </tr>


<!-- <img style="width: 150px; height: 150px; margin: 7px;" src="<?php echo base_url('uploads/relatorios/' . $imagem); ?>" />
<p><?php echo $descricao; ?></p>
//increment_string -->