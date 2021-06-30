<?php
    require_once("dbh_connection.php");
    $login = $_SESSION['login'];

    $stmt = $dbh->prepare("SELECT login FROM users");
    $stmt->execute();
    while($row = $stmt->fetch())
    {
        $loginArr[] = $row['login'];
    }
    if(!in_array($_GET['profile'], $loginArr))
    {
        header("Location:profile.php?profile=$login");
    }
?>