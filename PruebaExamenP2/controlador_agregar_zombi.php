<?php
require_once 'util.php';

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$estado = $_POST["estado"];
$incompleto = false;
// if(empty($nombre) || empty($apellido) || empty($estado)) {
//     $incompleto = true;
// }
// if($incompleto) {
//     echo "<script>alert(\"Por favor llena todos los campos.\")</script>";
//     header("location:vista_agregar_zombi.php");
// }
    agregarZombi($nombre, $apellido, $estado);
    header("location:index.php");


?>
