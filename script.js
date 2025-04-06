function letoltes( tabla, megjelenitoFV, keresoszo='' )
{
    fetch(`/api.php?tabla=${tabla}`)    // adat letöltés
    .then(response => response.json())    // JSON-ként értelmezés
    .then(data => megjelenitoFV(data, keresoszo))       // konzolra kiírju az adatok
    .catch(error => console.error('Error:', error));    // ha hiba van, azt is
}


function megjelenitOsszes(adatok, keresoszo=''){

    hova = document.getElementById("termekek");
    hova.innerHTML = "";

    keresoszo = keresoszo.toLowerCase();
    
    let lista = [];

    for(let termek of adatok){

        // ha az adatok közöttt nem szerepel keresőszó, akkor átugorjuk
        if( keresoszo != '')
            if( ! termek.name.toLowerCase().includes(keresoszo) && 
                ! termek.description.toLowerCase().includes(keresoszo) && 
                ! termek.category.toLowerCase().includes(keresoszo) 
              )
                continue;

        szoveg = `
            <div class="card col-sm" style="width: 18rem; float:left;">
                <img class="card-img-top object-fit-cover" style="height: 360px;" src="${termek.pic}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">${termek.name}</h5>
                    <p class="card-text">${termek.description.substr(0, 90)}...</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">${termek.price} Ft</li>
                    <li class="list-group-item">Kategória: ${termek.category}</li>
                    
                </ul>
                <div class="card-body">
                    <a href="product.php?id=${termek.id}" class="btn btn-primary">Tovább</a>
                </div>
            </div>
        `;
        lista.push(szoveg);

        if( lista.length >= 3){
            hova.innerHTML += "<div class='row' style='margin-bottom: 10px;'>" + lista[0] + lista[1] + lista[2] + "</div>";
            lista = [];
        }
    }

    // ha kevesebb mint 3 (nem egy teljes sornyi) találat van
    if( lista.length > 0){
        hova.innerHTML += "<div class='row' style='margin-bottom: 10px;'>" + lista.join() + "</div>";
        lista = [];
    }
}

/*
- megfelelő-e a hossza 8<
- van-e benne szám
- van-e benne nagybetű
- van-e benne speciális karakter
- van-e benne kisbetű
*/
function jelszoErosseg(jelszo){
    var pontok = 0;

    if(jelszo.length > 8){
        pontok++;
    }

    var szamok = "0123456789";
    var vaneszam = false;
    for(var i=0; i < szamok.length; i++){
        // ha a jelszó tartlmaz egy számot (ahol jár for ciklus)
        if(jelszo.includes(szamok[i])){
            vaneszam = true;
        }
    }
    // ha van szám, akkor osztunk pontot
    if(vaneszam == true){
        pontok++;
    }

    //-------------------
   
    var speckar = "#>&<@{}íł;>*?:_+!%/=()";
    var vaneszam = false;
    for(var i=0; i < speckar.length; i++){
        // ha a jelszó tartlmaz egy számot (ahol jár for ciklus)
        if(jelszo.includes(speckar[i])){
            vaneszam = true;
        }
    }
    // ha van szám, akkor osztunk pontot
    if(vaneszam == true){
        pontok++;
    }

    //-------------------
   
    var nagybetu = "QWERTZUIOPŐÚÖÜÓASDFGHJKLÉÁŰÍYXCVBNM";
    var vaneszam = false;
    for(var i=0; i < nagybetu.length; i++){
        // ha a jelszó tartlmaz egy számot (ahol jár for ciklus)
        if(jelszo.includes(nagybetu[i])){
            vaneszam = true;
        }
    }
    // ha van szám, akkor osztunk pontot
    if(vaneszam == true){
        pontok++;
    }

    //-------------------
   
    var kisbetu = "qwertzuiopőúöüóasdfghjkléáűíyxcvbnm";
    var vaneszam = false;
    for(var i=0; i < kisbetu.length; i++){
        // ha a jelszó tartlmaz egy számot (ahol jár for ciklus)
        if(jelszo.includes(kisbetu[i])){
            vaneszam = true;
        }
    }
    // ha van szám, akkor osztunk pontot
    if(vaneszam == true){
        pontok++;
    }


    return pontok;
}

function addToCart(id, name, image, price){

    product = {
        id: id,
        name: name,
        image: image,
        price: price
    };

    let cart = localStorage.getItem("cart");

    if( ! cart )
        cart = [];
    else
        cart = JSON.parse(cart);

    cart.push(product);

    cart = JSON.stringify(cart);

    localStorage.setItem("cart",  cart);

    getCartNumber();
}

function getCartContent(){
    let cart = localStorage.getItem("cart");

    if( ! cart )
        cart = [];
    else
        cart = JSON.parse(cart);

    return cart;
}

function getCartNumber(){

    let cart = localStorage.getItem("cart");

    if( ! cart )
        cart = [];
    else
        cart = JSON.parse(cart);

    let cn = document.getElementById("cartcount");
    cn.innerHTML = cart.length;
}

getCartNumber();

function clearCart(){
    localStorage.removeItem("cart");
}
