<?php
    require_once("dbh_connection.php");
    if(isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        echo "You have been logged out!";
        $dbh = null;
    }
    if(isset($_POST['logSubmit']))
    {
        if(isset($_POST['login']) && isset($_POST['password']) && !empty($_POST['login']) && !empty($_POST['password']))
        {
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);

            if(filter_var($login, FILTER_SANITIZE_STRING) || $_SESSION['logged'] == 1)
            {
                $stmt = $dbh->prepare("SELECT * FROM users WHERE login = :login");
                $stmt->bindParam(":login", $login);
                $stmt->execute();
                if($stmt->rowCount()>0)
                {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if(password_verify($password, $row['password']))
                    {
                        if($_SESSION['logged'] == 0)
                            $_SESSION['login'] = $login;

                        $_SESSION['logged'] = 1;
                        $_SESSION['time'] = time();
                        unset($row['password']);   
                        header('location:content.php');     
                        exit();        
                    }
                    else
                    {
                        $error[] = "Invalid Login or Password";
                    }
                }
                else
                {
                    $error[] = "Invalid Login or Password";
                }
            }
            else
            {
                $error[] = "Invalid login";
            }
        }
        else
        {
            $error[] = "Login and Password are required!";
        }
    }
?>