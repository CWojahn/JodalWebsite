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
              <img src="<?php echo base_url('assets/img/logo_relatorio.jpg');?>" alt="" style="width: 75px;" srcset="">
            </div>
            <div class="divTableCell"style="vertical-align: middle;">
              <p style="font-weight: 600;">Relatório fotográfico das <br> Melhorias a serem Implantadas no canteiro de obra.</p>
            </div>
            <div class="divTableCell"style="padding: 0; border-spacing:0; border:0">
              <div class="divTable"style="margin: 0; border-spacing:0" >
                <div class="divTableRow">
                  <div class="divTableCell"style="margin: 0; border-spacing:0; text-align: left">
                    <p>N°: <?php echo $relatorio->id; ?></p> 
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
      <div class="col-md-offset-3 col-md-6" style="border-style: solid; border-width: 1px;margin-top: 35px;" >
          <div class="panel panel-default">
            <div class="panel-body text-center">
                  <p class="text-uppercase" style="padding-left: 10px;">EMPRESA: <?php echo $relatorio->empresa?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">OBRA: <?php echo $relatorio->obra?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">LOCAL: <?php echo $relatorio->local?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">TST-OBRA: <?php echo $relatorio->tst_name?></p>
                  <p class="text-uppercase" style="padding-left: 10px;">DATA: <?php echo $relatorio->data?></p>
                  <p  style="color: #ffffff;
                        background-color: #000000;
                        text-align: center;
                        font-size: 16px;
                        padding: 0.25em;
                        margin-bottom: 0;"
                  >PCMAT & PGST</p>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 30px;" >
      <p style="font-size: 12px; font-weight: 600; padding-left: 10px;">RELATÓRIO VISUAL: - (X)</p>
      <div class="divTable">
        <div class="divTableBody">
          <div class="divTableRow"style="background-color: #999999;">
            <div class="divTableCell" style="height: 20px; vertical-align: middle; border-color: #333; font-weight: 600;">
              Foto/Imagem
            </div>
            <div class="divTableCell" style="height: 20px; vertical-align: middle; border-color: #333; font-weight: 600;">
              Ações Encontradas
            </div>
          </div>
          <div class="divTableRow">
            <?php foreach ($array_images as $value) { ?>
              <div class="divTableCell" style="vertical-align: middle;">
                <img src="<?php echo $value->image_path;?>" alt="" srcset="" width="600em">
              </div>
              <div class="divTableCell" style="text-align: left;">
                <p style="text-align: center; text-decoration: underline;">APONTAMENTOS TÉCNICOS:</p>
                  <p><?php echo $value->observacao; ?></p>
              </div>
            <?php } ?> 
          </div>          
        </div>
      </div>
    <div class="row"style="background-color: #999999; text-align: center; font-weight: 600;" >
        Observações:
    </div>
    <div class="row" style="border: #999 solid 1px;">
      <p><?php echo $relatorio->observacoes; ?></p>
    </div> 
    <div class="row">
      <div class="divTable">
        <div class="divTableBody">
          <div class="divTableRow">
            <div class="divTableCell">
              <br><br><br>
              <hr>
              <p style="font-weight: 600;">PABLO M. DE MOURA MASTELLA</p>
              <p style="text-align: center;font-weight: 600;">JODAL</p>
            </div>           
            <div class="divTableCell"style="text-align: center;">
              <p style="text-decoration: underline;">Observação: Documento encaminhar para e-mails:</p>
              <p><?php echo $relatorio->email; ?></p>
            </div>
            <div class="divTableCell">
              <br><br><br>
              <hr>
              <ps style="font-weight: 600;">CONTRATANTE - <?php echo $relatorio->empresa?></p>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</html>