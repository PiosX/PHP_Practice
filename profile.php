<?php
    session_start();
    require_once("dbh_connection.php");
    $login = $_SESSION['login'];
    $log = $_GET['profile'];
    if((time()-$_SESSION['time'] > 10*60) && $_SESSION['logged'] == 1)
    {
        $_SESSION['logged'] = 0;
        $stmt = $dbh->prepare("DELETE FROM online_users WHERE login = '$login'");
        $stmt->execute();
        header("location:index.php?action=logout");
        session_destroy();
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
        <h1>PROFILE PAGE</h1>
        <a href="content.php?action=logout"><input id="lout" type="submit" value="Logout" name="logout" /></a>
    </div>
    <div id="main-container">
    <a href="content.php" class="backpg">Back</a>
    <div id="avatar">
        <?php
        require_once("checkUser.php");
            if(isset($_GET['profile'])&&$_GET['profile'] == $log)
            {
                $stmt = $dbh->prepare("SELECT * FROM avatars WHERE login = '$log'");
                $stmt->execute();
                
                
                if($stmt->rowCount()>0)
                {
                    while($row = $stmt->fetch())
                    {
            ?>
            <img src="images/<?php echo $row['image']; ?>" width="150px" height="150px"/>
            <?php
                    }
                }
            }
            else
            {
                header("Location:profile.php?profile=$login");
            }
            if($_GET['profile'] == '')
            {
                header("Location:profile.php?profile=$login");
            }
        ?>
    </div>
    <div>
        <?php 
        
            if($_GET['profile'] == $login)
            {
        ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                <input type="file" name="image">
                <input type="submit" name="submit" value="Upload">
            </form>
        <?php
            }else if($_GET['profile'] != $login)
            {
                echo "<a href='chat.php?profile=$log'>Begin Chat!</a>";
            }
        ?>
            <?php
                if(isset($_POST['submit']))
                {
                    if(!empty($_FILES["image"]["name"]))
                    {
                        define("MB", 1048576);
                        if($_FILES['image']['size'] < 5*MB)
                        {
                            $fileName = basename($_FILES['image']['name']);
                            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
                            if(in_array($fileType, $allowedTypes))
                            {
                                $image = $_FILES['image']['name'];
                                $encImage = md5(rand()*rand()+rand()).$image;
                            
                                if(move_uploaded_file($_FILES['image']['tmp_name'],"images/".$encImage))
                                {
                                    $stmt = $dbh->prepare("SELECT * FROM avatars WHERE login = '$login'");
                                    $stmt->execute();
                                    if($stmt->rowCount()>0)
                                    {
                                        $stmt = $dbh->prepare("UPDATE avatars SET image = '$encImage' WHERE login = '$login'");
                                        $stmt->execute();
                                        header("Refresh: 0");
                                        echo "Update succes!";
                                    }
                                    else if($stmt->rowCount()==0)
                                    {
                                        $stmt = $dbh->prepare("INSERT INTO avatars(login,image) VALUES('$login', '$encImage')");
                                        $stmt->execute();
                                        header("Refresh: 0");
                                        echo "Insert succes!";
                                    }
                                    
                                } 
                            }
                            else
                            {
                                echo "Sorry, only JPG, JPEG, PNG OR GIF ar eallowed to upload.";
                            }
                        }
                        else
                        {
                            echo "File is too big!";
                        }
                    }
                    else
                    {
                        echo "Please select an imgae to upload.";
                    }
                }
            ?>
    </div>
        <div>
            <?php
                if(isset($_GET['profile'])&&$_GET['profile'] == $log)
                {
                    $log = $_GET['profile'];
                    $stmt = $dbh->prepare("SELECT login FROM online_users WHERE login = '$log'");
                    $stmt->execute();

                    while($row = $stmt->fetch())
                    {
                        echo "<p>".$row['login']."</p>";
                    }
                }
                else
                {
                    header("Location:profile.php?profile=$login");
                }
            ?>
        </div>
    </div>
    <div id="bottom-container">

    </div>
</body>
</html>