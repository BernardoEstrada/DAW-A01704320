<?php include_once "util.php"?>

<div class="modal-content" >
    <h1>Agregar Nuevo Incidente</h1>
    <div class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <select id="lugar" name="lugar">
                    <option selected disabled value = "">Seleccione un lugar:
                    </option>
                    <?= getOpciones('idLugar', 'nombreLugar', 'lugares') ?>
                </select>
                <label for="lugar">Lugar:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select id="tipoIn" name="tipoIn">
                    <option selected disabled value = "">Seleccione un tipo de incidente:
                    </option>
                    <?= getOpciones('idTipoIn', 'nombreTipoIn', 'tipos_incidentes') ?>
                </select>
                <label for="tipoIn">Tipo de Incidente:</label>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="btn waves-effect waves-light" id="btn-registrar-incidente" name="action">Registrar
        <i class="material-icons right">send</i>
    </button>
    <a href="#" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
</div>