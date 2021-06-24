<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Main Page</title>
</head>
<body>
    <div id="top-container">
        <h1>EXAMPLE PAGE</h1>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <label>
                Login: <br />
                <input type="text" name='login' /><br />
            </label>
            <label>
                Password: <br />
                <input type="password" name='password' /><br />
            </label>
                <input type="submit" value="Sign In" />
        </form>
        <?php
            require_once("login.php");
            if(isset($error) && count($error) > 0)
            {
                foreach($error as $error_msg)
                {
                    echo "<div class='alert-error'>$error_msg</div>";
                }
            }
        ?>
    </div>
    <div id="main-container">
        <h2>REGISTER</h2>
        <form id="reg" action="index.php" method="POST" enctype="multipart/form-data">
            <label>
                Login: <input type="text" name='login' required /><br>
            </label>
            <label>
                Email: <input type="email" name ='email' required /><br>
            </label>
            <label>
                Password: <input type="password" name='password' required /><br>
            </label>
                <input type="submit" name="submit" value="Register" />
                <input type="reset" value="Reset" />
        </form>
        <?php
            require_once("register.php");
            if(isset($error) && count($error) > 0)
            {
                foreach($error as $error_msg)
                {
                    echo "<div class='alert-error'>$error_msg</div>";
                }         
            }
            if(isset($succes))
            {
                echo "<div class='alert-succes'>$succes</div>";
            }
        ?>
    </div>
    <div id="bottom-container"></div>
</body>
</html>