<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>

    <body>
        <div>

        </div>

        <div style="background: whitesmoke">
            <table style="background: white; font-size: 16px; line-height: 20px; margin-left: auto; margin-right: auto; ">
                <thead>                    
                    <tr>
                        <td colspan="2" style="text-align: center;"><strong>Cotar Serviço</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td style="width: 40%">Serviço:</td>
                        <td><strong><?php echo $produto; ?></strong></td>
                    </tr>
                    
                    <tr>
                        <td>Nome:</td>
                        <td><?php echo $nome; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td>Telefone:</td>
                        <td><?php echo $telefone; ?></td>
                    </tr>
                    <tr>
                        <td>Endereço:</td>
                        <td><?php echo $endereco; ?></td>
                    </tr>
                    <tr>
                        <td>Mensagem:</td>
                        <td><pre><?php echo $mensagem; ?></pre></td>
                    </tr>                   
                                    
                </tbody>
            </table>
        </div>

    </body></html>