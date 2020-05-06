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
    $sql = "SELECT nombreLugar lugar, nombreTipoIn tipoIncidente, fecha FROM incidente i, lugares l,tipos_incidentes t
            WHERE i.idLugar=l.idLugar
            AND i.idTipoIn=t.idTipoIn
            ORDER BY fecha DESC";

    $resp = sqlqry($sql);
    $totalIn = mysqli_num_rows($resp);
    if(!$resp){
        http_response_code(500);
        return -1;
    }
    $tabla = "
        <thead>
            <tr>
                <th>Lugar</th>
                <th>Tipo de Incidente</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>";

    while ($row = mysqli_fetch_array($resp, MYSQLI_BOTH)){
        $tabla .= "<tr>";
        $tabla .= "<td>".ucfirst($row['lugar'])."</td>";
        $tabla .= "<td>".ucfirst($row['tipoIncidente'])."</td>";
        $tabla .= "<td>".$row['fecha']."</td>";
        $tabla .= "</tr>";
    }    $tabla .= "
    </tbody>
    <tfoot>
        <tr>
            <th>Incidentes Totales:</th>
            <th>$totalIn</th>
        </tr>
    </tfoot>";
    return $tabla;
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