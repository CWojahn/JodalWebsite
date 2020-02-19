<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <htmlpageheader>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles.css'); ?>">
        <style type="text/css">

            @page {
                margin-top: 0.0cm;
                margin-bottom: 0.0cm;
                margin-left: 1.0cm;
                margin-right: 1.0cm;
                background-color:#ffffff;
            }
            
            html, body{
              font-family: Arial, Helvetica, sans-serif;
            }
            .text-uppercase {
              font-weight:600;
              font-size: 12px;
            }
            .divTable{
              display: table;
              width: 100%;
              height: 100px;
            }
            .divTableRow {
              display: table-row;
            }
            .divTableHeading {
              background-color: #EEE;
              display: table-header-group;
            }
            .divTableCell, .divTableHead {
              border: 1px solid #999999;
              display: table-cell;
              padding: 3px 10px;
              text-align: center;
            }
            .divTableHeading {
              background-color: #EEE;
              display: table-header-group;
              font-weight: bold;
            }
            .divTableFoot {
              background-color: #EEE;
              display: table-footer-group;
              font-weight: bold;
            }
            .divTableBody {
              display: table-row-group;
            }

            .emailsitem span{
              position: relative;
              left: -30%;
            }
        </style>
    </htmlpageheader>

    <?php setlocale(LC_ALL, 'pt_BR'); ?>
    <div class="row">
      <div class="divTable">
        <div class="divTableBody">
          <div class="divTableRow"style="padding: 0; border-spacing:0">
            <div class="divTableCell" style="vertical-align: middle;">
              <img src="<?php echo base_url('./img/logo_relatorio.jpg');?>"" alt="" style="width: 75px;" srcset="">
            </div>
            <div class="divTableCell"style="vertical-align: middle;">
              <p style="font-weight: 600;">Relatório fotográfico das <br> Melhorias a serem Implantadas no canteiro de obra.</p>
            </div>
            <div class="divTableCell"style="padding: 0; border-spacing:0; border:0">
              <div class="divTable"style="margin: 0; border-spacing:0" >
                <div class="divTableRow">
                  <div class="divTableCell"style="margin: 0; border-spacing:0; text-align: left">
                    <p>N°: {04054}</p> 
                  </div>
                </div>
                <div class="divTableRow">
                  <div class="divTableCell"style="margin: 0; border-spacing:0; text-align: left">
                    <p>Classificação: Uso Interno</p> 
                  </div>
                </div>
              </div>
            </div>
            <div class="divTableCell"style="padding: 0; border-spacing:0; border:0">
              <div class="divTable"style="margin: 0; border-spacing:0"  >
                <div class="divTableRow" >
                  <div class="divTableCell"style="margin: 0; border-spacing:0; text-align: left">
                    <p>Página: {$1} de {$2}</p>
                  </div>
                </div>
                <div class="divTableRow">
                  <div class="divTableCell"style="margin: 0; border-spacing:0; text-align: left">
                    <p>Rev.: 00 - 27/04/2019</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="row">



        <div class="col-md-offset-3 col-md-6">





            <div class="panel panel-default">

                <div class="panel-heading">

                    <strong>CLIENTE</strong>

                </div>

                <div class="panel-body text-center">

                    <p class="text-uppercase" style="font-weight: bold"><?php echo $cliente->empresa . '. ' . $cliente->razao_social . '. Fone: ' . $cliente->telefone; ?></p>

                    <p class="text-uppercase" style="font-weight: bold"><?php echo $cliente->responsavel; ?></p>

                    <p class="text-uppercase" style="font-weight: bold"><?php echo $cliente->endereco . ' - ' . $cliente->bairro . ' - ' . $cliente->cidade . ' - ' . $cliente->cep; ?></p>

                    <p class="" style="font-weight: bold"><?php echo $cliente->site . ' - ' . $cliente->email; ?></p>

                </div>

            </div>

        </div>

    </div>

    <div class="row text-center">

        <div class="col-md-offset-3 col-md-6" id="result_selos">

            <?php foreach ($array_orc as $value) { ?>

                <img style="width: 150px; height: 150px; margin: 7px;" src="<?php echo base_url('uploads/selos/' . $value->selo); ?>" />

            <?php } ?>            

        </div>

    </div>



    <div class="row">

        <div class="col-md-offset-2 col-md-8">



            <table class="table table-striped">

                <thead>

                    <tr>

                        <th colspan="5" class="text-center" style="height: 40px">RESUMO DO ORÇAMENTO</th>

                    </tr>

                    <tr>

                        <th class="text-center" style="height: 32px">#</th>

                        <th class="text-center" style="height: 32px">TREINAMENTO</th>

                        <th class="text-center" style="height: 32px">Nº Alunos</th>

                        <th class="text-center" style="height: 32px">VALOR POR ALUNO</th>

                        <th class="text-center" style="height: 32px">TOTAL</th>

                    </tr>

                </thead>

                <tfoot>

                    <?php setlocale(LC_ALL, 'pt_BR'); ?>

                    <tr class="success">

                        <td style="height: 32px"></td>

                        <td style="height: 32px"></td>

                        <td style="height: 32px"></td>

                        <td class="text-center" style="height: 32px"><strong>TOTAL</strong></td>

                        <td id="table_total" style="font-weight: bold; height: 32px" class="text-center"><?php echo money_format("%.2n", $orcamento->valor_total); ?></td>

                    </tr>

                </tfoot>

                <tbody id="table_orc">

                    <?php setlocale(LC_ALL, 'pt_BR'); ?>

                    <?php for ($index = 0; $index < count($array_orc); $index++) { ?>

                        <tr> 

                            <td class="text-center" style="height: 32px"><?php echo $index + 1; ?></td>

                            <td class="text-center" style="height: 32px"><?php echo strip_tags($array_orc[$index]->treinamento); ?></td>

                            <td class="text-center" style="height: 32px"><?php echo $array_orc[$index]->alunos; ?></td>

                            <td class="text-center" style="height: 32px"><?php echo money_format("%.2n", $array_orc[$index]->valor / $array_orc[$index]->alunos); ?></td>

                            <td class="text-center" style="height: 32px"><strong><?php echo money_format("%.2n", $array_orc[$index]->valor); ?></strong></td>

                        </tr>

                    <?php } ?>



                </tbody>

            </table>

            <textarea id="orc_obs" name="orc_obs" class="form-control" rows="3"><?php echo $orcamento->observacao; ?></textarea>

        </div>

    </div>

</html>