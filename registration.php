<?php

require_once "connect.php";

if( isset( $_POST["nev"] ) && isset( $_POST["email"] ) && isset( $_POST["jelszo"] ) )
{

    $nev = $_POST["nev"];
    $email = $_POST["email"];
    $jelszo = $_POST["jelszo"];

    $ok = true;
    if( strlen($nev) < 5 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($jelszo) < 8 ){
        $ok = false;
    }

    if($ok == true){
        $sql = $db->prepare("INSERT INTO users (name, email, password, isadmin) VALUES('$nev', '$email', '$jelszo', 0  )");
        $sql->execute();
    }
}


require_once "header.php";

?>

<main class="container">

        <form class="col col-sm-12 col-md-6 offset-md-3 login-form" action="" method="POST">
            <h1>Regisztráció</h1>

            <?php
            if(  isset($ok) && $ok ){
                echo "<div class='alert alert-success' role='alert'>Sikeres regisztráció</div>";
            }
            ?>

            <img src="/kepek/reg.png" class="img-fluid mx-auto d-block" alt="regisztráció" style="width: 250px;">

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Név:</label>
                <input type="text" id="name" name="nev" class="form-control" id="exampleFormControlInput1" placeholder="Nagy József">
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Jelszó</label>
                <input onkeyup="document.getElementById('erosseg').style.width = jelszoErosseg(this.value)*20 + '%'; " type="password" id="jelszo" name="jelszo" class="form-control" placeholder="********" >
                <div id="erosseg" style="background-color: green; width:5%; height:10px;"></div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Regisztráció</button>
        </form>

</main>


<?php

require_once "footer.php";

?>

