<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Open_ssl</title>
</head>
<body>
<?php

    echo '<pre>';  
    $password = "noman23123@DF09.4RF";
    $hash = password_hash($password, PASSWORD_BCRYPT); //SAVE THIS HASH IN DATABASE(COLUMN TYPE:VARCHAR,LENGTH:255)

    //TO VERIFY, FIRST FIND USER AND THEN MATCH HASH WHICH ADD ONE MORE LAYER INTO YOUR WEBSITE SECURITY.
    /*
    $user = SELECT username, password FROM users
    WHERE username = 'noman'
    LIMIT 1;
    $hash = $user->password_hash; //field name containing password hash
     */
    if (password_verify($password, $hash)) { // $password is user entered password at time of login
        echo "Let me in, I'm genuine!";
    }else{
        echo "invalid";
    }


    echo '</pre>';
?>
</body>
</html>