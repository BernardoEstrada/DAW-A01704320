<?php

    $name = "";
    $email = "";
    $err = "";
    $phone = 0;
    $bday = "";
    $hid = TRUE;

    if(isset($_POST['submit'])){ //check if form was submitted
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $phone = htmlspecialchars($_POST["phone"]);
        $bday = new DateTime(htmlspecialchars($_POST["birthday"]));


        if (!preg_match("/^[a-zA-Z0-9\- ]*$/",$name)) {
            $err = $err."<br>"."Invalid Character in name";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = $err."<br>"."Invalid email format";
        }
        if(!preg_match("/^[0-9]{10}$/", $phone)) {
            $err = $err."<br>"."Phone is invalid";
        }
        if($err==""){
            $hid = FALSE;
        }
    }
?>