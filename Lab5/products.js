//Item class to easily add new products
class Item{
    name; price; img; color;
    constructor(name, price, img){
        this.name = name;
        this.price = price;
        this.img = img;
    };
    addColor = function(col){this.color = col; return this};
}


let items = [],
    cart = [],
    shp = document.getElementById("shop"),
    htmlToAdd = "<h1>Shop</h1><br>";

//Add some example items
items.push(new Item("Cap", 99, "cap.png"));
items.push(new Item("Backpack", 499, "bag.png"));
items.push(new Item("T-Shirt", 299, "shirt.png"));

//Adds items into html using the template
items.forEach(itm => {
    htmlToAdd = htmlToAdd.concat(`
        <article class=shopItem id=shp-${itm.name}> 
            <h3>${itm.name}</h3>
            <img class=itemImg id='img${itm.name}' alt='${itm.name}' src='img/${itm.img}' />
            <h4>$${itm.price}<a href="#footer">*</a></h4>
            <label for="color${itm.name}">Choose a color:</label>
            <select id="color${itm.name}">
                <option value="black">Black</option>
                <option value="white">White</option>
                <option value="orange">Orange</option>
                <option value="green">Green</option>
                <option value="blue">Blue</option>
            </select>
            <input type="button" id="add${itm.name}" value="Add">
        </article>
    `);
});
htmlToAdd = htmlToAdd.concat("<table id='cart'></table>");
shp.innerHTML=htmlToAdd;

//adds event listeners to buttons and dropdowns in products
items.forEach(itm=>{
    setColor(`img${itm.name}`, "black");

    //when add to cart button is pressed
    document.getElementById(`add${itm.name}`).addEventListener("click",() =>{
        let obj = new Item(itm.name, itm.price, itm.image);
        obj.color = document.getElementById(`color${itm.name}`).value;
        cart.push(obj);
        cartToTable();
    });
    //when color dropdown is changed
    document.getElementById(`color${itm.name}`).addEventListener("change", function(){
        setColor(`img${itm.name}`, this.value);
    });
});

//function that changes color to an image on DOM based on its id and one of the predefined colors
function setColor(imgId, col){
    let img = document.getElementById(imgId);
    let filter = "";
    switch(col){
        case "orange": filter = "hue-rotate(276deg)"; break;
        case "green": filter = "hue-rotate(0deg)"; break;
        case "blue": filter = "hue-rotate(100deg)"; break;
        case "white": filter = "grayscale(1) brightness(130%)"; break;
        case "black": filter = "grayscale(1) brightness(25%)"; break;
        default: break;
    }
    img.style.filter = filter;
}

//Displays the cart as a table in the file
let rem;
function cartToTable(){
    let total = 0;
    htmlToAdd = "<th>Name<th>Color</th><th>Price</th>";
    cart.forEach(item => {
        total += item.price;
        htmlToAdd = htmlToAdd.concat(`
            <tr>
                <td>${item.name}</td>
                <td>${item.color}</td>
                <td>$${item.price}</td>
            </tr>
        `);
    });
    htmlToAdd = htmlToAdd.concat(`
        <tr>
            <th>Subtotal</th>
            <th></th>
            <th>$${((total*100)/116).toFixed(2)}</th>
        </tr>
        <tr>
            <th>Tax (16%)</th>
            <th></th>
            <th>$${((total*16)/116).toFixed(2)}</th>
        </tr>
        <tr>
            <th>Total</th>
            <th></th>
            <th>$${total}</th>
        </tr>
        <tr>
            <th><input type="button" id="clearCart" value="Clear"></th>
        </tr>
        
    `);
    document.getElementById("cart").innerHTML = htmlToAdd;
    document.getElementById("clearCart").addEventListener("click", () =>{cart = []; cartToTable();});

}
cartToTable();

