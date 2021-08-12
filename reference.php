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
        function myFunc($price)
        {
            echo $price;
        }
        //myFunc(10);
        
        $name = 'Pios';
/*
        function test()
        {
            global $name;
            echo "hello $name";
        }

        test();
*/
        function test2(&$name)
        {
            $name = "John";
            echo "bye $name";
        }

        test2($name);
        echo $name;
    ?>
</body>
</html>