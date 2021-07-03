<?php
    session_start();
    require_once("dbh_connection.php");
    $login = $_SESSION['login'];

    $stmt = $dbh->prepare("SELECT login FROM online_users");

    $stmt->execute();
    echo "<h3>Online Users (".$stmt->rowCount()."):</h3>";
    
    if($stmt->rowCount()>0)
    {
        while($row = $stmt->fetch())
        {
            echo "<a href='profile.php?profile=".$row['login']."'>".$row['login'].", </a>";
        } 
    }
?>