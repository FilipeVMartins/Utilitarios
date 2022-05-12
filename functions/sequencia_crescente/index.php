<?php 

echo 'Sequencia Crescente <br><br>';


function SequenciaCrescente($array) {

    /// final attempt
    // $removals = 0;
    // $previous_from_last_removed = null;
    // $removed = [];
    // for($i=0; $i<count($array); $i++) {

    //     if($array[$i+1] != null && (($previous_from_last_removed != null && $array[$previous_from_last_removed] >= $array[$i+1])  || $array[$i] >= $array[$i+1])){
    //         //will jump one index
    //         $removals++;
    //         //will save the last valid index
    //         $previous_from_last_removed = $i;
    //         $removed[] = $array[$i+1];

    //     } else {
    //         //reset if the comparison was valid
    //         $previous_from_last_removed = null;
    //     }

    // }
    // echo $removals . json_encode($removed);
    // return ($removals < 2 ? 'true' : 'false' );



    /// found solution
    // Stores the $count of numbers that
    // are needed to be removed
    $count = 0;
  
    // Store the $index of the element
    // that needs to be removed
    $index = -1;
  
    // Traverse the range [1, N - 1]
    for($i = 1; $i < count($array); $i++) 
    {
          
        // If $array[i-1] is greater than
        // or equal to $array[i]
        if ($array[$i - 1] >= $array[$i])
        {
              
            // Increment the $count by 1
            $count++;
  
            // Update $index
            $index = $i;
        }
    }
  
    // If $count is greater than one
    if ($count > 1)
        return 'false';
  
    // If no element is removed
    if ($count == 0)
        return 'true';
  
    // If only the last or the
    // first element is removed
    if ($index == count($array) - 1 || $index == 1)
        return 'true';
  
    // If a[$index] is removed
    if ($array[$index - 1] < $array[$index + 1])
        return 'true';
  
    // If a[$index - 1] is removed
    if ($array[$index - 2] < $array[$index])
        return 'true';
  
    return 'false';

}




$tests = [
    //[1, 2, 3],

    [1, 3, 2, 1],  
    [1, 3, 2],  
    [1, 2, 1, 2],  
    [3, 6, 5, 8, 10, 20, 15], 
    [1, 1, 2, 3, 4, 4], 
    [1, 4, 10, 4, 2], 
    [10, 1, 2, 3, 4, 5], 
    [1, 1, 1, 2, 3], 
    [0, -2, 5, 6], 
    [1, 2, 3, 4, 5, 3, 5, 6], 
    [40, 50, 60, 10, 20, 30], 
    [1, 1], 
    [1, 2, 5, 3, 5], 
    [1, 2, 5, 5, 5], 
    [10, 1, 2, 3, 4, 5, 6, 1], 
    [1, 2, 3, 4, 3, 6], 
    [1, 2, 3, 4, 99, 5, 6], 
    [123, -17, -5, 1, 2, 3, 12, 43, 45], 
    [3, 5, 67, 98, 3], 
];

for($i=0; $i<count($tests); $i++) {
    echo json_encode($tests[$i]). ' ' . SequenciaCrescente($tests[$i]) . '<br>';
}