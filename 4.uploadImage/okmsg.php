<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Files upload OK.
    </title>
    <link rel='stylesheet' href='./css/bootstrap.css' type='text/css' media='all'>
    <link rel='stylesheet' href='./css/usercss.css' type='text/css' media='all'>
</head>

<body>
    <div id="blokForma" class="container">
        <h3 class="h3">File uploaded successfully.</h3>
            <?php
                message($file, $fileForUpload);
            ?>

            <div class="alert-link">
                <a href="./index.html" class="alert-link">Go back and upload new image.</a>.
            </div>
    </div>
</body>

</html>

<?php 
function message($file, $img) {
    echo "<div class='success'>";
    echo "File name: \"{$file['name']}\".<br>Original size of file: {$file['size']} bytes.";
    echo "<br>Original image size: {$file['originalImgSize']}.";
    echo "<br>New image size: width=\"{$file['width']}\" height=\"{$file['height']}\".";
    echo "</div>";
    
    echo "<div style='text-align: center;'>";
    echo "<img src='$img' width='{$file['width']}' height='{$file['height']}'>";
    echo "</div>";
}
?>