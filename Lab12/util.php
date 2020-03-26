<?php
function limpia_entrada($variable) {
    return $variable = htmlspecialchars($variable);
}

function verifyCredentials($user, $pass){
    $salt = "3521";
    $hashed = "383fcf6f93c466c3554f95d9edd1f5e2a3625b19e2fa2c34e9259d82af927ccd"; //hash for password "pass" and salt "3521"

    //print_r(hash("sha256", $pass.$salt));
    //print_r($user." - ".$pass);
    if($user == "" && $pass == "" && isset($user) && isset($pass)){
        throw new Exception("Please enter username and password");
    }
    else if($user != "berni" || hash("sha256", $pass.$salt) != $hashed){
        //sleep(3);
        throw new Exception("Incorrect credentials");
    }

    return true;
}
?>