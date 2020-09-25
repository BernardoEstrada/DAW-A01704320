<?php
require_once "util.php";

$result = getDogsByAge(0,21);

if(mysqli_num_rows($result) > 0){
    echo "<table>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>" . $row["idPerro"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["edad"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
