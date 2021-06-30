<?php
    session_start();
    require_once("dbh_connection.php");
    $login = $_SESSION['login'];
    $log = $_GET['profile'];
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
                    
                }
            ?>
        </div>
        <div id="message-container">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <label>
                    <textarea name="message" cols="30" rows="4" wrap="hard"></textarea>
                </label>
                <input type="submit" name="message-sub" value="Send" id="send-but"/>
            </form>
        </div> 
    </div>
    <div id="bottom-container">

    </div>
</body>
</html>