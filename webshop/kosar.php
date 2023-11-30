<?php

if (isset($_SESSION["user_id"])) {
} else {
    // felhasználó nincs bejelentkezve, átirányítás a bejelentkező oldalra
    header("Location: ../loginkondi.php");
    exit;
} ?>
<?php
// ha a felhasználó rákattint a kosárba helyezésre, akkor ez aktiválódik
if (isset($_POST['termek_id'], $_POST['keszlet']) && is_numeric($_POST['termek_id']) && is_numeric($_POST['keszlet'])) {
    //példányosítom a termékek id-át, illetve készletét integerbe
    $termek_id = (int)$_POST['termek_id'];
    $keszlet = (int)$_POST['keszlet'];

    //felkészítem a lekérdezést, ahol kiderül, hogy van-e a termék az adatbázisban
    $lekerdez = $pdo->prepare('SELECT * FROM termekek WHERE id = ?');
    $lekerdez->execute([$_POST['termek_id']]);

    $termek = $lekerdez->fetch(PDO::FETCH_ASSOC);

    //megnézem hogy a tömb üres-e
    if ($termek && $keszlet > 0) {
        //ha a termék létezik, akkor frissítem a SESSION-t
        if (isset($_SESSION['kosar']) && is_array($_SESSION['kosar'])) {
            if (array_key_exists($termek_id, $_SESSION['kosar'])) {
                $_SESSION['kosar'][$termek_id] += $keszlet; //frissítem kosárba helyezésnél a készletet
            } else {
                $_SESSION['kosar'][$termek_id] = $keszlet;
            }
        } else {
            $_SESSION['kosar'] = array($termek_id => $keszlet);
        }
    }
    header("location: index.php?oldal=kosar");
    exit;
}


//termék törlése a kosárból
if (isset($_GET['torles']) && is_numeric($_GET['torles']) && isset($_SESSION['kosar']) && isset($_SESSION['kosar'][$_GET['torles']])) {
    unset($_SESSION['kosar'][$_GET['torles']]);
}

//készlet folyamatos frissítése, ha berak a felhasználó egy terméket a kosárba
if (isset($_POST['frissit']) && isset($_SESSION['kosar'])) {
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'keszlet') !== false && is_numeric($v)) {
            $id = str_replace('keszlet-', ' ', $k);
            $keszlet = (int)$v;
            if (is_numeric($id) && isset($_SESSION['kosar']) && $keszlet > 0) {
                $_SESSION['kosar'][$id] = $keszlet;
            }
        }
    }
    header("location: index.php?oldal=kosar");
    exit;
}


if (isset($_POST['megrendeles']) && isset($_SESSION['kosar']) && !empty($_SESSION['kosar'])) {
    header("location: index.php?oldal=megrendeles");
    exit;
}


$kosar_termekek = isset($_SESSION['kosar']) ? $_SESSION['kosar'] : array();
$termekek = array();
$vegosszeg = 0; // alap értéknek 0-át állítok be, majd ez a termékek alapján növekedni fog
//ha van termék a kosárban (tehát a kosar_termekek van értéke)
if ($kosar_termekek) {
    //azokat a termékeket amelyek benne vannak a kosárban, azokat kiolvasom az adatbázisból(legalábbis az id-jét)
    $tomb = implode(',', array_fill(0, count($kosar_termekek), '?'));
    $lekerdez = $pdo->prepare('SELECT * FROM termekek WHERE id IN (' . $tomb . ')');

    $lekerdez->execute(array_keys($kosar_termekek));

    //kiveszem az értéket az adatbázisból, majd visszatér az értéke egy tömb szerint
    $termekek = $lekerdez->fetchAll(PDO::FETCH_ASSOC);

    //végösszeg kiszámítása
    foreach ($termekek as $termek) {
        $vegosszeg += (int)$termek['ar'] * (int)$kosar_termekek[$termek['id']];
        $_SESSION['osszeg'] = $vegosszeg;
    }
}
?>

<?= fejlec('Kosár') ?>

<div class="container">
    <form action="index.php?oldal=kosar" method="post">
        <div class="row">
            <div class="col-8">
                <h2 class="my-4">Rendelt termékek</h2>
                <?php if (empty($termekek)) : ?>
                    <h3>Nincs jelenleg semmi a kosaradban!</h3>
                <?php else : ?>
                    <?php foreach ($termekek as $termek) : ?>
                        <div class="card mb-3" style="max-width: 700px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <a href="index.php?oldal=termek&id=<?= $termek['id'] ?> ">
                                        <img src="../../Pic/<?= $termek['img'] ?>" class="img-fluid rounded-start" alt="<?= $termek['nev'] ?>">
                                    </a>
                                </div>
                                <div class="col-md-8">

                                    <div class="card-body">
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
                                        <h2 class="fs-3 card-title"><a href="index.php?oldal=termek&id=<?= $termek['id'] ?>"><?= $termek['nev'] ?></a></h2>
                                        <a href="index.php?oldal=kosar&torles=<?= $termek['id'] ?>" class="torles"><button type="button" class="btn btn-danger">Törlés</button>

                                        </a>

                                        <p class="card-text"><?= $termek['ar'] * $kosar_termekek[$termek['id']] ?> Ft</p>

                                        <input type="number" name="keszlet-<?= $termek['id'] ?>" value="<?= $kosar_termekek[$termek['id']] ?>" min="1" max="<?= $termek['keszlet'] ?>" placeholder="Készlet:" required>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div class="col-4">
                <div class="card my-4" style="max-width: 18rem; height:30rem;">
                    <div class="card-body">
                        <h1 class="card-title"> Végösszeg: </h1>
                        <span class="my-3"><?= $vegosszeg ?> Ft</span><br>

                        <button type="submit" name="frissit" class="btn btn-outline-info my-3">Frissités</button><br>
                        <button type="submit" name="megrendeles" class="btn btn-outline-success my-3">Megrendelés</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= lablec() ?>