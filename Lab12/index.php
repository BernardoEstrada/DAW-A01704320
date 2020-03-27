<?php
    session_start();
    require_once("util.php");

    //limpia las entradas
    if (isset($_POST["user"])) {
        $_POST["user"] = limpia_entrada($_POST["user"]);
    }
    if (isset($_POST["password"])) {
        $_POST["password"] = limpia_entrada($_POST["password"]);
    }



    try{
        if(isset($_POST["user"], $_POST["password"])){
            if (!isset($_SESSION["user"])) {
                verifyCredentials($_POST["user"], $_POST["password"]);
                $_SESSION["user"] = $_POST["user"];
            }
            include("_header.html");
            include("_user.html");
        } else {
            include("_header.html");
            include("_login.html");
        }
    } catch(Exception $e){
        $error = $e->getMessage();
        include("_header.html");
        include("_login.html");
    } finally{
        include("_footer.html");
    }
//------------------------------------------------
/*
    if (isset($_SESSION["user"])) {
        include("_header.html");
        include("_user.html");
    }

    else if (verifyCredentials($_POST["user"], $_POST["password"])) {
        $_SESSION["user"] = $_POST["user"];
        include("_header.html");
        include("_user.html");
    }


    else if ($_POST["user"] == "" && $_POST["password"] == ""
        && isset($_POST["user"])  && isset($_POST["password"]) ) {
        $error = "Ingresa tu user y contraseña";
        include("_header.html");
        include("_login.html");
    }

    else if(isset($_POST["user"]) || isset($_POST["password"]) ) {
        sleep(3);
        $error = "Usuario y/o password incorrectos";
        include("_header.html");
        include("_login.html");
    }

    else {
        include("_header.html");
        include("_login.html");
    }

    include("_footer.html");
*/
    //print_r($_SESSION);
?>
