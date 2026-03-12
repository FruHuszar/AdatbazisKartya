<?php
    require_once "ab.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magyarkártya | Fru huszar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        try {
            $adatbazis = new AB();
            //echo "Sikerült a kapcsolódás";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        /*
        $matrix = $adatbazis->oszlopBeolvas("kep", "szin");
        $adatbazis->megjelenit($matrix); 
        $matrix = $adatbazis->oszlopBeolvasTobb("szinAzon", "kep", "szin");
        $adatbazis->megjelenitTobb($matrix);
        //echo $adatbazis->meret("szin");*/

        if ($adatbazis->meret("kartya") == 0) {
            $adatbazis->feltoltes();
        }

        $objektumMatrix = $adatbazis->kartyakBeolvasasa();
        $kartyak = $adatbazis->kartyaObjektumok($objektumMatrix);
        $adatbazis->kartyakDivben($kartyak);
        /*$tombMatrix = $adatbazis->tombbeAlakit($objektumMatrix);
        $adatbazis->tombMatrixMegjelenitese($tombMatrix);*/

        $adatbazis->kapcsolatLezar();
        
     ?>
</body>
</html>