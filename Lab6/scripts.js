
document.getElementById("close").style.bottom = "auto";
document.getElementById("close").style.top = "-0.5em";
document.getElementById("close").style.left = "auto";
document.getElementById("close").style.right = "-0.5em";

//Eventlistener que detecta cuando el cursor entra a el elemento close
document.getElementById("close").addEventListener("mouseenter", function () {
    let moved = false;
    let wm = this.style;
    let offset = "-0.5em";

    //50% de las veces el elemento se va a mover de arriba para abajo o viceversa
    if(Math.random() >= 0.5){
        if(wm.bottom === offset){
            wm.bottom = "auto";
            wm.top = offset;
        } else if(wm.top === offset){
            wm.bottom = offset;
            wm.top = "auto";
        }
        moved = true;
    }

    //50% de las veces el elemento se va a mover de izquierda a derecha o viceversa
    //si el elemento no se ha movido, se moverá (para evitar que el 25% del tiempo se quede en el mismo lugar)
    else if(Math.random() >= 0.5 || !moved){
        if(wm.left === offset){
            wm.left = "auto";
            wm.right = offset;
        } else if(wm.right === offset){
            wm.left = offset;
            wm.right = "auto";
        }
    }
});


//espera a que la tecla C sea presionada y agrega o quita la clase highlighted de todos los elementos <code> en el DOM
document.addEventListener("keydown", function (event) {
    if(event.key === "c"){
        let codeBits = document.getElementsByTagName("code");
        for(let i=0; i<codeBits.length;i++){
            codeBits[i].classList.toggle("highlighted");
        }
    }

});


//Hace visible el label de el input cuando está seleccionado
document.getElementById("pass").addEventListener("focus", function () {
    this.labels[0].hidden = false;
});
//Hace invisible el label de el input cuando no está seleccionado
document.getElementById("pass").addEventListener("focusout", function () {
    this.labels[0].hidden = true;
});

//al presionar continuar, revisa si están checadas las casillas de T&C
document.getElementById("cont").addEventListener("click", function () {
    if(document.getElementById("term").checked && document.getElementById("condiciones").checked){
        alert("Éxito");
    }else{
        document.getElementById("term").labels[0].hidden = false
    }
});

//Cuando las 2 casillas de T&C están palomeadas, se esconde el mensaje
document.getElementById("term").addEventListener("click", function () {
    this.labels[0].hidden = this.checked && document.getElementById("condiciones").checked;
});
document.getElementById("condiciones").addEventListener("click", function () {
    document.getElementById("term").labels[0].hidden = this.checked && document.getElementById("term").checked;
});




let presses=42;
document.getElementById("botonAlerta").addEventListener("click", function () {
    presses--;
    this.labels[0].innerText = "No presiones este botón " + presses + " veces más";
    if(presses===0){
        presses = 42;
        alert("Felicidades, presionaste el botón 42 veces, feliz?");
        this.labels[0].innerText = "No presiones este botón " + presses + " veces más";
    }
});

let cronoSeg = 0.0, timerSeg = 0;
let crono, temp,
cronoDisp = document.getElementById("crono");

function startCrono(){
    if(!crono){
        crono = setInterval(() =>{
            cronoSeg+=0.01;
            dispCrono()
        }, 10);
    }
}
function stopCrono(){
    clearInterval(crono);
    crono = null;
    dispCrono()
}
function clearCrono(){
    cronoSeg = 0.0;
    dispCrono()
}
function dispCrono() {
    cronoDisp.innerText = cronoSeg.toFixed(2) + "s";
}


function startTemp(){
    timerSeg = parseFloat(document.getElementById("tempSeg").value);
    temp = setTimeout(()=>{
        alert("Time is done")
    }, timerSeg*1000);
}
// Iniciar Cronómetro cronoStart
// Parar Cronómetro cronoStop
// Reiniciar Cronómetro cronoRe
// crono
//
// tempSeg
// Iniciar Temporizador tempS
// temp
