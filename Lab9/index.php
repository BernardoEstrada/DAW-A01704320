<?php
    include("_header.html");

    function promedio(array $arr){
        $sum = 0;
        foreach ($arr as $value)
            $sum += $value;
        return $sum/count($arr);
    }

    function mediana(array $arr){
        sort($arr);
        sort($arr, true);
        $num = count($arr);
        $mid = $num/2;

        if($num%2==0){
            return promedio([$arr[$mid-1],$arr[$mid]]);
        }
        else{
            return $arr[floor($mid)];
        }

    }

    function echoNums(array $arr){


        echo "<ul>";
        echo implode(', ', $arr) . "<br>";
        echo "<li>";
        echo "Promedio: ".promedio($arr);
        echo "</li><li>";
        echo "Media: ".mediana($arr);
        echo "</li><li>";
        sort($arr);
        echo implode(', ', $arr) . "<br>";
        echo "</li><li>";
        rsort($arr);
        echo implode(', ', $arr) . "<br>";
        echo "</li></ul>";
    }

    function cuadrados($n){
        echo "
        <table>
          <thead>
            <tr>
              <th>n</th>
              <th>n^2</th>
            </tr>
          </thead>
          
          <tbody>
          ";
        for($i=1; $i<=$n; $i++){
            $i2 = $i**2;
            echo "
            <tr>
                <td>{$i}</td>
                <td>{$i2}</td>
            </tr>";
        }
        echo "</tbody></table>";
    }


    function bis($f, $a, $b){
        $err = 1;
        $epsilon = 0.001;
        $c = 0;

        if ($f($a) * $f($b) >= 0){
            return "error";
        }

        while ($err > $epsilon) {
            $c=($a+$b)/2;
            if($f($a)*$f($c)<0){
                $b=$c;
            }
            else{
                $a=$c;
            }
            $err = ($b - $a) / $b;
        }
        return $c;
    }


?>

<section>
    <h1>Funciones</h1>
    <article>
        <h3>Arreglo con media, mediana y orden</h3>
        <?php echoNums([4,12,3,9,4,5,10,4])?>
    </article>
    <article>
        <h3>Lista de cuadrados de 0 a n</h3>
        <?php cuadrados(5)?>
    </article>
    <article>
        <h3>Método de bisección</h3>
        <?php $f1 = function ($x){return 4*$x**2 -148*$x - 1369;}; ?>
        Solución por método de bisección a la ecuación <strong>4x^2-148x-1369</strong>
        <br>
        <?= "x= ".bis($f1, 0, 50);?>
    </article>
</section>
<section>
    <h1>Preguntas</h1>
    <article>
        <strong>¿Qué hace la función phpinfo()? Describe y discute 3 datos que llamen tu atención.</strong>
        <br>
        Muestra las características del sistema en el que está corriendo el interpretador de PHP, así como las variables locales y los módulos activados. Me llama la atención que puedas desactivar cada modulo como CURL, Hashing, FTP e incluso el calendario
        <br><br>
        <strong>¿Qué cambios tendrías que hacer en la configuración del servidor para que pudiera ser apto en un ambiente de producción?</strong>
        <br>
        Agregar métodos de seguridad para evitar ataques
        <br><br>
        <strong>¿Cómo es que si el código está en un archivo con código html que se despliega del lado del cliente, se ejecuta del lado del servidor? Explica.</strong>
        <br>
        Al recibir un request de parte del cliente, el servidor pre-procesa el código y genera y manda de regreso algo legible por el navegador
    </article>
</section>

<?php
    include("_footer.html");
    phpinfo()
?>
