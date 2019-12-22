<?php 
//Model é onde acontecerá a criação dos métodos e a execução dos processamentos através do objeto Model, que contém como atributos principais 1(o caminho do arquivo) e 2(as colunas requeridas para exibição).
include_once("Model.php");
//charset para os caracteres impressos pelo php
header("Content-Type: text/html; charset=ISO-8859-1",true);


//entrada inicial dos dados, primeiro parametro é o caminho do arquivo .csv, e o segundos as colunas requeridas do mesmo
$arquivoo = new Model("arquivo.csv", array(     "nome",
                                                "sobrenome",
                                                "cpf",
                                                "datanascimento",
                                                "genero",             // <- exemplos de possíveis colunas de um arquivo .csv
                                                "cep",
                                                "cidade",
                                                "estado",
                                                "email"));
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
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css" type="text/css">
        
    </head>
        
    <body>
        <table class="table">
            <caption>Tabela CSV-HTML</caption>

            <thead>
                <tr class="thead-dark">
            <?php for ($coluna = 0; $coluna < count($colunas); $coluna++){  //gera o cabeçalho da tabela?>
                    <th scope="col"><?php echo $colunas[$coluna];?></th>
            <?php }?>
                </tr>               
            </thead>
        
            <tfoot>
            <?php for ($coluna = 0; $coluna < count($colunas); $coluna++){   //gera o rodapé da tabela?>
                    <th scope="col"><?php echo $colunas[$coluna];?></th>
            <?php }?>                         
            </tfoot>
            
            <tbody>
            <?php for ($matrizlinha = 1; $matrizlinha < count($matriz); $matrizlinha++){ //gera as linhas da tabela?> 
                <tr>
                <?php for ($matrizcoluna = 0; $matrizcoluna < count($matriz[$matrizlinha]); $matrizcoluna++){ //gera as colunas de cada linha da tabela?>
                    <td><?php echo $matriz[$matrizlinha][$matrizcoluna];?></td>
                <?php }?>
                </tr>
            <?php }?>
            </tbody>
            
        </table>
    </body>
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</html>


