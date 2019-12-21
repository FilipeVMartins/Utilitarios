<?php 
//Model é onde acontecerá a criação dos métodos e a execução dos processamentos através do objeto Model, que contém como atributos principais 1(o caminho do arquivo) e 2(as colunas requeridas para exibição).
include_once("Model.php");
//charset para os caracteres impressos pelo php
header("Content-Type: text/html; charset=ISO-8859-1",true);


//entrada inicial dos dados
$arquivoo = new Model("arquivo.csv", array(   "nome",
                                                "sobrenome",
                                                "cpf",
                                                "email",
                                                "datanascimento",
                                                "genero",
                                                "tiposanguineo",
                                                "endereco",
                                                "cidade",
                                                "estado",
                                                "cep"));
//gera a matriz que alimentará a tabela, onde o primeiro índice [] são as linhas e o segundo índice [] são as colunas de cada linha da tabela.
$matriz = $arquivoo->gerarMatriz();
//gera a array que alimentará cabeçalho e rodapé
$colunas = $arquivoo->getColunasrequeridas();
?>
<!doctype html>

<html>
    <head>
        <meta charset="ISO-8859-1">
        <title>Tabela CSV-HTML</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
        
    <body>
        <table>
            <caption>Tabela CSV-HTML</caption>
            
            <thead>
                <tr>
            <?php for ($coluna = 0; $coluna < count($colunas); $coluna++){  //gera o cabeçalho da tabela?>
                    <td><?php echo $colunas[$coluna];?></td>
            <?php }?>
                </tr>               
            </thead>
        
            <tfoot>
            <?php for ($coluna = 0; $coluna < count($colunas); $coluna++){   //gera o rodapé da tabela?>
                    <td><?php echo $colunas[$coluna];?></td>
            <?php }?>                         
            </tfoot>
            
            <tbody>
            <?php for ($matrizlinha = 1; $matrizlinha < count($matriz); $matrizlinha++){ //gera as linhas da tabela?> 
                <tr>
                <?php for ($matrizcoluna = 0; $matrizcoluna < count($matriz[$matrizlinha]); $matrizcoluna++){ //gera as colunas de cada linha da tabela?>
                    <td id="linha"><?php echo $matriz[$matrizlinha][$matrizcoluna];?></td>
                <?php }?>
                </tr>
            <?php }?>
            </tbody>
            
        </table>
    </body>
</html>


