<?php 

echo 'Primos<br><br>';


function checkPrimo($numero){
    //starting control var
    $is_primo = true;

    //validation, the only prime number not caught by the rule
    if($numero == 2) return $is_primo;

    //possible divisors, since all divisors of a given number are within 1 to itself.
    $range_divisores = ceil(sqrt($numero))+1;

    for($i=2; $i< $range_divisores; $i++) {
        if ($numero % $i == 0) {
            $is_primo = false;
        }
    }

    return $is_primo;
}


function Primos($inicial,$final) {

    $primos_encontrados = [];

    for($i=$inicial+1; $i<$final; $i++) {
        if (checkPrimo($i)) {
            $primos_encontrados[] = $i;
        }
    }

    return $primos_encontrados;
}


$numero_inicial = '1';
$numero_final = '30';
$primos_encontrados = Primos($numero_inicial, $numero_final);

//print result
echo "Número Inicial Informado: $numero_inicial <br>";
echo "Número Final Informado: $numero_final <br>";
echo "Primos Encontrados: " . json_encode($primos_encontrados);