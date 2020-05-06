<?php
include '_header.html';
require_once 'util.php';
?>
    <header>
    </header>

<main>

    <?php include '_navbar.html'; ?>
    <div class="container">
        <div id="modal-incidente" class="modal" style="overflow: visible"></div>
    </div>

        <div class="container">

            <a class="right btn-floating btn-large waves-effect waves-light red" id="btn-agrega-incidente"><i class="material-icons">add</i></a>
            <h3>Jurassic Park</h3>

            <div id="mostarIncidentes"></div>

        </div>

    </main>
<br><br>

<?php include '_footer.html'; ?>
<script>
    $(document).ready(function() {
        $('#modal-incidente').modal();
    });
    document.getElementById("btn-agrega-incidente").addEventListener("click", mostrarEdicion)
</script>
<script>mostrarIncidentes();</script>
