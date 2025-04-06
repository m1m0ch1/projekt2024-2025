<?php

require_once "connect.php";
require_once "helper.php";

if( isset( $_POST["email"] ) && isset( $_POST["jelszo"] ) )
{
    $email = $_POST["email"];
    $jelszo = $_POST["jelszo"];

    $ok = false;
    $users = getTable("users");
    foreach($users as $user ){
        if( $user["email"] == $email  && $user["password"] == $jelszo ){
            $ok = true;
            $_SESSION["bejelentkezett"] = $email;
        }
    }
}


require_once "header.php";

?>

<main class="container">

        <form class="col col-sm-12 col-md-6 offset-md-3 login-form" action="" method="POST">
            <h1>Bejelentkezés</h1>

            <?php
            if(  isset($ok) && $ok ){
                echo "<div class='alert alert-success' role='alert'>Sikeres bejelentkezés</div>";
            }
            ?>

            <img src="/kepek/login.png" class="img-fluid mx-auto d-block" alt="regisztráció" style="width: 250px;">

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            
            <div class="mb-3">
                <label for="inputPassword5" class="form-label">Jelszó</label>
                <input type="password" id="jelszo" name="jelszo" class="form-control" placeholder="********" >
            </div>

            <button type="submit" class="btn btn-primary mt-3">Bejelentkezés</button>
        </form>

</main>


<?php

require_once "footer.php";

?>

