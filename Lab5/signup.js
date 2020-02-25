document.getElementById("signup").addEventListener("submit", function(event){
    console.log(this);
    event.preventDefault();
});

document.getElementById("enterName").addEventListener("input", function(){
    let span = document.getElementById("nameValid");
    try{checkName(this.value); span.innerText = "✔"; span.className = "";}
    catch(e){span.innerText = "❌" + e; span.className = "Error"}
});

function checkName(nam){
    let reject = /[\W-]/;
    if(reject.test(nam)){
        throw "Invalid Character";
    }
}

//✔
//❌