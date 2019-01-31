<?php
// 5. Построить замкнутую фигуру из 8 линий, причем каждая четная линия должна быть красного цвета.

header('Content-type: image/png');

function bicolourPolygon($img, $сx, $сy, $radius, $sides, $colorEven, $colorOdd) {
    // сx, сy - координаты центра
    // radius - радиус фигуры
    // sides - количество сторон
    // colorEven - цвет четных сторон
    // colorOdd - цвет нечетных сторон
    if ($sides <= 2) {
        imagestring($img, 5, 0, 0, ' Numbers of sides must be more 2', 0x000000);
        return false;
    }
    $startPointX = $сx + $radius * cos(deg2rad(0));
    $startPointY = $сy + $radius * sin(deg2rad(0));
    $lineNumber = 1;
    for ($a = (360 / $sides); $a <= 360; $a += (360 / $sides)) {
        if ($lineNumber % 2) {
            $color = $colorOdd;
        } else {
            $color = $colorEven;
        };
        // выведем номер линии возле самой линии
        imagestring($img, 5, $startPointX, $startPointY, $lineNumber, 0x000000);
        imageline(
            $img, 
            $startPointX, 
            $startPointY, 
            $startPointX = $сx + $radius * cos(deg2rad($a)), 
            $startPointY = $сy + $radius * sin(deg2rad($a)), 
            $color
        );
        $lineNumber++;
    }
    return true;
}

$myImg = imagecreatetruecolor(500,400);
$beige = imagecolorallocate($myImg, 245, 245, 220);
imagefill($myImg, 0, 0, $beige);

// вместо imagecolorallocate() можно использовать HEX значение цвета. 
// 0xff0000 - red 
// 0x00ff00 - green 
bicolourPolygon($myImg, 250, 200, 150, 8, 0xff0000, 0x00ff00);

imagepng($myImg);
imagedestroy($myImg);
