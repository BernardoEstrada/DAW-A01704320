<?php
function connectDb(){
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $dbname = "perrostest";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Checks connection
    if(!$con){
        die("Estamos trabajando para arreglar este problema! " . mysqli_connect_error());
    }

    return $con;
}

function closeDb($mysqli){
    mysqli_close($mysqli);
}

function getDogs(){
    $conn = connectDb();

    $sql = "select idPerro,nombre,edadEstimadaLlegadaMeses,fechaLlegada,TIMESTAMPDIFF(MONTH, DATE_ADD(fechaLlegada, INTERVAL -edadEstimadaLlegadaMeses MONTH), CURDATE()) as edad from perros";

    $result = mysqli_query($conn, $sql);

    closeDb($conn);
    return $result;
}

function getDogsByAge($min, $max){
    $conn = connectDb();

    $sql = "select idPerro,nombre,edadEstimadaLlegadaMeses,fechaLlegada,TIMESTAMPDIFF(MONTH, DATE_ADD(fechaLlegada, INTERVAL -edadEstimadaLlegadaMeses MONTH), CURDATE()) as edad from perros HAVING Edad BETWEEN ".$min." AND ".$max;

    $result = mysqli_query($conn, $sql);

    closeDb($conn);
    return $result;
}