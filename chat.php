<?php
    session_start();
    require_once("dbh_connection.php");
    require_once("checkUser.php");
    $login = $_SESSION['login'];
    $log = $_GET['profile'];

    if(isset($_GET['profile']) && $_GET['profile'] == $login)
    {
        header("Location:profile.php?profile=$login");
    }
    if(isset($_GET['profile']) && $_GET['profile'] == '')
    {
        header("Location:profile.php?profile=$login");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Chat</title>
</head>
<body>
    <div id="top-container">
        <h1>CHAT PAGE</h1>
        <a href="content.php?action=logout"><input id="lout" type="submit" value="Logout" name="logout" /></a>
    </div>
    <div id="main-container">
        <a href="content.php" class="backpg">Back</a>
        <div id="chat-container">
            <?php
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
        </div>
        <div id="message-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <label>
                    <textarea name="message" cols="30" rows="4" wrap="hard"></textarea>
                </label>
                <input type="submit" name="message-sub" value="Send" id="send-but"/>
            </form>
            <?php
                if($_SESSION['logged'] == 1)
                {
                    if(isset($_GET['profile']) && $_GET['profile'] = $log)
                    {
                        if(isset($_POST['message-sub']))
                        {
                            if(isset($_POST['message']) && $_POST['message'] != '')
                            {
                                $mess = $_POST['message'];
                                $stmt = $dbh->prepare("INSERT INTO messages(send_by, send_to, message) VALUES('$login', '$log', '$mess')");
                                $stmt->execute();
                                header("Refresh: 0");
                            }
                            else
                            {
                                echo "Write something...";
                            }
                        }
                    }
                }
            ?>
        </div> 
    </div>
    <div id="bottom-container">

    </div>
</body>
</html>