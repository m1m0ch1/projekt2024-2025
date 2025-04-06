<?php

require_once "helper.php";

require_once "header.php";

$id = $_GET['id'];

$adatok = getTable("products", $id);

$adatok['name'] = str_replace(['"', "'", ';', '\\'], '', $adatok['name']);
?>




<div class="container mt-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6 mb-4">
            <img src="<?php echo $adatok['pic']; ?>" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">
            
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3"><?php echo $adatok['name']; ?></h2>
            <p class="text-muted mb-4">ID: <?php echo $adatok['id']; ?></p>
            <div class="mb-3">
                <span class="h4 me-2"><?php echo $adatok['price']; ?> Ft</span>
                <span class="text-muted"><s>Kedvezményes ár: <?php echo $adatok['price']; ?> Ft</s></span>
            </div>
            <div class="mb-3">
                <i class="bi bi-star-fill text-warning">⭐</i>
                <i class="bi bi-star-fill text-warning">⭐</i>
                <i class="bi bi-star-fill text-warning">⭐</i>
                <i class="bi bi-star-fill text-warning">⭐</i>
                <i class="bi bi-star-half text-warning">⭐</i>
                <span class="ms-2">4.9 (120 vélemény)</span>
            </div>
            <p class="mb-4"><?php echo nl2br($adatok['description']); ?></p>
            <div class="mb-4">
                <h5>Típus:</h5>
                <div class="btn-group" role="group" aria-label="Color selection">
                    <input type="radio" class="btn-check" name="color" id="black" autocomplete="off" checked>
                    <label class="btn btn-outline-dark" for="black">Típus1</label>
                    <input type="radio" class="btn-check" name="color" id="silver" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="silver">Típus2</label>
                    <input type="radio" class="btn-check" name="color" id="blue" autocomplete="off">
                    <label class="btn btn-outline-primary" for="blue">Típus3</label>
                </div>
            </div>

            <div class="mt-4">
                <h5>Kategória:</h5>
                <ul>
                    <li><?php echo $adatok['category']; ?></li>
                </ul>
            </div>

            
            <button onclick="addToCart(<?php echo $adatok['id']; ?>, '<?php echo $adatok['name']; ?>','<?php echo $adatok['pic']; ?>',<?php echo $adatok['price']; ?> )" class="btn btn-primary btn-lg mb-3 me-2">
                    <i class="bi bi-cart-plus"></i> Kosárba
                </button>
            
        </div>
    </div>
</div>






<?php
require_once "footer.php";
