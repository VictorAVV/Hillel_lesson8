<?php
//3. Создать прямоугольник зеленого цвета с красным кругом внутри и сохранить данное изображение в файл figure.jpeg

header ("Content-type: image/jpeg");

$myImg = imagecreatetruecolor(500, 400);
$beige = imagecolorallocate($myImg, 245, 245, 220);
$green = imagecolorallocate($myImg, 0, 255, 0);
$red = imagecolorallocate($myImg, 255, 0, 0);

//заливаем фон
imagefill($myImg, 0, 0, $beige);

imagefilledrectangle($myImg, 100, 100, 400, 300, $green);
imagefilledellipse($myImg, 250, 200, 100, 100, $red);

imagejpeg($myImg, null, 99);
imagejpeg($myImg, 'figure.jpeg', 99);
imagedestroy($myImg);
