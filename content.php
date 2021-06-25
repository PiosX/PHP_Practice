<?php
    session_start();
    if((time()-$_SESSION['time'] > 10*60) && $_SESSION['logged'] == 1)
    {
        $_SESSION['logged'] = 0;
        session_destroy();     
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Content Page</title>
</head>
<body>
    <div id="top-container">
        <h1>CONTENT PAGE</h1>
        <a href="index.php?action=logout"><input id="lout" type="submit" value="Logout" name="logout" /></a>
    </div>
    <div id="main-container">
        <?php
            if($_SESSION['logged'] == 1)
            {
                echo "Welcome: ".$_SESSION['login'];
            }
        ?>
    </div>
    <div id="bottom-container"></div>
</body>
</html>