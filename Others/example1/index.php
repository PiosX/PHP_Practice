<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once("class.php");
        require_once("konst.php");

        $a = new Panel();
        $b = new Przycisk();

        $a->dodaj('przyklad', 3, 4);

        echo $a->zwrocIlosc();
        echo "<br />";

        $c = new Gracz("Max", "187");
        $d = new Punktacja("70");

    ?>
</body>
</html>