<?php
// 1. Написать функцию вывода прямоугольника с закругленными краями

header ("Content-type: image/png");

function arcRectangle($img, $cx, $cy, $w, $h, $r, $ink) {

    // функция рисования прямоугольника с закругленными краями 
    // $img - ресурс изображения.
    // cx, cy - координаты центра.
    // w - ширина, h - высота.
    // r - радиус закругления.
    // ink - идентификатор цвета.

    if ($r > $w/2 || $r > $h/2) {
        //радиус закругления больше половины высоты или половины ширины
        //выводим сообщение об ошибке и выходим из скрипта
        imagestring($img, 5, 0, 0, "Error: Radius too large!", $ink);
        imagepng($img);
        imagedestroy($img);
        exit();
    }

    //горизонтальные линии
    $ax = $cx - $w/2 + $r;
    $ay = $cy - $h/2;
    imageline($img, $ax, $ay, $ax + $w - (2 * $r), $ay, $ink);
    imageline($img, $ax, $ay + $h, $ax + $w - (2 * $r), $ay + $h, $ink);
    //вертикальные линии
    $bx = $cx - $w/2;
    $by = $cy - $h/2 + $r;
    imageline($img, $bx, $by, $bx, $by + $h - (2 * $r), $ink);
    imageline($img, $bx + $w, $by, $bx + $w, $by + $h - (2 * $r), $ink);
    //закругление углов
    imagearc($img, $ax, $ay + $r, 2*$r, 2*$r, 180, 270, $ink);
    imagearc($img, $ax + $w - (2 * $r), $ay + $r, 2*$r, 2*$r, 270, 360, $ink);
    imagearc($img, $ax, $ay + $h - $r, 2*$r, 2*$r, 90, 180, $ink);
    imagearc($img, $ax + $w - (2 * $r), $ay + $h - $r, 2*$r, 2*$r, 0, 90, $ink);
}

//imagecreatetruecolor() возвращает идентификатор изображения, представляющий черное изображение заданного размера.
$myImg = imagecreatetruecolor(500, 400);
//$white = imagecolorallocate($myImg, 255, 255, 255);
$black = imagecolorallocate($myImg, 0, 0, 0);
$beige = imagecolorallocate($myImg, 245, 245, 220);

//заливаем фон
imagefill($myImg, 0, 0, $beige);

arcRectangle($myImg, 25, 20, 30, 20, 5, $black);
arcRectangle($myImg, 95, 90, 70, 50, 15, $black);
arcRectangle($myImg, 300, 250, 300, 220, 30, $black);

imagepng($myImg);
imagedestroy($myImg);

?>