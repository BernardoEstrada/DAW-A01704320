<?php
function connectDB() {
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $dbname = "ep2";

    $con = mysqli_connect($servername, $username, $password, $dbname);
    $con->set_charset("utf8");
    //Checks connection
    if(!$con) {
        http_response_code(500);
        return false;
    }
    return $con;
}
?>