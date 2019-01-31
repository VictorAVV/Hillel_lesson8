<?php
// 4. Создать форму загрузки файла изображения.
// Если было загружено изображение в формате jpeg,
// то изменить размер файла до 80*80,
// если в формате png - 60*60,
// в формате gif - 50*50.

$uploaddir = ''; //каталог для сохранения файлов

if (!isset($_POST) || !isset($_FILES['file1'])) {
    header('Location: index.html'); 
}

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);

function imageResize($outfile, $infile, $newWidth, $newHeight, $type, $quality) {
    if ($newWidth <= 0 || $newHeight <= 0) {
        return false;
    }
    
    $img1 = imagecreatetruecolor($newWidth, $newHeight);
    
    if (IMAGETYPE_JPEG == $type) {
        $suffix = 'jpeg';
    } elseif (IMAGETYPE_PNG == $type) {
        $suffix = 'png';
    } elseif (IMAGETYPE_GIF == $type) {
        $suffix = 'gif';
    } else {
        imagedestroy($img1);
        return false;
    }

    $img = ('imagecreatefrom'.$suffix)($infile);
    imagecopyresampled($img1, $img, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($img), imagesy($img));

    if (IMAGETYPE_JPEG == $type) {
        ('image'.$suffix)($img1, $outfile, $quality);
    } else {
        ('image'.$suffix)($img1, $outfile);
    }

    imagedestroy($img);
    imagedestroy($img1);
    return true;
}

//$file = array();//массив с данными загруженного файла: name, size, error, originalImgSize, newImgSize

if (isset($_FILES['file1']) && $_FILES['file1']['error'] == 0) {

    $file['error'] = $_FILES['file1']['error'];
    $fileForUpload = $uploaddir.$_FILES['file1']['name'];
    //проверяем тип изображения
    $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($_FILES['file1']['tmp_name']);
    if (in_array($detectedType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['file1']['tmp_name'], $fileForUpload)) {
            $file['name'] = $_FILES['file1']['name'];
            $file['size'] = $_FILES['file1']['size'];

            $imgSize = getimagesize($_FILES['file1']['name']);
            $file['originalImgSize'] = $imgSize[3];
            //меняем размер изображения
            switch ($detectedType) {
                case IMAGETYPE_JPEG:
                    $newWidth = $newHeight = 80;
                    break;
                case IMAGETYPE_PNG:
                    $newWidth = $newHeight = 60;
                    break;
                case IMAGETYPE_GIF:
                    $newWidth = $newHeight = 50;
                    break;
                default:
                    $newWidth = $newHeight = 0;
                    break;
            }

            if (imageResize($fileForUpload, $fileForUpload, $newWidth, $newHeight, $detectedType, 99)) {
                $file['width'] = $newWidth;
                $file['height'] = $newHeight;
            } else {
                $file['width'] = $imgSize[0];
                $file['height'] = $imgSize[1];
            };
            
            //echo 'Файл корректен и был успешно загружен.<br>';
        } else {
            $file['error'] = "Can't remove file to dir for upload";
        }
    } else {
        $file['error'] = 'Only images can be upload. Allowed types: jpeg, png, gif!';
    }
} else {
    if (!isset($_FILES['file1']['error']) || !isset($phpFileUploadErrors[$_FILES['file1']['error']])) {
        $file['error'] = 'Unknown error';
    } else {
        $file['error'] = $phpFileUploadErrors[$_FILES['file1']['error']];
    }
}

if (0 !== $file['error']) {
    require_once('errormsg.php');
} else {
    require_once('okmsg.php');
}

?>