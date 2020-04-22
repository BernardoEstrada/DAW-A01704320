//
//---------------EXERCISE 1-------------------------
//
//This function generates and returns a 3 by n array that stores numbers from 1 to n as well as n^2 and n^3
function tablaPot(num){
    let tab=[];
    for(let i=1; i<=num; i++){
        tab.push([i, i**2, i**3]);
    }
    return tab;
}
//generates an html table based on an array
function tablaHTML(mat){
    let tabl="";
    tabl = tabl.concat("<table>");
    mat.forEach(row => {
        tabl = tabl.concat("<tr>");
        row.forEach(column => {
            //saves the html code part by part in an string
            tabl = tabl.concat("<td>" + column + "</td>");
        });
        tabl = tabl.concat("</tr>");
    });
    tabl = tabl.concat("</table>");

    //Adds the stringified html inside ej1 element in the document
    document.getElementById("ej1").innerHTML = tabl;
}
//This function requests a number via a prompt and keeps asking until a valid number is entered
function requestNumber(){
    let no = prompt("Ingresa Un numero", '0');
    while(isNaN(no)){
        no = prompt("Por favor ingresa un valor numerico", 0);
    }
    tablaHTML(tablaPot(no));
}

//
//---------------EXERCISE 2-------------------------
//
//Generates 2 random numbers and asks the user for the sum, it also times how long the user takes
function randomSum(){
    const maxVal = 100;
    let nums = [Math.floor(Math.random() * maxVal), Math.floor(Math.random() * maxVal)]; //store both random nums in an array
    let startTime = new Date(); //time the user is asked for the answer, a timeout cant be used as prompt would stop it
    let res = prompt("Cual es la suma de " + nums[0] + " + " + nums[1] + "?", 0);
    while(isNaN(res)){ //if the answer is not a number, the user is promped to try again
        res = prompt("Por favor ingresa un valor numerico\nCual es la suma de " + nums[0] + " + " + nums[1] + "?", 0);
    }//sends an alert telling the user weather the answer was correct or incorrect and the time it took by subtracting startTime from current time
    alert("Tu respuesta fue " + (res==nums[0]+nums[1]?"correcta":"incorrecta") + " y tardaste " + (new Date() - startTime)/1000 + " segundos");
}

