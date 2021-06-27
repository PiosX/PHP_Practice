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
    <div id="avatar"></div>
    <div>
        <form action="profile.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="10240" />
            <input type="file" name="image">
            <input type="submit" name="submit" value="Upload">
        </form>
            <?php
                if(isset($_POST['submit']))
                {
                    if(!empty($_FILES["image"]["name"]))
                    {
                        $fileName = basename($_FILES['image']['name']);
                        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
                        if(in_array($fileType, $allowedTypes))
                        {
                            $image = $_FILES['image']['tmp_name'];
                            $imgContent = addslashes($image);
                            $stmt = $dbh->prepare("SELECT * FROM avatars WHERE login = '$login'");
                            $stmt->execute();

                            if($stmt->rowCount()==0)
                            {
                                try
                                {
                                    $stmt = $dbh->prepare("INSERT INTO avatars (login,image) VALUES('$login','$imgContent')");
                                    $stmt->execute();
                                    $stmt->closeCursor();
                                }catch(PDOException $e)
                                {
                                    echo $e->getMessage();
                                }
                            }else if($stmt->rowCount()==1)
                            {
                                $stmt = $dbh->prepare("UPDATE avatars SET image = '$imgContent' WHERE login = '$login'");
                                $stmt->execute();
                                $stmt->closeCursor();
                            }

                        }
                        else
                        {
                            echo "Sorry, only JPG, JPEG, PNG OR GIF ar eallowed to upload.";
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