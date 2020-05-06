function mostrarIncidentes(){
    $.post("vista_incidentes.php").done(function(data) {
        $('#mostarIncidentes').html(data);
    });
}
function mostrarEdicion(){
    $.post("vista_agregar_incidente.php").done(function(data) {
        let modalIncidente = M.Modal.getInstance($('#modal-incidente'));
        $('#modal-incidente').html(data);
        modalIncidente.open();
        let elems = document.querySelectorAll('select');
        let instances = M.FormSelect.init(elems);
        $('#btn-registrar-incidente')[0].onclick = submitIncidente;
    });
}

function submitIncidente(){
    $.post("controlador_agregar_incidente.php", {
        lugar: $('#lugar')[0].value,
        tipoIn:$('#tipoIn')[0].value
    }).done(function(data,status) {
        console.log(data);
        if(status==="success"){
            let modalIncidente = M.Modal.getInstance($('#modal-incidente'));
            modalIncidente.close();
            mostrarIncidentes();
            icon = '<i class="material-icons">check</i>';
        } else {
            icon = '<i class="material-icons">clear</i>';
        }
        M.toast({html: '<span>'+data+' </span>'+icon});
    });
}