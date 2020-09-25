<?php
include_once "util.php";

$view = isset($_POST["view"]) ? htmlspecialchars($_POST["view"]) : 1;
$sel = isset($_POST["sel"]) ? htmlspecialchars($_POST["sel"]) : 1;

echo  "<table class=\"highlight striped\">";
switch($view) {
    case 1:
    default:
        echo muestraZombis();
        break;
    case 2:
        echo muestraEstadosZombis();
        break;
    case 3:
        echo muestraRegistros();
        break;
    case 4:
        $select = "<select id=\"estado\" name=\"estado\">";
        $select.= getOpcionesSelected('idEstado', 'nombreEstado', 'estados', $sel);
        $select.= "</select>";
        echo $select;
        echo muestraPorEdo($sel);
        break;
}
echo  "</table>";