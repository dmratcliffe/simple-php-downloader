<?php
    include('settings.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    //this function simplifies hashing :p
    function quickhash($string){
        return hash("sha256", $string);
    }

    //check a hash against the master password
    function auth($hash_to_check){
        global $master_password;

        $master_hash = quickhash($master_password);

        if($master_hash == $hash_to_check){
            //log in persistently -- invalidate cache a day later.
            setcookie("session", $hash_to_check, time()+(3600*24), "/");
            return true;
        }else{
            return false;
        }
    }

    $isauth = false;

    //determine whether we are being given a password or checking if
    //the user is logged in
    $pass = isset($_POST['passphrase']) ? $_POST['passphrase'] : false;
    if($pass == false){
        $cookie_hash = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
        if($cookie_hash){
            $isauth = auth($cookie_hash);
        }
    }else{
        $pass_hash = quickhash($pass);
        $isauth = auth(quickhash($pass));
        header("Location: /");
    }
?>