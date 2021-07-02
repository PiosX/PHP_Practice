<?php
    session_start();
    require_once("dbh_connection.php");
    require_once("checkUser.php");
    $login = $_SESSION['login'];
    $log = $_GET['profile'];

    if(isset($_GET['profile']) && $_GET['profile'] = $log && $_SESSION['logged'] == 1)
    {
        $stmt = $dbh->prepare("SELECT login FROM users WHERE login = '$log'");
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch())
            {
                echo "<div id='chat-inf'>Chat with: ".$row['login']."</div>";
            }
        }else{
            echo "Not Found.";
        }
        $stmt = $dbh->prepare("SELECT send_by, send_to, message FROM messages WHERE (send_by = '$login' AND send_to = '$log') OR (send_by = '$log' AND send_to = '$login')");
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
            while($row = $stmt->fetch())
            {
                if($row['send_by'] == $login)
                {
                    echo "<div class='msg-box'>".$row['message']."</div>";
                }
                else
                {
                    echo "<div class='msg-box-2'>".$row['message']."</div>";
                }
            }
            
        }
                        
    }
?>