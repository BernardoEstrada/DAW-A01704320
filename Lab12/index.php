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
        if(isset($_POST["user"], $_POST["password"]) || isset($_SESSION["user"])){
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
//        include("createHash.php");
        include("_footer.html");
    }
?>
