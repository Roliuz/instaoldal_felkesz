<?php

if (isset($_SESSION["user_id"])) {
} else {
    // felhasználó nincs bejelentkezve, átirányítás a bejelentkező oldalra
    header("Location: ../loginkondi.php");
    exit;
} ?>
<?php

if (isset($_GET['id'])) {
    $lekerdez = $pdo->prepare('SELECT * FROM termekek WHERE id = ?');
    $lekerdez->execute([$_GET['id']]);

    $termek = $lekerdez->fetch(PDO::FETCH_ASSOC);

    //ha esetleg a kért termék nem létezik, vagy nincs ilyen termék id az adatbázisban
    if (!$termek) {
        exit("A kért termék nem létezik.");
    }
} else {
    exit("A kért termék nem létezik."); //ugyanazt csinálja mint a felső
}
?>

<?= fejlec('Termékek') ?>


<div class="container">
    <div class="row">
        <div class="col">
            <style>
                img {
                    max-width: 400px;

                }
            </style>
            <img src="../../Pic/<?= $termek['img'] ?>" alt="<?= $termek['nev'] ?>" class="m-4 ">
        </div>
        <div class="col mt-5">
            <h1 class="fs-3"><?= $termek['nev'] ?></h1>
            <h4><?= $termek['ar']  ?> Ft</h4>
            <form action="index.php?oldal=kosar" method="post">

                <input type="number" name="keszlet" value="1" min="1" max="<?= $termek['keszlet'] ?>"> <!-- maximum érték a készlet értéke -->

                <input type="hidden" name="termek_id" value="<?= $termek['id'] ?>"><br>

                <input type="submit" value="Kosárba" class="btn btn-outline-success my-3">

            </form>
            <div class="row">
                <p><?= $termek['leiras'] ?></p>
            </div>
        </div>
    </div>
</div>

<?= lablec() ?>