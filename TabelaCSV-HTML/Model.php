<?php 
class Model {
    //Método construtor. Parâmetros: (caminho do arquivo e colunas desejadas para impressão) ; Return: ().
    public function __construct($caminhoarquivo, $colunasrequeridas){     //string do nome do arquivo
        $this->arqui = $caminhoarquivo;
        $this->colunasrequeridas = $colunasrequeridas;
    }
    
    //Método, que quando chamado pelo objeto $arquivoo, é responsável por retornar uma array que alimentará o cabeçalho e o rodapé da tabela html. Parâmetros: (nenhum) ; Return: (array contendo o nome de cada coluna).
    public function getColunasrequeridas(){
        $colunasrequeridas = $this->colunasrequeridas;
        return $colunasrequeridas;
    }
    
    //Método que serve para instanciar o arquivo csv provido. Parâmetros: (caminho do arquivo) ; Return: (instanciação do $handle).
    private function abrirArquivo(){
        $arquivo = $this->arqui;
        $handle = fopen($arquivo, "r");
        if ($handle === FALSE){
            return "</br> Erro na abertura do arquivo! A operação poderá não funcionar corretamente.</br>";
        } else {
            return $handle;
        }
    }
    
    //Método para verificar a validade do cpf de uma linha. Parâmetros: (recebe a próxima linha obtida do fgetcsv) ; Return: (retorna a respectiva linha com o respectivo cpf caso válido ou a linha com o cpf em branco caso inválido).
    private function verificarCpfvalido($linhamatrizreorganizada){
        //Busca o índice da coluna do cpf.
        $colunasrequeridas = $this->colunasrequeridas;
        $cpfindice = array_search("cpf", $colunasrequeridas);
        //identifica o cpf a ser validado.
        $cpf = $linhamatrizreorganizada[$cpfindice];
	    //Verifica se um número cpf foi informado, caso não, retorna a linha analisada com cpf em branco(sem alteração).
	    if(empty($cpf)) {
		    return $linhamatrizreorganizada;
	    }
	    //Elimina possível mascara.
	    $cpf = preg_replace("/[^0-9]/", "", $cpf);
	    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	    //Verifica se o número de dígitos informados diferente de 11, caso sim, retorna a linha analisada com cpf em branco(alterando o valor anterior). 
	    if (strlen($cpf) != 11) {
            $linhamatrizreorganizada[$cpfindice] = "";
		    return $linhamatrizreorganizada;
	    }
	    //Verifica se alguma das sequências inválidas abaixo foi digitada, caso sim, retorna a linha analisada com cpf em branco(alterando o valor anterior).
           else if ($cpf == '00000000000' || 
                    $cpf == '11111111111' || 
                    $cpf == '22222222222' || 
                    $cpf == '33333333333' || 
                    $cpf == '44444444444' || 
                    $cpf == '55555555555' || 
                    $cpf == '66666666666' || 
                    $cpf == '77777777777' || 
                    $cpf == '88888888888' || 
                    $cpf == '99999999999') {
               $linhamatrizreorganizada[$cpfindice] = "";
               return $linhamatrizreorganizada;
           //Calcula os dígitos verificadores para verificar se o CPF não é válido, caso sim, retorna a linha analisada com cpf em branco(alterando o valor anterior).
           } else {
               
               for ($t = 9; $t < 11; $t++) {
                   for ($d = 0, $c = 0; $c < $t; $c++) {
                       $d += $cpf{$c} * (($t + 1) - $c);
                   }
                   $d = ((10 * $d) % 11) % 10;
                   if ($cpf{$c} != $d) {
                       $linhamatrizreorganizada[$cpfindice] = "";
                       return $linhamatrizreorganizada;
                   }
               }
            //e caso nenhum dos return anteriores seja chamado, retorna a linha analisada com o cpf analisado(sem alteração).
               return $linhamatrizreorganizada;
           }
        }
    //Método para verificar a validade do email de uma linha. Parâmetros: (recebe a próxima linha obtida do fgetcsv) ; Return: (retorna a respectiva linha com o respectivo email caso válido ou a linha com o email em branco caso inválido).  
    private function verificarEmailvalido($linhamatrizreorganizada){
        //Busca o índice da coluna do email.
        $colunasrequeridas = $this->colunasrequeridas;
        $emailindice = array_search("email", $colunasrequeridas);
        //identifica o email a ser validado.
        $email = $linhamatrizreorganizada[$emailindice];
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email === FALSE){
            $linhamatrizreorganizada[$emailindice] = "";
            return $linhamatrizreorganizada;
        } else {
            return $linhamatrizreorganizada;
        }
    }
    
    //Método para verificar a validade da data de uma linha. Parâmetros: (recebe a próxima linha obtida do fgetcsv) ; Return: (retorna a respectiva linha com a respectiva data caso válido ou a linha com o data em branco caso inválido).
    private function verificarDatanascimentovalido($linhamatrizreorganizada){
        //Busca o índice da coluna da data.
        $colunasrequeridas = $this->colunasrequeridas;
        $dataindice = array_search("datanascimento", $colunasrequeridas);
        //identifica a data a ser validada.
        $datanasc = $linhamatrizreorganizada[$dataindice];
        $data = explode("/", $datanasc);
        if (count($data)!==3){
            $linhamatrizreorganizada[$dataindice] = "";
            return $linhamatrizreorganizada;
        } else {
            $dia = $data[0];
            $mes = $data[1];
            $ano = $data[2];
            if (checkdate($mes , $dia , $ano)===TRUE){
                return $linhamatrizreorganizada;
            } else {
                $linhamatrizreorganizada[$dataindice] = "";
                return $linhamatrizreorganizada;
            }
        }  
    }
    
    //Método responsável por gerar uma correlação entre os indices das colunas do arquivo raiz e os índices das colunas requeridas para exibição. Parâmetros: (nenhum) ; Return: (retorna uma array contendo a correlação entre os índices das colunas do arquivo csv e os índices das colunas requeridas, ONDE os respectivos valores do array vão corresponder aos índices que as respectivas colunas requeridas teriam na tabela original).
    private function pegarIndicecolunasrequeridas(){
        $handle = Model::abrirArquivo();
        $colunasrequeridas = $this->colunasrequeridas;
        $indicecolunasrequeridas = array();
        
        $linhazeromatriz = fgetcsv($handle, 1000, ",");
        fclose($handle);
        
        for ($i = 0 ; $i<count($linhazeromatriz) ; $i++){
            for ($n=0 ; $n<count($colunasrequeridas) ; $n++){
                if(($linhazeromatriz[$i]) == $colunasrequeridas[$n]){
                    $indicecolunasrequeridas[] = ($n); //vai encontrar o valor do índice do elemento requerido na ordem requerida associado à ordem do índice da matriz original
                }
            }
        }
        
        return $indicecolunasrequeridas;   
    }
    
    //Método, que quando chamado pelo objeto $arquivoo, é responsável por realizar o processamento e validação dos dados de cada linha bem como construir a matriz que alimentará a tabela com a linhas processadas. Parâmetros: (nenhum), Return: (retorna a matriz que será alimentada à tabela).
    public function gerarMatriz (){
        $handle = Model::abrirArquivo();
        $matriz = array();
        $linhamatrizreorganizada = array();
        $indicecolunasrequeridas = Model::pegarIndicecolunasrequeridas();
        
        $row = 0;
        //percorre o $handle.
        while ((($linhamatriz = fgetcsv($handle, 1000, ",")) !== (FALSE || NULL))) {// && $row<=X, limitar linhas percorridas à intX para testes.
            
            //gera a nova linha $linhamatrizreorganizada com base na correlação de indices das colunas ($indicecolunasrequeridas) entre a linha advinda do fgetcsv, $linhamatriz, e os indices das colunas requisitadas, $colunasrequeridas, na entrada do objeto, $arquivoo.
            for ($i = 0 ; $i<count($linhamatriz) ; $i++){                     //percorre as colunas da linha do arquivo obtidas pelo fgetcsv.
                if (in_array($i, $indicecolunasrequeridas)){                  //filtra apenas as colunas requisitadas
                    for ($n = 0 ; $n<count($indicecolunasrequeridas) ; $n++){ //percorre as colunas requeridas
                        //analisa se determinada coluna da $linhamatriz corresponde à alguma $colunasrequeridas, se sim, obtém o valor dessa coluna da $linhamatriz para a $linhamatrizreorganizada.
                        if ($indicecolunasrequeridas[$n]==$i) {               
                            $linhamatrizreorganizada[$indicecolunasrequeridas[$i]] = $linhamatriz[$i];

                        }
                    }
                }
            }
            //reordena as colunas de cada linha para a respectiva ordem de entrada do parâmetro de entrada $colunasrequeridas (tal ordem foi repassada através da associação de indices realizada pelo método pegarIndicecolunasrequeridas() ).
            ksort($linhamatrizreorganizada);
            
            //Chamada das funções validadoras
            $linhamatrizreorganizada = Model::verificarDatanascimentovalido($linhamatrizreorganizada);
            $linhamatrizreorganizada = Model::verificarEmailvalido($linhamatrizreorganizada);
            $linhamatrizreorganizada = Model::verificarCpfvalido($linhamatrizreorganizada);
            
            $matriz[] = $linhamatrizreorganizada;
            //reseta a array que processa as linhas e às adicionam à matriz a cada retorno do fgetcsv.
            $linhamatrizreorganizada = array();
            $row++;
        }
        fclose($handle);
        return $matriz;
    }    
}
?>