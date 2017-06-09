<?php
session_start();
if (isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
    $role = $_SESSION['role'];
    $result = $_SESSION['result'];
} else {
    header('Location: ../login.php');
    exit;
}

    header("Content-type: image/png");
    
    $userNameLength = iconv_strlen($userName, 'UTF-8');
    $im    = imagecreatefrompng(getcwd().'/../image/cert.png');
    $color = imagecolorallocate($im, 150, 50, 50);
    
    $fontName = getcwd().'/../fonts/font.ttf';

    //вычисляем высоту текста для Имени в зависимости от количества символов в нем 
    if ($userNameLength < 28){
        $heightName = 35;
        $xName = 380 + (28 - $userNameLength) / 2 * 16;
    } elseif (($userNameLength > 28) && ($userNameLength < 37)){
        $heightName = 25;
        $xName = 380 + (38 - $userNameLength) / 2 * 12;
    } 

    imagettftext($im, $heightName, 0, $xName, 380, $color, $fontName, $userName);
    
    $fontText = getcwd().'/../fonts/calibrii.ttf';
    $colorText = imagecolorallocate($im, 0, 0, 0);
    $text = "\nпрошел(ла) тестовые испытания с оценкой: " . $result;
    imagettftext($im, 18, 0, 380, 410, $colorText, $fontText, $text);
    
    $date = date("d.m.Y");
    imagettftext($im, 15, 0, 490, 550, $colorText, $fontText, $date);
   
    $directorName = "Ивановский О.Д.";
    imagettftext($im, 15, 0, 670, 550, $colorText, $fontText, $directorName);
    
    imagepng($im);
    imagedestroy($im); 

session_destroy();

?>
