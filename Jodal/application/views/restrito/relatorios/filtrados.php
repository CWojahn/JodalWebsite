<?php setlocale(LC_ALL, 'pt_BR'); ?>
                <?php
                if (isset($relatorios)) {
                    foreach ($relatorios as $relatorio) {
                        ?>
                        <tr>
                            <td class="text-center" style="width: 20%;">
                                <a onclick="gerapdf(<?php echo $relatorio->id;?>, '<?php echo $relatorio->tipo;?>')" class="btn btn-success" title="Imprimir" target="_blank"><span class="glyphicon glyphicon-print"></span></a>
                                <a onclick="enviar(<?php echo $relatorio->id;?>, '<?php echo $relatorio->email;?>');" class="btn btn-success" title="Enviar" style="cursor: pointer"><span class="glyphicon glyphicon-envelope"></span></a>                                
                                <a onclick="excluir(<?php echo $relatorio->id; ?>);" style="cursor: pointer;" class="btn btn-danger" title="Excluir"><span class="glyphicon glyphicon-remove"></span> </a>
                            </td>
                            <td class="text-center" style="width: 5%;"><?php echo $relatorio->id; ?></td>
                            <td class="text-center" style="width: 5%;"><?php echo date("d/m/Y", strtotime($relatorio->data)); ?></td>
                            <td class="text-center" style="width: 20%;"><?php echo $relatorio->obra; ?></td>
                            <td class="text-center" style="width: 5%;"><?php echo $relatorio->local; ?></td>
                            <td class="text-center" style="width: 35%;"><?php echo $relatorio->empresa; ?></td>
                            <td class="text-center" style="width: 10%;"><?php echo $relatorio->tipo; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>