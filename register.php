<?php
    require_once("dbh_connection.php");
    if(isset($_POST['submit']))
    {
        if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password']))
        {        
            $login = trim($_POST['login']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $cost = array("cost"=>12);
            $hashPwd = password_hash($password, PASSWORD_BCRYPT, $cost);

            if(filter_var($login, FILTER_SANITIZE_STRING) && filter_var($email, FILTER_SANITIZE_EMAIL))
            {
                try
                {
                    $stmt = $dbh->prepare("INSERT INTO users (login,email,password) VALUES (:login, :email, :password)");

                    $stmt->bindParam(":login", $login);
                    $stmt->bindParam(":email",$email);
                    $stmt->bindParam(":password", $hashPwd);

                    $stmt->execute();
                    $stmt->closeCursor();
                    $succes = "User has been created!";
                }
                catch(PDOException $e)
                {
                    $error[] = $e->getMessage();
                }
    
            }
            else
            {
                $error[] = "Uncorrect Login or Email";
            }


        }
    
        else
        {
            if(!isset($_POST['login']) || empty($_POST['login']))
            {
                $error[] = "Login is required!";
            }
            else if(!isset($_POST['email']) || empty($_POST['email']))
            {
                $error[] = "Email is required!";
            }
            else if(!isset($_POST['password']) || empty($_POST['password']))
            {
                $error[] = "Password is required!";
            }
        }
    }
?>