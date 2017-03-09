<?php

$firstFib = 1;
$secondFib =1; 
$buffer = 0;
$userNumber = rand(0,100);

echo "The User's number is ".$userNumber."<br />";

while (true)
    {   
        if ($userNumber < $firstFib)
        {
            echo "The number ".$userNumber." is NOT in row! <br />";
            break;
        }
        if ($firstFib == $userNumber)
        {
            echo "The number ".$userNumber." is IN row! <br />";
            break;
        }
        $buffer = $firstFib;
        $firstFib = $firstFib + $secondFib;
        $secondFib = $buffer;
    }
?>