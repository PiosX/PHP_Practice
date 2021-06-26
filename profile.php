<?php
    session_start();
    require_once("dbh_connection.php");
    $login = $_SESSION['login'];
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
        <h1>PROFILE PAGE</h1>
        <a href="content.php?action=logout"><input id="lout" type="submit" value="Logout" name="logout" /></a>
    </div>
    <div id="main-container">
        <div>
            <?php
                if(isset($_GET['profile']))
                {
                    $log = $_GET['profile'];
                    $stmt = $dbh->prepare("SELECT login FROM online_users WHERE login = '$log'");
                    $stmt->execute();

                    while($row = $stmt->fetch())
                    {
                        echo $row['login'];
                    }
                }
            ?>
        </div>
    </div>
    <div id="bottom-container">

    </div>
</body>
</html>