<?php



require __DIR__ . '/functions.php';

$pdo = connect_mysql();

$vasarlok = $pdo->prepare('INSERT INTO vasarlok (vezeteknev, keresztnev, email, megye, varos, utca, hazszam, telefonszam) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$vasarlok->bindParam(1, $_POST["vezeteknev"], PDO::PARAM_STR);
$vasarlok->bindParam(2, $_POST["keresztnev"], PDO::PARAM_STR);
$vasarlok->bindParam(3, $_POST["email"], PDO::PARAM_STR);
$vasarlok->bindParam(4, $_POST["megye"], PDO::PARAM_STR);
$vasarlok->bindParam(5, $_POST["varos"], PDO::PARAM_STR);
$vasarlok->bindParam(6, $_POST["utca"], PDO::PARAM_STR);
$vasarlok->bindParam(7, $_POST["hazszam"], PDO::PARAM_STR);
$vasarlok->bindParam(8, $_POST["telefonszam"], PDO::PARAM_STR);

$beszuras = $pdo->prepare('INSERT INTO rendelesek (vasarlo_id, rendeles_datuma, rendeles_osszege) VALUES (:vasarlo_id, CURRENT_DATE, :osszeg)');
$beszuras->bindParam("osszeg", $_POST["osszeg"], PDO::PARAM_INT);

if ($vasarlok->execute()) {
    $vasarlok_id = $pdo->lastInsertId();
    $beszuras->bindParam("vasarlo_id", $vasarlok_id, PDO::PARAM_INT);
    if ($beszuras->execute()) {
        echo "Sikeres rendelés";
        session_destroy();
        header("location: index.php?oldal=home");
    } else {
        die("Sikertelen rendelés, nem sikerült beszúrni a rendelést az adatbázisba!");
    }
} else {
    die("Sikertelen rendelés, nem sikerült beszúrni a vásárlót az adatbázisba!");
}
