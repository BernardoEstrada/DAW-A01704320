<?php
require_once 'util.php';
$_POST['idZombi'] = htmlspecialchars($_POST['idZombi']);
$sql = "SELECT nombre FROM zombis WHERE idZombi=".$_POST['idZombi'];
$nombre = mysqli_fetch_assoc(sqlqry($sql))['nombre'];
?>
<div id="idZombi" idZombi=<?= $_POST['idZombi'] ?>>

</div>
<div class="modal-content" >
    <h4>Registrar Estado de <?= $nombre?></h4>
    <form class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <select id="estado" name="estado">
                    <option selected disabled value = "">Seleccione una opcion:
                    </option>
                    <?= getOpcionesZombie($_POST["idZombi"]) ?>
                </select>
                <label for="estado">Estado:</label>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button class="btn waves-effect waves-light" id="btn-registrar-estado" name="action">Registrar
        <i class="material-icons right">send</i>
    </button>
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
</div>
