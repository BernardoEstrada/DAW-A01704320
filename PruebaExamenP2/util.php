<?php
function connectDB() {
    $servername = 'localhost';
    $username = "root";
    $password = "";
    $dbname = "demo";

    $con = mysqli_connect($servername, $username, $password, $dbname);

    //Checks connection
    if(!$con) {
        http_response_code(500);
        return false;
    }
    return $con;
}

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

/*
    Función para simplificar la inserción correcta a la bd. Recibe el código SQL donde los valores q insertar se representan con '?'
    E.g. INSERT INTO frutas (nombre, familia, precio) VALUES (?,?,?)
    Los valores se pasan como argumentos, deben ser correspondientes al numero de '?'. Se puede usar un arreglo como parámetro precedido de '...'
    E.g. insertIntoDb($sql, $nom, $fam, $precio)   insertIntDb($sql, ...$arrayWithValues)
    Regresa en indice del elemento insertado
*/
function insertIntoDb($dml, ...$args) {
    $conDb = connectDb();
    $types='';
    //Verifica los tipos de variable de los argumentos y termina el proceso si no son int, double, string o BLOB
    foreach ($args as $arg) {
        $types.=substr(gettype($arg),0,1);
        if(preg_match('/[^idsb]/', $types)) {
            die("Invalid argument, only Int, double, string and BLOB accepted");
        }
    }
    if ( !($statement = $conDb->prepare($dml)) ) {
        die("Error: (" . $conDb->errno . ") " . $conDb->error);
        return 0;
    }
    //Unir los parámetros de la función con los parámetros de la consulta
    //El primer argumento de bind_param es el formato de cada parámetro
    if (!$statement->bind_param($types, ...$args)) {
        die("Error en vinculación: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    //Executar la consulta
    if (!$statement->execute()) {
        die("Error en ejecución: (" . $statement->errno . ") " . $statement->error);
        return 0;
    }
    $id = $conDb->insert_id;
    closeDb($conDb);
    return $id;
}

function modifyDb($dml) {
    $conDb = connectDb();

    $conDb->query($dml);
    $res=mysqli_affected_rows($conDb);

    closeDb($conDb);
    return $res;
}

function agregarZombi($nombre, $apellido, $idEstado) {
    $sql = "CALL agregaZombi('$nombre', '$apellido', $idEstado);";
    return sqlqry($sql);
    //print_r(mysqli_error($res));
}

function getOpciones($id, $campo, $tabla) {
    $sql = "SELECT $id, $campo FROM $tabla";
    $result = sqlqry($sql);
    $option = "";

    while($row = mysqli_fetch_array($result)){
        $option = $option."<option value=".$row[0].">".ucfirst($row[1])."</option>";
    }

    return $option;
}

function getOpcionesSelected($id, $campo, $tabla, $selectedId) {
    $sql = "SELECT $id, $campo FROM $tabla";
    $result = sqlqry($sql);
    $option = "";

    while($row = mysqli_fetch_array($result)){
        $select = $row[0]==$selectedId ? " selected ":" ";
        $option = $option."<option". $select ."value=".$row[0].">".ucfirst($row[1])."</option>";
    }

    return $option;
}
function getOpcionesZombie($zId) {
    $sql = "SELECT idEstado, nombreEstado FROM estados e
            WHERE idEstado NOT IN (
                SELECT idEstado FROM zombis_estados
                WHERE idZombi=$zId
            )";
    $result = sqlqry($sql);
    $option = "";

    while($row = mysqli_fetch_array($result)){
        $option = $option."<option value=".$row[0].">".ucfirst($row[1])."</option>";
    }

    return $option;
}
function muestraZombis() {
    $qryZombis = "
        SELECT z.idZombi as id,
               z.nombre as z_nombre,
               GROUP_CONCAT(e.nombreEstado order by ze.fechaCreacion DESC SEPARATOR '|') as e_nombreEstado,
               GROUP_CONCAT(ze.fechaCreacion order by ze.fechaCreacion DESC SEPARATOR '|') as ze_fecha
        FROM zombis z, estados e, zombis_estados ze
        WHERE z.idZombi=ze.idZombi
          AND e.idEstado=ze.idEstado
        GROUP BY z.nombre
        ORDER BY z.nombre";
    $tabla = "
        <thead>
            <tr>
                <th>Zombie</th>
                <th>Estados</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

    $zombis = sqlqry($qryZombis);
    $totalZomb = mysqli_num_rows($zombis);
    while ($row = mysqli_fetch_array($zombis, MYSQLI_BOTH)) {
        $estados = explode('|', $row['e_nombreEstado']);
        $fechas = explode('|', $row['ze_fecha']);
        $tabla .= "<tr>";
        $tabla .= "<td>".$row['z_nombre']."</td>";
        $tabla .= "<td>";
        for($i = 0; $i < count($estados); $i++) {

            $tabla .= "<code>(".$fechas[$i].") - </code>".ucfirst($estados[$i]);
            $tabla .= "<br>";
        }
        $tabla .= "</td>";
        $tabla .= "<td><button zid=\"".$row['id']."\"class=\"btn-estado waves-effect waves-light btn\"><i class=\"material-icons left\">add</i>Registrar estado</button></td>";
        $tabla .= "</tr>";
    }
    $tabla .= "
    </tbody>
    <tfoot>
        <tr>
            <th>Zombis Totales:</th>
            <th>$totalZomb</th>
        </tr>
    </tfoot>";
    return $tabla;
}
function muestraEstadosZombis() {
    $qryZombis = "
        SELECT e.nombreEstado nombre, COUNT(e.idEstado) count
        FROM zombis z, zombis_estados ze, estados e
        WHERE z.idZombi=ze.idZombi
        AND ze.idEstado=e.idEstado
        GROUP BY e.idEstado";

    $zombis = sqlqry($qryZombis);
    $totalZomb = mysqli_fetch_array(sqlqry("SELECT COUNT(z.idZombi)FROM zombis z"))[0];

    $tabla = "
        <thead>
            <tr>
                <th>Estado</th>
                <th>Cantidad</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

    while ($row = mysqli_fetch_array($zombis, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".ucfirst($row['nombre'])."</td>";
        $tabla .= "<td>".$row['count']."</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "
    </tbody>
    <tfoot>
        <tr>
            <th>Zombis Totales:</th>
            <th>$totalZomb</th>
        </tr>
    </tfoot>";
    return $tabla;
}
function muestraRegistros() {
    $qryZombis = "
        SELECT z.nombre nombre, e.nombreEstado estado, ze.fechaCreacion fecha
        FROM zombis z, zombis_estados ze, estados e
        WHERE z.idZombi=ze.idZombi
        AND ze.idEstado=e.idEstado
        ORDER BY ze.fechaCreacion DESC;";

    $zombis = sqlqry($qryZombis);
    $tabla = "
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

    while ($row = mysqli_fetch_array($zombis, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".ucfirst($row['nombre'])."</td>";
        $tabla .= "<td>".ucfirst($row['estado'])."</td>";
        $tabla .= "<td>".$row['fecha']."</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "</tbody>";
    return $tabla;
}
function muestraPorEdo($idEdo) {
    $qryZombis = "
        SELECT z.nombre nombre, ze.fechaCreacion fc
        FROM zombis z, zombis_estados ze
        WHERE z.idZombi=ze.idZombi
        AND ze.idEstado=$idEdo;";

    $zombis = sqlqry($qryZombis);
    $totalZomb = mysqli_fetch_array(sqlqry("
        SELECT COUNT(z.nombre) as count
        FROM zombis z, zombis_estados ze
        WHERE z.idZombi=ze.idZombi
        AND ze.idEstado=$idEdo
    "))[0];

    $tabla = "
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

    while ($row = mysqli_fetch_array($zombis, MYSQLI_BOTH)) {
        $tabla .= "<tr>";
        $tabla .= "<td>".ucfirst($row['nombre'])."</td>";
        $tabla .= "<td>".$row['fc']."</td>";
        $tabla .= "</tr>";
    }
    $tabla .= "
    </tbody>
    <tfoot>
        <tr>
            <th>Zombis Totales:</th>
            <th>$totalZomb</th>
        </tr>
    </tfoot>";
    return $tabla;
}
?>
