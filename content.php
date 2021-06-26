<?php
    session_start();
    require_once("dbh_connection.php");
    if((time()-$_SESSION['time'] > 10*60) && $_SESSION['logged'] == 1)
    {
        $_SESSION['logged'] = 0;
        session_destroy();     
        header("location:index.php");
    }
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
        <h1>CONTENT PAGE</h1>
        <a href="content.php?action=logout"><input id="lout" type="submit" value="Logout" name="logout" /></a>
    </div>
    <div id="main-container">
    
        <p class="info">
            <?php
                if($_SESSION['logged'] == 1)
                {
                    echo "Welcome: ".$_SESSION['login'];
                }
                if(isset($_GET['action']) && $_GET['action'] == 'logout')
                {
                    $_SESSION['logged'] = 0;
                    $stmt = $dbh->prepare("DELETE FROM online_users WHERE login = '$login'");
                    $stmt->execute();
                    header("location:index.php?action=logout");
                    session_destroy();
                }
            ?>
        </p>
        <table>
            <thead>
                <tr>
                    <th>Login</th>
                    <th>silver</th>
                    <th>gold</th>
                    <th>iron</th>
                    <th>wood</th>
                    <th>stone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    
                        $stmt = $dbh->prepare("SELECT users.login, silver, gold, iron, wood, stone FROM resources INNER JOIN users ON users.id = resources.user_id WHERE users.login = :login");
                
                        $stmt->bindParam(":login", $login);
                        $stmt->execute();
                        if($stmt->rowCount()>0)
                        {
                        while($row = $stmt->fetch())
                        {
                            echo "<td>".$row['login']."</td>";
                            echo "<td>".$row['silver']."</td>";
                            echo "<td>".$row['gold']."</td>";
                            echo "<td>".$row['iron']."</td>";
                            echo "<td>".$row['wood']."</td>";
                            echo "<td>".$row['stone']."</td>";
                        }
                        }
                        $stmt->closeCursor();
                    ?>
                </tr>
            </tbody>
        </table>
            <?php
                if($_SESSION['logged'] == 1)
                {
                    $stmt = $dbh->prepare("SELECT * FROM online_users WHERE login = '$login'");
                    $stmt->execute();

                    if($stmt->rowCount() == 0)
                    {
                        $stmt = $dbh->prepare("INSERT INTO online_users(login) VALUES('$login')");

                        $stmt->execute();
                    }
                    
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
                    
                }
            ?>
    </div>
    <div id="bottom-container">
        <p>
            <?php
                require_once("login.php");
                         
                $stmt = $dbh->prepare("SELECT register_date FROM users WHERE login = '$login'");
                
                $stmt->execute();
    
                while($row = $stmt->fetch())
                {
                    echo "Your register date: ".$row['register_date'];
                }
                $stmt->closeCursor();
            ?>
        </p>
    </div>
</body>
</html>