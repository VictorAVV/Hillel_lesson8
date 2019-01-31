<?php
// 2. Вывести 4 круга (аналог значка марки “Audi”), причем 2 средних круга должны быть закрашены в красный цвет

header ("Content-type: image/png");

function logotypeAudi($img, $x0, $y0, $width, $ink1, $ink2) {
    // функция рисования логотипа ауди. 2 центральных круга закрашены
    // $img - ресурс изображения.
    // x0, y0 - координаты левого верхнего угла логотипа (в условном прямоугольнике).
    // width - ширина.
    // ink1 - идентификатор цвета боковых кругов.
    // ink2 - идентификатор цвета двух центральных закрашеных кругов.
    
    // высота рассчитывается автоматически из ширины
    // 3,25 - коэффициент пропорциональности
    $height = round($width / 3.25);

    //рисуем круги
    //2 закрашенных круга
    imagefilledellipse(
        $img, 
        $x0 + round($height / 2) + round(($width - $height) / 3), 
        $y0 + round($height / 2), 
        $height, 
        $height, 
        $ink2
    );
    imagefilledellipse(
        $img, 
        $x0 + round($height / 2) + round(2* ($width - $height) / 3),  
        $y0 + round($height / 2), 
        $height, 
        $height, 
        $ink2
    );
    // 4 незакрашенных круга
    // x координата центра первой окружности: x0 + height/2
    imageellipse(
        $img, 
        $x0 + round($height / 2), 
        $y0 + round($height / 2), 
        $height, 
        $height, 
        $ink1
    );
    // x координата центра второй окружности: (x0 + height/2) + (width - height)/3
    imageellipse(
        $img, 
        $x0 + round($height / 2) + round(($width - $height) / 3), 
        $y0 + round($height / 2), 
        $height, 
        $height, 
        $ink1
    );
    // x координата центра третьей окружности: (x0 + height/2) + (width - height)*2/3
    imageellipse(
        $img, 
        $x0 + round($height / 2) + round(2* ($width - $height) / 3), 
        $y0 + round($height / 2), 
        $height, 
        $height, 
        $ink1
    );
    // x координата центра четвертой окружности: x0 + width - height/2
    imageellipse(
        $img, 
        $x0 + $width - round($height / 2), 
        $y0 + round($height / 2), 
        $height, 
        $height, 
        $ink1
    );
}

$myImg = imagecreatetruecolor(500, 400);
$black = imagecolorallocate($myImg, 0, 0, 0);
$beige = imagecolorallocate($myImg, 245, 245, 220);
$red = imagecolorallocate($myImg, 255, 0, 0);

//заливаем фон
imagefill($myImg, 0, 0, $beige);

logotypeAudi($myImg, 100, 150, 300, $black, $red);

imagepng($myImg);
imagedestroy($myImg);
