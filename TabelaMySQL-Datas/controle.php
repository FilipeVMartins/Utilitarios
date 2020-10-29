<?php
include_once("Model.php");

// INSIRA AQUI OS DADOS DA CONEXÃO ////////////////////////////////////////////////////
$user = "root";
$pass = "";
$url = "localhost";
$dbnome = "dbtestephp";
$tabelaSQL = "mensagens";  //nome da tabela já existente OU para ser criada.
//inicia a conexão
$dbmensagens = new Model ($dbnome, $tabelaSQL, $url, $user, $pass);
$msgsucesso = $dbmensagens->msgsucesso;


//checar se tabela foi criada 
$msgretorno = $dbmensagens->checartabelaexiste();
 

//checar se $_POST foi já foi recebido  
if (isset($_POST['mensagem']) && isset($_POST['enviar'])){
    //checar se valores recebidos estão devidamente de acordo com a operação
    if ($_POST['mensagem'] && ($_POST['enviar']=='Salvar')){
        // salvar mensagem
        $dbmensagens->salvarmensagens ($_POST['mensagem']);
    }
}

   
//retirar mensagens do db     
$matrizmensagens = $dbmensagens->vermensagens();


//encerrar conexão
$dbmensagens->encerrarconnection();



//construção da tabela final a ser apresentada.
$tabelafinal = array();

//percorre os registros da matriz original, count()-1 para não ir até o ultimo indice, que está vazio.
for ($i=0 ; $i<(count($matrizmensagens)-1) ; $i++){
    
    //linha de cada registro da tabela final
    $linhatabelafinal = array();
    
    //criar timestamp do PHP, strtotime para converter a timestamp() do mysql para a do php e depois date() para formatar conforme o requisitado.
    $timestampconvertida = strtotime($matrizmensagens[$i]['datahora']);
    //adicionar campos data formato1 e formato2 à array correspondente à linha de cada mensagem, formatados como o requisitado.
    $linhatabelafinal["formato1"] = date("d/m/Y", $timestampconvertida);
    $linhatabelafinal["formato2"] = date("Y-m-d", $timestampconvertida);
    
    //construção do formato3
    $strformato3 =  substr(date("l", $timestampconvertida), 0,3) .
                    ", " .
                    date("d", $timestampconvertida) .
                    " de " .
                    date("F", $timestampconvertida) .
                    " de " . 
                    date("Y", $timestampconvertida) . 
                    " " .
                    date("H", $timestampconvertida) .
                    ":" .
                    date("i", $timestampconvertida);
    
    //adicionar o terceiro formato ja construído.
    $linhatabelafinal["formato3"] = $strformato3;
    //adicionar a mensagem da linha
    $linhatabelafinal["mensagem"] = $matrizmensagens[$i]['mensagem'];
    
    // $linhatabelafinal terminada e adicionada à $tabelafinal;
    $tabelafinal[] = $linhatabelafinal;
}

$colunasRequeridas = ["Formato 1", "Formato 2", "Formato 3", "Mensagem"]

?>