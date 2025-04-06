<?php
//require_once "connect.php";

require_once "helper.php";

/*
Böngésző (megaától adja ki, de javascript-tel is kiadható):
GET - lekérés
POST - beküldés
PUT - frissítés
DELETE - törlés

VVVVV
Szerveren a PHP-ban ehhez készülnek különleges tömbök AUTOMATIUSAN

$_GET - tömb tartalmazza a webcím részeit
$_POST - tartalmazza a beküldött adatokat
$_PUT -
$_DELETE -

Üzenet típusa:
$_SERVER["REQUEST_METHOD"]
*/

// kérés típusa GET POST PUT DELETE
$tipus = $_SERVER["REQUEST_METHOD"];

if($tipus == "GET" && isset($_GET['tabla']) )
{
    // A lekéréshez szüksépges: a tábla megjelölése a webcímben
    // /?tabla=products
    // Ellenőrizzük, hogy megvan-e
    // api.php?tabla=valami

    // Hasznmáljuk a lekérő függvényt
    // Odaadjuk neki az URL-ben található tábla beállítást
    $adatok = getTable( $_GET['tabla'] ) ;
    echo json_encode($adatok);
}
else if($tipus == "POST")
{
    if( ! isset($_GET['tabla']) )
        die("Nincs megadva a tábla");

    postTable( $_GET['tabla'],  $_POST) ;
}

else if($tipus == "PUT")
{
    if( ! isset($_GET['tabla']) )
        die("Nincs megadva a tábla");

    echo "Frissítés";
}
else if($tipus == "DELETE")
{
    if( ! isset($_GET['tabla']) )
        die("Nincs megadva a tábla");

    echo "Törlés";
}


//exit();



