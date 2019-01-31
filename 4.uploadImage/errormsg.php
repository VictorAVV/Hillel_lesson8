<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    Files NOT upload.
    </title>
    <link rel='stylesheet' href='./css/bootstrap.css' type='text/css' media='all'>
    <link rel='stylesheet' href='./css/usercss.css' type='text/css' media='all'>
</head>
<body>
    <div id="blokForma" class="container">
        <h3 class="errorh3">Error.</h3>
            <div class='alert'>
                <b>
                <?php    
                    echo $file['error'];
                ?>
                </b>
            </div>
            <div class="alert-link">
                <a href="./index.html" class="alert-link">Go back and upload image again.</a>.
            </div>
    </div>
</body>

</html>

