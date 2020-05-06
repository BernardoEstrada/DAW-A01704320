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

            <a class="right btn-floating btn-large waves-effect waves-light red" href="vista_agregar_incidente.php"><i class="material-icons">add</i></a>
            <h3>Zombis</h3>

            <div id="mostarIncidentes"></div>

        </div>

    </main>
<br><br>

<?php include '_footer.html'; ?>
<script>mostrarIncidentes();</script>
