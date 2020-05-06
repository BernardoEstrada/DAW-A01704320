<?php
include_once "util.php";
    $_POST["idZombi"] = htmlspecialchars($_POST["idZombi"]);
    $_POST["estado"] = htmlspecialchars($_POST["estado"]);

    $dml = "INSERT INTO zombis_estados (idZombi, idEstado) VALUES (?,?)";
    echo insertIntoDb($dml, $_POST['idZombi'], $_POST['estado']);
?>
