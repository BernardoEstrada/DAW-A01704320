

function getRadio(family) {
    let options = document.getElementsByName(family);
    for(const option of options){
        if(option.checked){
            return option.value
        }
    }
    return false
}


//Función para crear el objeto para realizar una petición asíncrona
function getRequestObject() {
    // Asynchronous objec created, handles browser DOM differences
    if (window.XMLHttpRequest) {
        // Mozilla, Opera, Safari, Chrome IE 7+
        return (new XMLHttpRequest());
    } else if (window.ActiveXObject) {
        // IE 6-
        return (new ActiveXObject("Microsoft.XMLHTTP"));
    } else {
        // Non AJAX browsers
        return (null);
    }
}

//Función que detonará la petición asíncrona como se hacía en unos inicios
function buscar() {
    request = getRequestObject();
    if (request != null) {
        let minAge = document.getElementById("minAge").value;
        let maxAge = document.getElementById("maxAge").value;
        let sort = document.getElementById("sort").value;
        let order = getRadio("order");
        let macho = document.getElementById("macho").value;
        let hembra = document.getElementById("hembra").value;
        let url = 'catalogo_controller.php?minAge=' + minAge + '&maxAge=' + maxAge + '&sort=' + sort + '&order=' + order + '&macho=' + macho + '&hembra=' + hembra;

        request.open('GET', url, true);
        request.onreadystatechange =
            function () {
                if ((request.readyState == 4)) {
                    // Se recibió la respuesta asíncrona, entonces hay que actualizar el cliente.
                    // A esta parte comúnmente se le conoce como la función del callback
                    document.getElementById("catal_res").innerHTML = request.responseText;
                }
            };
        // Limpiar la petición
        request.send(null);

    }
}

document.getElementById("buscar").onclick = buscar;