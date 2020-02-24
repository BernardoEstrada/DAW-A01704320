
class item{
    name;
    price;
    img;
    Constructor(){

    }
}

let items = document.getElementById("shop").getElementsByClassName("shopItem");
// console.log(typeof items);
// console.log(items);
// items.forEach(item=>{
//     console.log(item.getElementById("price").innerText)
// });

document.getElementById("hueSl").addEventListener("input",function(){
    document.getElementsByClassName("hue")[0].style.filter = " brightness(50%) sepia(1) hue-rotate(" + this.value + "deg)";
});

let rot=0;
setInterval(()=>{
    rot=(rot+1)%360;
}, 10);
console.log(document.getElementsByClassName("hue")[0].style.filter);
