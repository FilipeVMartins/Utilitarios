<?php
class Model {
    
    function __construct($dbnome, $tabela, $url, $user, $pass){
        //definir nome do db
        $this->dbnome = $dbnome;
        //definir nome da tabela
        $this->tabela = $tabela;
        // abre conexão. (servidor, usuário, senha, nome do banco)
        $this->conecta = mysqli_connect ($url, $user, $pass, $dbnome);
        // testar a conexão, se ocorreu corretamente.
        if (mysqli_connect_errno()){
            //$this->msgsucesso = "Conexão falhou, erro: " . mysqli_connect_errno();
            $this->msgsucesso = '0';
            die();
        } else { 
            //$this->msgsucesso = "Conexão realizada com sucesso";
            $this->msgsucesso = '1';
        }
    }
    
    
    //verificar se a tabela ja existe.
    function checartabelaexiste(){
    $checartabela = "SELECT table_name FROM information_schema.tables WHERE table_schema = '$this->dbnome' AND table_name = '$this->tabela'";
    $resultadotabelaexiste = mysqli_query($this->conecta, $checartabela);
        if (!$resultadotabelaexiste->num_rows){
            //criar tabela caso nao exista
            $criartabela = "CREATE TABLE `$this->tabela` (
                           `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                           `mensagem` VARCHAR(250) NOT NULL,
                           `datahora` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                           PRIMARY KEY (`id`)) 
                           ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
            $criartabelaquery = mysqli_query($this->conecta, $criartabela);
            //$msgretorno = "Tabela $this->tabela não existia, foi criada agora.";
            $msgretorno = '0';
            return $msgretorno;
        } else {
            //$msgretorno = "Tabela $this->tabela já existia.";
            $msgretorno = '1';
            return $msgretorno;
        }
    }
        
        
    //salvar mensagens no db
    function salvarmensagens ($mensagem){
        $salvarmensagem = "INSERT INTO $this->tabela (mensagem) VALUES ('$mensagem')";
        $salvarmensagemquery = mysqli_query($this->conecta, $salvarmensagem);
    }
    
    
    //retirar mensagens do db
    function vermensagens(){
        $vermensagens = "SELECT * FROM $this->tabela";
        $vermensagensquery = mysqli_query($this->conecta, $vermensagens);
        //gerar matriz resultado
        while ($matrizmensagens[] = mysqli_fetch_assoc($vermensagensquery)){}
        return $matrizmensagens;
    }


    //print_r($matrizmensagens);
    //print_r($resultadotabelaexiste->num_rows);

    function encerrarconnection(){
        mysqli_close($this->conecta);
    }
}
?>