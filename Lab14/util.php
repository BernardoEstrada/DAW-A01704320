<?php
function limpia_entrada($variable) {
    return $variable = htmlspecialchars($variable);
}

function check($inp, $ind){
    if(isset($inp[$ind])){
        return $inp[$ind];
    } else{
        return false;
    }
}

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
function filterDogs($minA, $maxA, $male, $female, $sort, $order){
    $conn = connectDb();

    if($maxA==144){
        $maxA=9999;
    }

    $sql = "
        select 
               idPerro,
               nombre,
               fechaLlegada,
               TIMESTAMPDIFF(MONTH, DATE_ADD(fechaLlegada, INTERVAL -edadEstimadaLlegadaMeses MONTH), CURDATE()) as edad 
        FROM perros";

    if($male XOR $female){
        if($male AND !$female){
            $sql.= " WHERE sexo='macho'";
        } else {
            $sql .= " WHERE sexo='hembra'";
        }
    }

    $sql.=" HAVING Edad BETWEEN " . $minA . " AND " . $maxA;

    switch($sort){
        case "name":
            $sql.=" ORDER BY nombre";
            break;
        case "timeIn":
            $sql.=" ORDER BY fechaLlegada";
            break;
        default:
            break;

    }
    if($sort!="" AND $order){
        $sql.=" ".$order;
    }

    echo $sql;
    $result = mysqli_query($conn, $sql);

    closeDb($conn);
    return $result;
}