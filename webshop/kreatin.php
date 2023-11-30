<?php

if (isset($_SESSION["user_id"])) {
} else {
    // felhasználó nincs bejelentkezve, átirányítás a bejelentkező oldalra
    header("Location: ../loginkondi.php");
    exit;
} ?>
<?= fejlec('Kreatin') ?>
<?php
$kreatin = $pdo->prepare("SELECT * FROM termekek WHERE termek_tipus = 'kreatin'");
$kreatin->execute();
$kreatinok = $kreatin->fetchAll(PDO::FETCH_ASSOC);

$termekek_szama = $pdo->query("SELECT * FROM termekek WHERE termek_tipus = 'kreatin'")->rowCount();
?>
<div class="container">
    <p class="my-3"><?= $termekek_szama ?> termék található</p>
    <hr>
    <div class="row m-3">
        <div class="col-3 border-end">
            <ul class="list-group list-group-flush">


                <li class="list-group-item my-3"><a href="index.php?oldal=feherje">Fehérjék</a></li>
                <li class="list-group-item my-3"><a href="index.php?oldal=kreatin">Kreatinok</a></li>
                <li class="list-group-item my-3"><a href="index.php?oldal=shaker">Shakerek</a></li>
                <li class="list-group-item my-3"><a href="index.php?oldal=edzeselotti">Edzés előttik</a></li>

            </ul>
        </div>
        <div class="col-9">
            <div class="row">
                <?php

                if ($termekek_szama >= 1) :
                ?>
                    <?php foreach ($kreatinok as $krea) : ?> <!-- foreach segítségével addig fut le amíg talál termékeket (szóval jelen esetben 4-szer) -->
                        <div class="col-lg-4 col-md-5 mt-3  ">
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
                            <a href="index.php?oldal=termek&id=<?= $krea['id'] ?>"> <!-- adatbázisból meghívom a termékek nevét, leírás, árát, képét, stb.. -->
                                <div class="card h-100 border-0 " style="width: 15rem; ">
                                    <img src="../../Pic/<?= $krea['img'] ?>" class="card-img-top" alt="<?= $krea['nev'] ?>">
                                    <div class="card-body d-flex flex-column">

                                        <h5 class="card-title"><?= $krea['nev'] ?></h5>
                                        <p class="card-text"><?= $krea['ar'] ?> Ft</p>
                                        <a href="index.php?oldal=termek&id=<?= $termek['id'] ?>" class="btn btn-success mt-auto">Részletek</a>
                                    </div>
                                </div>
                            </a>

                        </div>
                    <?php endforeach; ?>



                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= lablec() ?>