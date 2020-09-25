function Person(data){
    this.name = data.enterName.value;
    this.email = data.enterEmail.value;
    this.phone = data.enterPhone.value;
}
let people = [];
document.getElementById("signup").addEventListener("submit", function(event){
    event.preventDefault();
   people.push(new Person(event.target.elements));
   table();
});

document.getElementById("enterName").addEventListener("input", function(){
    let span = document.getElementById("nameValid");
    try{checkName(this.value); span.innerText = "✔️"; span.className = "";}
    catch(e){span.innerText = "❌" + e; span.className = "Error"}
});
document.getElementById("enterPhone").addEventListener("input", function(){
    let span = document.getElementById("phoneValid");
    try{checkPhone(this.value); span.innerText = "✔️"; span.className = "";}
    catch(e){span.innerText = "❌" + e; span.className = "Error"}
});

function checkName(nam){
    let reject = /[^\w- ]/;
    if(reject.test(nam)){
        throw "Invalid Character";
    }
}

function checkPhone(ph){
    let reject = /[^0-9]/;
    if(reject.test(ph)) {
        throw "Invalid Character";
    } else if(ph.length!==10){
        throw "Enter exactly 10 digits";
    }
}

function table(){
    let htmlToAdd = "";
    htmlToAdd = "<th>Name<th>Email</th><th>Phone</th>";
    people.forEach(item => {
        htmlToAdd = htmlToAdd.concat(`
            <tr>
                <td>${item.name}</td>
                <td>${item.email}</td>
                <td>${item.phone}</td>
            </tr>
        `);
    });
    document.getElementById("people").innerHTML = htmlToAdd;
}

//✔️
//❌