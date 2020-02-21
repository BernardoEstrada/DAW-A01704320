
function tablaPot(num){
    tab=[];
    for(let i=1; i<=num; i++){
        tab.push([i, i**2, i**3]);
    }
    return tab;
}
function tablaHTML(mat){
    let tabl="";
    tabl = tabl.concat("<table>");
    mat.forEach(row => {
        tabl = tabl.concat("<tr>");
        row.forEach(column => {
            tabl = tabl.concat("<td>" + column + "</td>");
        });
        tabl = tabl.concat("</tr>");
    });
    tabl = tabl.concat("</table>");

    document.getElementById("ej1").innerHTML = tabl;
}
function requestNumber(){
    let no = prompt("Ingresa Un numero", 0);
    while(isNaN(no)){
        no = prompt("Por favor ingresa un valor numerico", 0);
    }
    tablaHTML(tablaPot(no));
}

function randomSum(){
    const maxVal = 100;
    let nums = [Math.floor(Math.random() * maxVal), Math.floor(Math.random() * maxVal)];
    let startTime = new Date();
    let res = prompt("Cual es la suma de " + nums[0] + " + " + nums[1] + "?", 0);
    while(isNaN(res)){
        res = prompt("Por favor ingresa un valor numerico\nCual es la suma de " + nums[0] + " + " + nums[1] + "?", 0);
    }
    alert("Tu respuesta fue " + (res==nums[0]+nums[1]?"correcta":"incorrecta") + " y tardaste " + (new Date() - startTime)/1000 + " segundos");
}

function contador(nums){
    let ret = [0, 0, 0];

    //Checks the parameter recieved is in the correct format ([number, number, number, number])
    if(nums instanceof Array){
        nums.forEach((num)=> {
            if(isNaN(num)){
                throw "A value is not a number"
            }
        });
    } else{
        throw "Expected array, recieved " + typeof(nums);
    }


    nums.forEach(item => {
        if (item < 0) {
            ret[0]++
        } else if (item == 0) {
            ret[1]++
        } else {
            ret[2]++
        }
    });
        return ret;

}

function promedios(nums){
    let ret = [];

    //Checks the parameter received is in the correct format ([[number, number], [number, number]])
    if(nums instanceof Array){
        nums.forEach((row)=> {
            if(row instanceof Array){
                row.forEach((num)=>{
                    if(isNaN(num)){
                        throw "A value is not a number"
                    }
                });
            }else{
                throw "Array not valid";
            }
        });
    } else{
        throw "Expected 2 dimensional array, got " + typeof(nums);
    }

    nums.forEach(row => {
        let sum = 0;
        row.forEach((value) => sum+=value);
        ret.push(sum/row.length);
    });
    return ret;
}

function inverso(no){
    //check if received value can be parsed into number
    if(isNaN(no)){throw "Value is not a number"}

    let res = no.toString().split("");
    let end = res.length-1;
    for(let i=0; i<(end/2); i++){
        let tmp = res[i];
        res[i] = res[end-i];
        res[end-i] = tmp;
    }
    return (parseFloat(res.join("")));
}

function handler(f, val) {
    try{
        console.log(f(val));
        return f(val);
    } catch(e){
        console.error(e);
        return e;
    }
}

function nn(n){return n};

function arrAreEqual(a, b){
    if (a === b) return true;
    if (a == null || b == null) return false;

    if(isNaN(a) && isNaN(b)){
        if (a.length != b.length) return false;

        for(let i=0; i<a.length;i++) {
            if (a[i] !== b[i]) return false;
        }
    } else { return false }

    return true;
}
function matAreEqual(a, b) {
    try{
        for(let i=0; i<a.length;i++) {
            if (!arrAreEqual(a[i], b[i])) return false;
        }
    } catch {
        return false
    }
    return true
}

//[function, [test1Params, test1ExpRes], [test2Params, test2ExpRes]]
let pruebas = [
    [tablaPot,
        [
            5,
            [[1, 1, 1], [2, 4, 8], [3, 9, 27], [4, 16, 64], [5, 25, 125]]
        ], [
            10,
            [[1, 1, 1], [2, 4, 8], [3, 9, 27], [4, 16, 64], [5, 25, 125], [6, 36, 216], [7, 49, 343], [8, 64, 512], [9, 81, 729], [10, 100, 1000]]
        ]
    ],
    [nn,[1,1],[1,1]],
    [contador,
        [
            [4, 3, 7, 8, 0, -1, 3, -6, -1, 0],
            [3, 2, 5]
        ], [
            [-2, -1, 0, 1, 2],
            [2, 1, 2]
        ]
    ],
    [promedios,
        [
            [[3, 6, 11], [23, 9, 17, 12]],
            [6.666666666666667, 15.25]
        ], [
            [[3, 2, 1], [6, 17], [16], [21, 9]],
            [2, 11.5, 16, 15]
        ]
    ],
    [inverso,
        [
            123456789,
            987654321
        ], [
            45.123,
            321.54
        ]
    ]
];

function tester(exercise, testNo){
    let curr = pruebas[exercise-1];
    let res = curr[0](curr[testNo][0]);
    let emoji = '❌';

    if(res instanceof Array){
        if(res[0]instanceof Array){
            emoji = matAreEqual(res,curr[testNo][1])?'✔️':'❌';
        } else {
            emoji = arrAreEqual(res,curr[testNo][1])?'✔️':'❌';
        }
    } else{
        emoji = res === curr[testNo][1]?'✔️':'❌';
    }
    document.getElementById("ej"+exercise).innerHTML += "[" + curr[testNo][0] + "] => [" + res + "] " + emoji + "<br>";
    console.log("Exercise " + exercise + ", test " + testNo + ". Result: " + emoji);
}

function runAllTests(a) {
    for(let i=1; i<=5;i++){
        if(isNaN(a)){
            tester(i, 1)
            tester(i, 2);
        } else{
            tester(i, a);
        }
    }
}
function clearTests(a){
    for(let i=1; i<=a;i++){
        document.getElementById("ej"+i).innerHTML = "";
        console.clear();
    }
}

// Escribe, prueba y debuguea (si es necesario) scripts de JavaScript para los siguientes problemas. Cuando se requiera escribir funciones, es necesario incluir un script para probar la función con al menos 2 conjuntos de datos de prueba. Haz las pruebas en un documento HTML.

// 6:
// Crea una solución para un problema de tu elección (puede ser algo relacionado con tus intereses, alguna problemática que hayas identificado en algún ámbito, un problema de programación que hayas resuelto en otro lenguaje, un problema de la ACM, entre otros). El problema debe estar descrito en un documento HTML, y la solución implementada en JavaScript, utilizando al menos la creación de un objeto, el objeto además de su constructor deben tener al menos 2 métodos. Muestra los resultados en el documento HTML.


