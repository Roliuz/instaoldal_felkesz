
<?php

function fejlec($cim)
{

    echo <<<EOT
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../vendor/css/bootstrap.min.css">
    <script src="../vendor/js/bootstrap.min.js"></script>
    <script src="../js/animations.js"></script>


    
    <title>$cim</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-black">
        <div class="container-fluid">
            <img src="../pics/logo.png" style="width: 60px;"><a class="navbar-brand text-white fs-4" href="#">abtscss.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                <ul class="navbar-nav my-4 fs-5 mx-auto">
                    <li class="nav-item ">
                        <a class="nav-link active text-white mx-3" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white mx-3" href="service.php">Servicing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white mx-3" href="abtscss.php">About success</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white mx-3 " href="contact.php">Contact Us</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

EOT;
}

?>
