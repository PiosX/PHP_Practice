<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        class User
        {
            public $login;
            public $email;

            public function __construct($login, $email)
            {
                $this->login = $login;
                $this->email = $email;
            }

            public function getInfo()
            {
                return $this->login;
            }

            public function setInfo($login)
            {
                return $this->login = $login;
            }
        }

        class Moderator extends User
        {
            public $level;

            public function __construct($login,$email,$level)
            {
                $this->level = $level;
                parent::__construct($login,$email);
            }
        }

        $user = new User("Pios", "pisos@op.pl");
        $mod = new Moderator("Maxx", "maksi@pp.pl", 5);

        
        //echo $user->setInfo("Maxx");
        echo $user->login;
        echo $mod->login;
    ?>
</body>
</html>