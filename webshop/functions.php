<?php

function connect_mysql()
{
    $host = "localhost";
    $database = "kondi";
    $username = "admin";
    $password  = "Admin123";


    try {
        return new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8', $username, $password);
    } catch (PDOException $exception) {
        exit("Nem lehet elérni az adatbázist!");
    } //error esetén
}


function fejlec($oldalcim) //egy függvényt hozok létre külön a fejlécnek, hogy a webshopnak minden részén csak meg kelljen hívjam

{
    $kosar_termekek_szama = isset($_SESSION['kosar']) ? count($_SESSION['kosar']) : 0;

    echo <<<EOT
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$oldalcim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <header class="p-3 bg-light border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">


                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="../login_session.php" class="px-2 me-2 "><i class="bi bi-arrow-left-circle"></i></a></li>
                    <li><a href="index.php" class="nav-link px-2 me-3 text-secondary">Vissza a főoldalra</a></li>
                    <li><a href="index.php?oldal=termekek" class="nav-link px-2 me-3 text-black">Termékek</a></li>

                </ul>

               

                <div class="text-end">
                    <a href="index.php?oldal=kosar" class="nav-link">
                    <i class="fas fa-shopping-cart"></i><sup><span>$kosar_termekek_szama</span>
                    </sup></a>
                </div>
            </div>
        </div>
    </header>

    
EOT;
}


function lablec()
{
    echo <<<EOT

    <footer class="bg-dark  border-top py-5 text-light">

        <div class="container">

            <div class="row">
                <div class="col">
                    <p class="ft-bold text-info">Ügyfélszolgálat</p>
                    <p class="my-1 fw-bold"><a href="#" class="text-decoration-none text-secondary">GymRoll</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">5600 Békéscsaba</a></p>
                    <p class="my-1"><a href="mailto:info@webshop.hu" class="text-decoration-none text-secondary">GymRoll@gmail.com</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">+ 36 30 755 9817</a></p>
                </div>



                <div class="col">

                    <p class="ft-bold text-info">Információ</p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">Konditerem szabályzat</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">Nyitvatartás</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">Fizetési mdódok</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">Feleősségvállalás</a></p>
                </div>


                <div class="col">
                    <p class="ft-bold text-info">Gyakori kérdések</p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">--</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">--</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">--</a></p>
                    <p class="my-1"><a href="#" class="text-decoration-none text-secondary">--</a></p>
                </div>
            </div>
        </div>

    </footer>
    </body>
    </html>
EOT;
}
