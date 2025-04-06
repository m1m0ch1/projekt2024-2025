<?php
require_once "connect.php";

function getTable($table, $id = null) {

    global $db;
    
    $sql = $db->prepare("SELECT * FROM $table");
    if( $id != null)
    {
        $sql = $db->prepare("SELECT * FROM $table WHERE id = $id ");
    }

    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if( $id != null)
    {
        return $result[0];
    }
    return $result;
}

function postTable($table, $data){

    global $db;

    unset($data['id']);

    // name => "hajszárító, category => "háztartási, kulcs => érték
    $columns = array_keys($data);   // name, category ...
    $columns = join(', ', $columns);

    $kerdojelek = [];
    for($i = 0; $i < count($data); $i++ )
    {
        $kerdojelek[] = "?";
    }                               // ?  ?  ? 
    $kerdojelek = join(',', $kerdojelek);         // ? , ? , ? 

    $sql = "INSERT INTO `$table` ($columns) VALUES ($kerdojelek)";
    $sql = $db->prepare($sql);

    $hanyadik = 1;
    foreach($data as $kulcs => $ertek)
    {
        $sql->bindValue($hanyadik,  $ertek); // valahányadik kérdőjelhez hozzárendel adatot
        $hanyadik++;
    }
   
    $siker = $sql->execute();


    header("Location: /admin/admin.php");


}

function deleteTable($tabla, $id){
    global $db;

    $sql = "DELETE FROM $tabla WHERE id = $id;";
    $sql = $db->prepare($sql);

    $siker = $sql->execute();

    header("Location: /admin/admin.php");
    
}




function showTable($table){

    // lekéri az adatokat
    $data = getTable($table);

    // cím
    echo "<h1> $table tábla </h1>";

    // táblázat kezdés 
    echo "<table class='table' border='1'   >";

    // táblázat fejléce
    echo "<tr>";
    echo "<td scope='row' >Törlés</td>";
    foreach($data[0] as $nev => $adat){
        echo "<td  scope='row'>";
            echo "<b>$nev</b>";
        echo "</td>";
    }
    echo "</tr>";


    // táblázat sorai
    foreach ($data as $d) {
        echo "<tr>";    // sor
            echo "<td scope='row'><a href='?torles={$d['id']}&table=$table'> Törlés </a></td>";
            foreach ($d as $adat) {
                echo "<td scope='row'>";     // cella
                    echo $adat;
                echo "</td>";
            }
        echo "</tr>";
    }

    echo "</table>";

}

// űrlap generáló függvény

// szükségünk van egy adattábla összes olzsopára
function tablaOszlopok($tabla)
{
    global $db;
    $sql = "SHOW COLUMNS FROM $tabla";
    $sql = $db->prepare($sql);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    $oszlopnevek = [];
    foreach($result as $elem)
    {
        $oszlopnevek[] = $elem["Field"];
    }
    
    return $oszlopnevek;
}


/*
  <form method='post' action='/api.php?tabla=products'>  
    <p> Terméknév: <input type='text' name='name'> </p>
    <p> Kategória: <input type='text' name='category'> </p>
    <p> Ár: <input type='text' name='price'> </p>
    <p> Leírás: <input type='text' name='description'> </p>
    <p> Kép url: <input type='text' name='pic'> </p>
    <p> <input type='submit' value='Beszúrás'> </p>
  </form>
*/


function urlapGenerator($tabla)
{
    echo "<h4> Beszúrás a(z) $tabla táblába </h4>";
    
    $oszlopok = tablaOszlopok($tabla);
    echo "<form method='post' action='/admin/admin.php?tabla=$tabla'>";

    echo "<div class='mb-3'>";
    foreach($oszlopok as $oszlop)
    {
    echo "<input class='form-control' type='text' name='$oszlop'>";
    echo "<label for='exampleInputEmail1' class='form-label'>$oszlop</label> ";
    }
    echo "</div>";

    echo "<p> <input type='submit' value='Küld'> </p>";

    echo "</form>";    
}