//
//---------------EXERCISE 3-------------------------
//
//This function receives an array of numbers and returns an array with 3 values, amount of numbers <0 , =1  and >0
function contador(nums){
    let ret = [0, 0, 0];
    //Checks the parameter recieved is in the correct format (an array of numbers) ([number, number, number, number])
    if(nums instanceof Array){
        nums.forEach((num)=> {
            if(isNaN(num)){
                throw "A value is not a number"
            }
        });
    } else{
        throw "Expected array, recieved " + typeof(nums);
    }
    //Just goes through the array comparing and counting each value
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

//
//---------------EXERCISE 4-------------------------
//
//Receives an array of arrays of numbers and returns an array with the average of each sub-array
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

//
//---------------EXERCISE 5-------------------------
//
//Receives a number and returns that number backwards
function inverso(no){
    //check if received value can be parsed into number
    if(isNaN(no)){throw "Value is not a number"}

    //The way I was able to do this was by changing the number to a string and then split it into an array so it was easier to flip it
    let res = no.toString().split("");
    let end = res.length-1;
    for(let i=0; i<(end/2); i++){
        let tmp = res[i];
        res[i] = res[end-i];
        res[end-i] = tmp;
    }
    //This joins the array into a string and then parses that string into a float (so decimal point can be used)
    return (parseFloat(res.join("")));
}

//A function to handle throws, receives a function name and the value to be passed
function handler(f, val) {
    try{
        console.log(f(val));
        return f(val);
    } catch(e){
        console.error(e);
        return e;
    }
}
//a null function
function nn(n){return n};

//compares 2 arrays and returns weather they are equal or not, if a number is passed the function still works
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
//uses arrAreEqual to compare 2 matrices
function matAreEqual(a, b) {
    try{
        for(let i=0; i<a.length;i++) {
            if (!arrAreEqual(a[i], b[i])) return false;
        }
    } catch {
        return false
    }
    return true
}7

//Testing parameters, they are saved in the next format
function PruebaIO(inp, expOut){
    this.inp = inp;
    this.expOutput = expOut;
}
class Prueba {
    constructor(func, tests) {
        this.func = func;
        this.tests = [];
        if (tests instanceof Array) {
            tests.forEach(test => {
                if (test instanceof Array) {
                    this.tests.push(new PruebaIO(test[0], test[1]));
                } else if (test instanceof PruebaIO) {
                    this.tests.push(test);
                }
            });
        } else if (tests instanceof PruebaIO) {
            this.tests.push(tests);
        }
    }
    addTest = (inp, expOut) => this.tests.push(new PruebaIO(inp, expOut));
    getTest = testN => this.tests[testN-1];

    //in  -> tests[n].input
    //out -> tests[n].expOutput
    probar = n => {
        let test = this.tests[n-1];
        let res = this.func(test.inp);

        if(test.expOutput instanceof Array){
            if(test.expOutput[0] instanceof Array){
                return matAreEqual(res,test.expOutput);
            } else {
                return arrAreEqual(res,test.expOutput);
            }
        } else{
            return res === test.expOutput;
        }
    };
    res = n => {
        let test = this.tests[n-1];
        return this.func(test.inp);
    };
}

let pruebas = [];

let valoresPruebas = [
    new PruebaIO(5, [[1, 1, 1], [2, 4, 8], [3, 9, 27], [4, 16, 64], [5, 25, 125]]),
    new PruebaIO(10, [[1, 1, 1], [2, 4, 8], [3, 9, 27], [4, 16, 64], [5, 25, 125], [6, 36, 216], [7, 49, 343], [8, 64, 512], [9, 81, 729], [10, 100, 1000]]),
];
pruebas.push(new Prueba(tablaPot, valoresPruebas));

valoresPruebas = [
    new PruebaIO(1,1),
    new PruebaIO(1,1),
];
pruebas.push(new Prueba(nn, valoresPruebas));

valoresPruebas = [
    new PruebaIO([4, 3, 7, 8, 0, -1, 3, -6, -1, 0],[3, 2, 5]),
    new PruebaIO([-2, -1, 0, 1, 2],[2, 1, 2]),
];
pruebas.push(new Prueba(contador, valoresPruebas));

valoresPruebas = [
    new PruebaIO([[3, 6, 11], [23, 9, 17, 12]],[6.666666666666667, 15.25]),
    new PruebaIO([[3, 2, 1], [6, 17], [16], [21, 9]],[2, 11.5, 16, 15]),
];
pruebas.push(new Prueba(promedios, valoresPruebas));

valoresPruebas = [
    new PruebaIO(123456789,987654321),
    new PruebaIO(45.123,321.54),
];
pruebas.push(new Prueba(inverso, valoresPruebas));

//Testing function, receives what exercise is to be tested and what test number us wanted
function tester(exercise, testNo){
    let curr = pruebas[exercise-1];
    let emoji = '❌';
    emoji=curr.probar(testNo)?'✔️':'❌';


    //Adds the testing parameters, the result and an emoji showing whether the function worked as expected or not to the body of the html inside a div with id ej(Exercise Number)
    document.getElementById("ej"+exercise).innerHTML += "[" + curr.getTest(testNo).inp + "] => [" + curr.res(testNo) + "] " + emoji + "<br>";
    console.log("Exercise " + exercise + ", test " + testNo + ". Result: " + emoji);
}

//Runs all tests number a, if no parameter is received, it just runs ALL tests
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
//Clears all the tests (console and div elements with id ej(Exercise Number))
function clearTests(a){
    for(let i=1; i<=a;i++){
        document.getElementById("ej"+i).innerHTML = "";
        console.clear();
    }
}