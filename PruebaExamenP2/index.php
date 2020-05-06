<?php
include '_header.html';
require_once 'util.php';
?>
    <header>
    </header>

<main>
    <div class="container">
        <div id="modal-estado" class="modal" style="overflow: visible"></div>
    </div>

        <?php include '_navbar.html'; ?>

        <div class="container">

            <a class="right btn-floating btn-large waves-effect waves-light red" href="vista_agregar_zombi.php"><i class="material-icons">add</i></a>
            <h3>Zombis</h3>

            <select id="vista" name="vista">
                <option selected value=1>Mostrar todos los Zombies</option>
                <option value=2>Mostrar estados</option>
                <option value=3>Mostrar todos los registros de actualizacion</option>
                <option value=4>Mostrar zombies por estado</option>
            </select>

            <div id="mostarZ"></div>

        </div>

    </main>
<br><br>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
    });
    document.getElementById("vista").addEventListener("change", function (val) {
        mostrarZ(document.getElementById("vista").value)
    });
</script>
<?php include '_footer.html'; ?>
<script>mostrarZ();</script>
