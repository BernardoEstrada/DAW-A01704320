<?php
include '_header.html';
include '_navbar.html';
require_once 'util.php';
?>
<div class="container">

    <h1>Agregar nuevo zombie</h1>
    <div class="row">
        <form class="col s12" action="controlador_agregar_zombi.php" method="post">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="nombre" id="nombre" placeholder="Juan" value="">
                    <label for="nombre">Nombre:</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="apellido" id="apellido" placeholder="Pérez" value="">
                    <label for="apellido">Apellido:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select id="estado" name="estado">
                        <option selected disabled value = "">Seleccione una opcion:
                        </option>
                        <?= getOpciones('idEstado', 'nombreEstado', 'estados') ?>
                    </select>
                    <label for="estado">Estado:</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Registrar
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        let elems = document.querySelectorAll('select');
        let instances = M.FormSelect.init(elems);
    });
</script>
<?php include '_footer.html'; ?>
