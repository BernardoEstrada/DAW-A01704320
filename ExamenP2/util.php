<?php
include_once "dbConnect.php";

function closeDb($mysqli) {
    mysqli_close($mysqli);
}

//Función que conecta a la bd, realiza un query y vuelve a cerrar la bd. Recibe el SQL del query y regresa un objeto mysqli result
function sqlqry($qry) {
    $con = connectDb();
    if(!$con){
        return false;
    }

    $result = mysqli_query($con, $qry);
    closeDb($con);
    return $result;
}

function returnIncidentes(){
    
}