<?php

require_once "header.php";

?>

<main class="container">

<?php

    $oldal_id = $_GET["oldal"];

    $data = getTable("pages", $oldal_id);

    echo "<h1> {$data["title"]} </h1>";

    echo "<img src='{$data["image"]}' class='img-fluid mb-5 mt-3' style='height: 300px; width: 100%; object-fit: cover;'>";

    echo $data["content"];

?>
        
</main>


<?php

require_once "footer.php";

?>

