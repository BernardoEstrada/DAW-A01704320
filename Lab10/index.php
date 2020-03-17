<?php
include("form.php");
?>



<html>
<?php include("_header.html"); ?>
<body>
<section>
    <article>
        <form action="" method="post">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            Phone: <input type="number" name="phone"><br>
            Birthday: <input type="date" name="birthday"><br>
            <input type="submit" name="submit">
        </form>
    </article>
    <article>
        <?= "
            <div id='result' ".($hid?'hidden':'').">
           
                <p>Name: ".$name."</p>
                
                <p>Email: ".$email."</p>
                
                <p>Phone: ".$phone."</p>
                
                <p>Bday: ".$bday->format('d/m/Y')."</p>
                
                <p>Age: ".date_diff($bday, (new DateTime()))->format('%Y')."</p>
                
            </div>
            <h3 class='error'>".$err."</h3>"

        ?>
    </article>
</section>
<hr>
<?php include("_preguntas.html"); ?>

</body>
</html>
