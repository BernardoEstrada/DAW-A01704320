$(document).ready(function() {
    $('#modal-estado').modal();
});


function mostrarZ(selectedView){
    let domExists =  document.getElementById("estado");
    let selec = selectedView==4&&domExists? document.getElementById("estado").value : 1;
    $.post("vista_zombies.php", {
        view: selectedView,
        sel: selec
    }).done(function(data) {
        $('#mostarZ').html(data);
        if(selectedView==4){
            let elems = document.querySelectorAll('select');
            let instances = M.FormSelect.init(elems);
            document.getElementById("estado").addEventListener("change", function (val) {
                mostrarZ(document.getElementById("vista").value)
            });
        }
        setElEstado();
    });
}

function setElEstado() {
    let botonesEstado = document.getElementsByClassName("btn-estado");
    for(btn of botonesEstado) {
        btn.addEventListener("click", function(b) {
            muestraModal(b.srcElement.getAttribute("zid"));
        });
    }
}

function muestraModal(id) {
    $.post("vista_registrar_estado.php", {
        idZombi: id
    }).done(function(data) {
        let modalEstado = M.Modal.getInstance($('#modal-estado'));
        $('#modal-estado').html(data);
        modalEstado.open();
        let elems = document.querySelectorAll('select');
        let instances = M.FormSelect.init(elems);
        $('#btn-registrar-estado')[0].onclick = submitEstado;

    });

}

function submitEstado() {
    $.post("controlador_registrar_estado.php", {
        idZombi: $('#idZombi').attr('idZombi'),
        estado: $('#estado')[0].value
    }).done(function(data) {
        let modalEstado = M.Modal.getInstance($('#modal-estado'));
        modalEstado.close();
        mostrarZ();
    });
}
