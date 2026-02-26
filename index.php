<?php 
    require_once "adatbazis.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adatbázis összekötése html-el | OOP</title>
    <meta name="description" content="desc">
    <meta name="keywords" content="ksz1,ksz2">
</head>
<body>
    <?php 
        try {
            //példányosítás
            $adatbazis = new AB();
            echo "Sikeres kapcsolódás";
        } catch (Exception $e) {
            //hibakezelés
            echo $e->getMessage();
        }
    ?>
</body>
</html>