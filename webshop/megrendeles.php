<?php

if (isset($_SESSION["user_id"])) {
} else {
    // felhasználó nincs bejelentkezve, átirányítás a bejelentkező oldalra
    header("Location: ../loginkondi.php");
    exit;
}
fejlec("Megrendelés")
?>

<div class="container w-50 border border-3 p-5">
    <h3 class="fs-3 text-center mb-3"> Szállítási/számlázási információk</h3>

    <form action="megrendeles_conf.php" method="post">
        <div class="mb-3">
            <label for="megye" class="form-label">Vezetéknév:</label>
            <input type="text" class="form-control" name="vezeteknev" id="vezeteknev" required>
        </div>
        <div class="mb-3">
            <label for="megye" class="form-label">Keresztnév:</label>
            <input type="text" class="form-control" name="keresztnev" id="keresztnev" required>
        </div>
        <div class="mb-3">
            <label for="megye" class="form-label">E-mail cím:</label>
            <input type="text" class="form-control" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="megye" class="form-label">Megye:</label>
            <input type="text" class="form-control" name="megye" id="megye" required>
        </div>
        <div class="mb-3">
            <label for="varos" class="form-label">Város:</label>
            <input type="text" class="form-control" name="varos" id="varos" required>
        </div>
        <div class="mb-3">
            <label for="utca" class="form-label">Utca:</label>
            <input type="text" class="form-control" name="utca" id="utca" required>
        </div>
        <div class="mb-3">
            <label for="hazszam" class="form-label">Házszám:</label>
            <input type="text" class="form-control" name="hazszam" id="hazszam" required>
        </div>
        <div class="mb-3">
            <label for="hazszam" class="form-label">Telefonszám:</label>
            <input type="text" class="form-control" name="telefonszam" id="telefonszam" required>
        </div>



        <input type="hidden" class="form-control" name="osszeg" id="osszeg" value="<?= $_SESSION['osszeg']  ?>">
        <div class="mb-3">
            <label for="vegosszeg" class="form-label">Végösszeg:</label>
            <input type="text" class="form-control" value="<?= $_SESSION['osszeg']  ?> Ft" disabled>
        </div>

        <button type=" submit" name="gomb" class="btn btn-primary">Submit</button>
    </form>


</div>