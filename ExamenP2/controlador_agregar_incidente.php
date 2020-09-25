<?php
    include_once "util.php";
    $idL = htmlspecialchars($_POST["lugar"]);
    $idT = htmlspecialchars($_POST["tipoIn"]);

    if(sqlqry(" CALL agregaIncidente($idL, $idT)")){
        echo "Se registró el Incidente";
    }else{
        echo "Hubo un error";
    }
