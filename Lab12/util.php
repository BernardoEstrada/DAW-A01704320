<?php
function limpia_entrada($variable) {
    return $variable = htmlspecialchars($variable);
}

function verifyCredentials($user, $pass)
{

    //se agrega un salt a la contraseña y después se pasa por un hash para guardarla seguramente
    //esto se guardaría en la base de datos (y se accedería a través de un gestor)
    $logins = [
        "berni" => ["salt" => "3521", "hash" => "383fcf6f93c466c3554f95d9edd1f5e2a3625b19e2fa2c34e9259d82af927ccd"],
        "root" => ["salt" => "6584", "hash" => "c25693337a0c7902702fbe72945697a284d65b59806a6967b216b045cfb13223"],
        "test" => ["salt" => "4895", "hash" => "9dfdd4e55547837d572d2ee19d8e23d48f532a74d3e4746af00d9b48223b0bfb"],
    ];

    $fieldsEmpty = $user == "" || $pass == "" || !isset($user) || !isset($pass);
    if(!$fieldsEmpty){
        $keyExists = array_key_exists($user, $logins);
        if($keyExists){
//            print_r(hash("sha256", $pass.$logins[$user]["salt"]));
//            echo "<br>";
//            print_r($logins[$user]["hash"]);
            if(hash("sha256", $pass.$logins[$user]["salt"]) === $logins[$user]["hash"]){
                return true;
            } else {
                sleep(1);
                throw new Exception("Incorrect pass");
            }
        } else {
            sleep(1);
            throw new Exception("Incorrect credentials");
        }
    } else {
        sleep(1);
        throw new Exception("Please enter username and password");
    }
}
?>