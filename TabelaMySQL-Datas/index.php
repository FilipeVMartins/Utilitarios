<?php
include_once("controle.php");







//charset para os caracteres impressos pelo php
//header("Content-Type: text/html; charset=ISO-8859-1",true);
?>

<!doctype html>
<html lang="pt_BR">
 
    <head>
        <meta charset="utf-8">
        <title>Cursos HTML5 Essencial</title>
        
        <link rel="stylesheet" href="styles.css" type="text/css">
        
        
         
        
    </head>
    
    <body>
        <!--<p><?php echo $msgsucesso . " - " . $msgretorno;?></p>-->
        <div id="msg1"><?php echo $msgsucesso ?></div>
        <div id="msg2"><?php echo $msgretorno ?></div>
        
        <div>
            <form action="index.php" method="post">
                
                <label for="mensagem">Digite sua mensagem: </label>
                <input type="text" name="mensagem" id="nome" maxlength="249" required autofocus placeholder="Sua mensagem aqui">

                <input type="submit" value="Salvar" id="enviar" name="enviar">
            </form>
        </div>
        
        
        <div>
            
            
        <table class="table">
            <caption>Mensagens salvas:</caption>

            <thead>
                <tr class="thead-dark">
            <?php for ($coluna = 0; $coluna < count($colunasRequeridas); $coluna++){  //gera o cabeçalho da tabela?>
                    <th scope="col"><?php echo $colunasRequeridas[$coluna];?></th>
            <?php }?>
                </tr>               
            </thead>
        
            <tfoot>
            <?php for ($coluna = 0; $coluna < count($colunasRequeridas); $coluna++){   //gera o rodapé da tabela?>
                    <th scope="col"><?php echo $colunasRequeridas[$coluna];?></th>
            <?php }?>                         
            </tfoot>
            
            <tbody>
            <?php foreach ($tabelafinal as $linha){ //gera as linhas da tabela
                      $tabelafinallinha = $linha?> 
                <tr>
                <?php foreach ($tabelafinallinha as $tabelafinalcoluna){ //gera as colunas de cada linha da tabela?>
                    <td><?php echo $tabelafinalcoluna;?></td>
                <?php }?>
                </tr>
            <?php }?>
            </tbody>
            
        </table>
        </div>

	</body>
    <script type="text/javascript" src="script.js"></script>
</html>
