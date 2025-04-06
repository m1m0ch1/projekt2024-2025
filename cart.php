<?php
require_once "header.php";
?>

<div class="container">

    <h3 style="margin-top: 30px;">Kosár tartalma:</h3>

    <div id="cartcontent">
    </div>

</div>


<script>
let cart = getCartContent();

let sum=0;
for(let i = 0; i<cart.length; i++){

    let table = `
    <table  class="table">
        <tr>
            <td>${cart[i].name}</td>
            <td><img src="${cart[i].image}" style="width:100px; "> </td>
            <td><b> ${cart[i].price} Ft</b></td>
        </tr>
    </table>
    `;

    sum = sum + cart[i].price ;
    
    document.getElementById("cartcontent").innerHTML += table;

}

document.getElementById("cartcontent").innerHTML += `<h1>${sum} Ft</h1>`;

</script>

<?php
require_once "footer.php";
?>