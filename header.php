<?php
require_once 'helper.php';
?>
<!doctype html>
<html lang="hu" data-bs-theme="dark"   >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="script.js"></script>
  <style>
    #cart{
      background-color: gray;
      color: white;
      position: fixed;
      right: 150px;
      bottom: 150px;
      width: 100px;
      padding: 8px;
      box-shadow: 0px 0px 10px lightgray;
    }
    #cartcount{
      text-align: center;
      font-size: x-large;
      font-weight: bold;
    }
    #cart div img{
      width: 100%;
    }
  </style>
  </head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">

    <!-- logo -->
    <a class="navbar-brand" href="#"><img src="/logo.png" height="60" ></a>

    <!-- hamburger menu -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- menüpontok -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Főoldal</a>
        </li>
        
        <?php 
        // kateógriák kikkeresése a termékek táblából
        $kategoriak = array();
      
        $termekek = getTable("products");
        foreach($termekek as $termek)
        {
          $kategoriak[] = $termek["category"];
        }

        $kategoriak = array_unique($kategoriak);
        
        $cnt = 0;
        foreach($kategoriak as $kategoria)
        {
          if( $cnt++ == 6) break;

          echo "<li class='nav-item'> <a class='nav-link' href='#' onclick='keres(\"$kategoria\")' >$kategoria</a> </li>";
        }

        ?>
          
        
      </ul>

      <!-- keresés -->
      <script>
        
        function keres(keresoszo=""){
          
          if(keresoszo == "")
              keresoszo = document.getElementById("keres").value;
          
          let adatok = letoltes("products",megjelenitOsszes, keresoszo );
          return false;
        }
      </script>
      
      <input onkeyup="keres()" id="keres" class="form-control me-2" type="search" placeholder="Keresés" aria-label="Search">
      <button onclick="keres()" class="btn btn-outline-success">Keresés</button>
      
    </div>

    <?php if( !isset($_SESSION["bejelentkezett"]) ): ?>

      <a href="/registration.php">
          <button class="btn btn-outline-danger me-2 ms-3" type="button">Regisztráció</button>
      </a>

      <a href="/login.php">
          <button class="btn btn-outline-info me-1 ms-1" type="button">Bejelentkezés</button>
      </a>

    <?php else: ?>

      <a href="/logout.php">
          <button class="btn btn-outline-danger me-2 ms-3" type="button">Kijelentkezés</button>
      </a>

    <?php endif; ?>

  </div>
</nav>

<?php
if( isset($_SESSION["bejelentkezett"])  ){
  echo "<div class='alert alert-light' role='alert'>Bejelentkezett: {$_SESSION["bejelentkezett"]}</div>";
}
?>