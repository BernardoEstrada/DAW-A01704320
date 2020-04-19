<?php

require_once "util.php";

$minAge = isset($_GET["minAge"])?limpia_entrada($_GET["minAge"]):0;
$maxAge = isset($_GET["maxAge"])?limpia_entrada($_GET["maxAge"]):144;
$sort = isset($_GET["sort"])?limpia_entrada($_GET["sort"]):"";
$order = isset($_GET["order"])?$_GET["order"]:false;

//$result = getDogsByAge($_GET["minAge"],$_GET["maxAge"]);
$result = filterDogs($minAge,$maxAge,check($_GET, "macho"),check($_GET, "hembra"), $sort, $order);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        //Des-comentar cuando se hayan agregado imagenes
        //$img = "img/dog".$row["idPerro"].".jpg";
        $img = "img/Mario.jpg";
        $name = $row["nombre"];
        $test = $row["fechaLlegada"];

        $m = $row["edad"];
        $a = ($m-$m%12)/12;
        $m = $m%12;

        $age= $a.' Años, '.$m.' Meses';

        $age = '';
        if($a>0){
            $age = $a.' '.($a==1?'Año':'Años');
        }
        //El $a <= 3 se puede quitar, solo es preferencia para mostrar los meses solo para perros menores a 3 años
        if($m>0 AND $a<=3){
            $age = $age.', '.$m.' '.($m==1?'Mes':'Meses');
        }

        include("_tarjetaPerro.html");

    }
}
