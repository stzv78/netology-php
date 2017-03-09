<?php

$a1=1;
$a2=1; $a3=0;
$x = rand(0,100);
echo "Число ".$x."\n";
while (true)
    {   
        if ($x<$a1)
        {
            echo "The number ".$x." is NOT in row \n";
            break;
        }
        if ($a1==$x)
        {
            echo "The number ".$x." is IN row \n";
            break;
        }
        $a3=$a1;
        $a1=$a1+$a2;
        $a2=$a3;
    }
?>
