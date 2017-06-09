<?php
    $salt1 = '#3@as';
    $salt2 = 'fdy!@';
    $password1 = '123';

    $password2 = '456';
    $password1 = hash('ripemd128', "$salt1$password1$salt2");
    $password2 = hash('ripemd128', "$salt1$password2$salt2");
    echo $password1."</br>";
    echo $password2;
    ?>
