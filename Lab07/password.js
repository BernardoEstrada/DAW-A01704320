let passInput = document.getElementById("enterPass"),
    passConfirm = document.getElementById("confirmPass"),
    showPass = document.getElementById("showPass"),
    continueBut = document.getElementById("continue"),
    pass = "";

//Every time the input for password is modified, check if its a valid password
passInput.addEventListener("input", function(){
    pass = this.value;
    checkErrors(this);
});

//Every time the password confirmation is modified, check if it matches original password
passConfirm.addEventListener("input", function(){checkErrors(this)});

//Allow to show password for 2 seconds and then hide it again
showPass.addEventListener("change", function(){
    let hide;
    if(this.checked){
        passInput.type = "text";
        hide = setTimeout(hidePass, 2000);
    } else {
        passInput.type = "password";
        clearTimeout(hide);
    }
});

//Alerts the user if password is valid or invalid and why
continueBut.addEventListener("click", ()=>{
    let res = checkErrors(passInput);
    if(res===true){
        alert("Password is valid and matches confirmation");
        passInput.value = "";
        passConfirm.value = "";
        document.getElementById("passValid").innerText = "";
        document.getElementById("confirmValid").innerText = "";
    } else{
        alert("Password is invalid: " + res);
    }
});

//Sets password input type back to password
function hidePass(){
    passInput.type = "password";
    showPass.checked = false;
}

//checks if passed string contains Capital letters, numbers, special characters and any illegal character, throws an error if password does not meet criteria
// Uses RegEx to find this characters
/**
 * @return {boolean}
 */
function ValidPass(p) {
    let caps = /[A-Z]/, //Finds caps to improve security
        nums = /[0-9]/,
        symbols = /[!-/:-@[-`{-~]/, //Finds valid symbols to make passwords more secure
        reject = /[^!-~]/; //RegEx finds invalid characters (outside of range ! to ~ in ascii)

    if(reject.test(p)){
        throw "Invalid Character";
    }
    if(p.length<8){
        throw "Password too short"
    }
    if(!nums.test(p)){
        throw "Enter at least one number";
    }
    if(!caps.test(p)){
        throw "Enter at least one capital letter";
    }
    if(!symbols.test(p)){
        throw "Enter at least one special character";
    }
    return true;
}

//receives two strings, compares them and throws an error if they are not equal
function verifyConfirmation(p, pc) {
    if(p!==pc){
        throw "Passwords don't match"
    }
    return true
}

//Checks inputs for errors, catches errors, returns them and displays them in DOM if there are any. If no errors are thrown, adds checkmarks to DOM and returns True
function checkErrors(inp) {
    let errorDisplay = document.getElementById("errorInPass"),
        checkSpan = document.getElementById("passValid");

    if(inp === passInput){
        try{
            ValidPass(pass);
            checkSpan.innerText = "✔️";
            errorDisplay.innerText = "";
            unlockVerify();
        } catch (e) {
            checkSpan.innerText = "❌";
            errorDisplay.innerText = e;
            lockVerify();
            return e;
        }
    }
    if(inp === passConfirm || passConfirm.value){
        checkSpan = document.getElementById("confirmValid");
        try{
            verifyConfirmation(pass, passConfirm.value);
            checkSpan.innerText = "✔️";
            errorDisplay.innerText = "";
        } catch (e){
            checkSpan.innerText = "❌";
            errorDisplay.innerText = e;
            return e;
        }
    }
    return true
}

//Locks and unlocks Verify field
function unlockVerify() { passConfirm.disabled = false; }
function lockVerify() { passConfirm.disabled = true; }
