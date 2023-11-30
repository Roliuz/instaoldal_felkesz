<?php

if (isset($_SESSION["user_id"])) {
} else {
    // felhasználó nincs bejelentkezve, átirányítás a bejelentkező oldalra
    header("Location: ../loginkondi.php");
    exit;
} ?>
<?php
//ezt most a termékek fülön érhetjük el

$termekek_szama_oldal = 6; //termekek száma egy oldalon

// az url-ben fog megjelenni a t (ami jelen esetben terméket jelent) majd mögé egy szám (jelenlegi oldalon az 1-es)
$jelenlegi_oldal = isset($_GET['t']) && is_numeric($_GET['t']) ? (int)$_GET['t'] : 1;


//ugyanúgy feltöltés dátuma szerint kérdezem le
$lekerdez = $pdo->prepare('SELECT * FROM termekek ORDER BY feltoltes_datuma DESC LIMIT ?,?');

// a bindValue segítségével az sql fogja tudni értelmezni az integer változókat, ami kell a limithez
$lekerdez->bindValue(1, ($jelenlegi_oldal - 1) * $termekek_szama_oldal, PDO::PARAM_INT); //az sql lekérdezés 1. helyére utal
$lekerdez->bindValue(2, $termekek_szama_oldal, PDO::PARAM_INT);
$lekerdez->execute();


$termekek = $lekerdez->fetchAll(PDO::FETCH_ASSOC);


//megvizsgálja a termékek számát
$termekek_szama = $pdo->query('SELECT * FROM termekek')->rowCount(); //a rowCount függvény visszaadja a lekérdezésben a sorok számát





?>

<?= fejlec('Termékek') ?>

<div class="container">
    <p class="my-3"><?= $termekek_szama ?> termék található</p>
    <hr>
    <div class="row m-3">
        <?php
        //$kategoriak = $pdo->prepare("SELECT * FROM `termekek` WHERE termek_tipus IN ('feherje','kreatin,'shaker,edzeselotti')");
        ?>
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
                    <?php foreach ($termekek as $termek) : ?> <!-- foreach segítségével addig fut le amíg talál termékeket (szóval jelen esetben 4-szer) -->
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
                            <a href="index.php?oldal=termek&id=<?= $termek['id'] ?>"> <!-- adatbázisból meghívom a termékek nevét, leírás, árát, képét, stb.. -->
                                <div class="card h-100 border-0 " style="width: 15rem; ">
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



                <?php endif; ?>
                <div class="row mb-3">

                    <div class="col text-end">
                        <?php if ($jelenlegi_oldal > 1) : ?> <!-- tulajdonképpen ha nem a fő termékek oldalon vagyunk akkor fog megjelenni ez gomb -->
                            <a href="index.php?oldal=termekek&t=<?= $jelenlegi_oldal - 1 ?>">
                                <button type="button" class="btn btn-outline-secondary border-0"><i class="bi bi-arrow-left-circle fs-4"></i></button>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col">
                        <!-- ha túllépi a négyet, akkor megjelenik a gomb, amivel tovább navigál a második oldalra -->
                        <?php if ($termekek_szama > ($jelenlegi_oldal * $termekek_szama_oldal) - $termekek_szama_oldal + count($termekek)) : ?>
                            <a href="index.php?oldal=termekek&t=<?= $jelenlegi_oldal + 1 ?>">
                                <button type="button" class="btn btn-outline-secondary border-0"><i class="bi bi-arrow-right-circle fs-4"></i></button>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= lablec() ?>