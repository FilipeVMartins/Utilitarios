<?php 

echo 'Números Não Repetidos <br><br>';


function generate_array() {

    $numbers_array = [];
    for($i=0; $i<20; $i++) {
        $numbers_array[] = rand(1,10);
    }

    return $numbers_array;
}

function numeros_nao_repetidos($array_sorteada) {

    $numeros_nao_repetidos = [];

    //loop for add the not found value
    for($i=0; $i<count($array_sorteada); $i++) {
        $number_exists = false;

        //loop for search
        for($j=0; $j<count($array_sorteada); $j++) {

            if($array_sorteada[$i] == $array_sorteada[$j] && $i != $j){
                $number_exists = true;
            }

        }

        //if still false, then add it
        if($number_exists == false){
            $numeros_nao_repetidos[] = $array_sorteada[$i];
        }

    }

    return $numeros_nao_repetidos;
}



$array_sorteada = generate_array();
$numeros_nao_repetidos = numeros_nao_repetidos($array_sorteada);

//print result
echo "Array Sorteado: " . json_encode($array_sorteada). '<br>';
echo "Os números que não se repetem são: " . json_encode($numeros_nao_repetidos). '<br>';