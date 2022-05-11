<?php 

echo 'Século Ano <br><br>';

function SeculoAno($ano) {

    $dividendo = intval($ano, 10);
    $divisor = 100;

    $seculo = intdiv($dividendo, $divisor);
    $resto = $dividendo % $divisor;

    //if rest from intdiv, sum 1 to seculo
    if($resto !== 0){
        $seculo++;
    }

    return $seculo;
}

$ano_informado = '1';
$seculo_encontrado = SeculoAno($ano_informado);

//print result
echo "Ano Informado: $ano_informado <br>";
echo "Século Encontrado: $seculo_encontrado <br>";