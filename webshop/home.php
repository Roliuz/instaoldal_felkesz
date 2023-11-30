<?php

if (isset($_SESSION["user_id"])) {
} else {
    // felhasználó nincs bejelentkezve, átirányítás a bejelentkező oldalra
    header("Location: ../loginkondi.php");
    exit;
} ?>
<?php
$lekerdez = $pdo->prepare('SELECT * FROM termekek ORDER BY feltoltes_datuma DESC LIMIT 4'); //kiírja a legutóbbi négy feltöltött terméket
//prepare metódus segítségével "előkészítem" a későbbi felhasználásra, illetve véd az SQL injection-től
$lekerdez->execute();
$nemreg_termekek = $lekerdez->fetchAll(PDO::FETCH_ASSOC); // egy asszociatív tömbben eltárolom az összes adatot
//PDO::FETCH_ASSOC opció arra utasítja a PDO-t, hogy az adatokat asszociatív tömbökben adja vissza

?>

<?= fejlec('Webshop főoldal') ?>

<div class="card text-bg-dark border-0">
    <img src="../../Pic/webshop_img.png" class="card-img " alt="...">
    <div class="card-img-overlay">

    </div>
</div>
<div class="container">
    <div class="row m-3">

        <div class="bg-warning m-2">
            <h2 class="text-center m-3 text-white">NEMRÉG HOZZÁADOTT TERMÉKEINK</h2>
        </div>
        <?php foreach ($nemreg_termekek as $termek) : ?> <!-- foreach segítségével addig fut le amíg talál termékeket (szóval jelen esetben 4-szer) -->
            <div class="col my-3">
                <style>
                    a:link {
                        text-decoration: none;
                        color: black;
                    }

                    a:visited {
                        text-decoration: none;
                        color: black;
                    }
                </style>
                <a href="index.php?oldal=termek&id=<?= $termek['id'] ?>"> <!-- adatbázisból meghívom a termékek nevét, leírás, árát, képét, stb.. -->
                    <div class="card h-100 border-0 mx-auto" style="width: 15rem; ">
                        <img src="../../Pic/<?= $termek['img'] ?>" class="card-img-top" alt="<?= $termek['nev'] ?>">
                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title"><?= $termek['nev'] ?></h5>
                            <p class="card-text"><?= $termek['ar'] ?> Ft</p>
                            <a href="index.php?oldal=termek&id=<?= $termek['id'] ?>" class="btn btn-success mt-auto">Részletek</a>
                        </div>
                    </div>
                </a>

            </div>
        <?php endforeach; ?>

    </div>
</div>

<?= lablec() ?>