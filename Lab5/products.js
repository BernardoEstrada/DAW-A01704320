
class Item{
    name; price; img; color;
    constructor(name, price, img){
        this.name = name;
        this.price = price;
        this.img = img;
    }
}


let items = [],
    cart = [],
    shp = document.getElementById("shop"),
    htmlToAdd = "<h1>Shop</h1><br>";

items.push(new Item("Gorra", 100, "cap.png"));
items.push(new Item("Mochila", 500, "bag.png"));
items.push(new Item("Camisa", 1300, "shirt.png"));

items.forEach(itm => {
    htmlToAdd = htmlToAdd.concat(`\
        <article class=shopItem id=shp-${itm.name}> \
            <h3>${itm.name}</h3>\
            <img class=itemImg alt='${itm.name}' src='img/${itm.img}' />\
        </article> \
    `);
});
shp.innerHTML=htmlToAdd;
// console.log(typeof items);
// console.log(items);
// items.forEach(item=>{
//     console.log(item.getElementById("price").innerText)
// });
//
//
let rot=0;
setInterval(()=>{
    let imgs=document.getElementsByClassName("itemImg");
    for(let i=0; i<imgs.length;i++){
        imgs[i].style.filter = "hue-rotate(" + rot + "deg)";
    }
    rot=(rot+1)%360;
}, 10);
// console.log(document.getElementsByClassName("hue")[0].style.filter);
