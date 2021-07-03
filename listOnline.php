<h4>Users:</h4>
<ul>
<?php
    session_start();
    require_once("dbh_connection.php");
    $login = $_SESSION['login'];

    $stmt = $dbh->prepare("SELECT login FROM online_users");
    $stmt->execute();
    while($row = $stmt->fetch())
    {
        $onlineArr[] = $row['login'];
    }
    $stmt = $dbh->prepare("SELECT users.login FROM `users`");
    $stmt->execute();

    while($row = $stmt->fetch())
    {
        if(in_array($row['login'],$onlineArr))
        {
            echo "<li><a href='profile.php?profile=".$row['login']."' style='color:green;'>".$row['login']."</a></li>";
        }
        else
        {
            echo "<li><a href='profile.php?profile=".$row['login']."' style='color:red;'>".$row['login']."</a></li>";
        }
        
    }
?>
</ul>