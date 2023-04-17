<!DOCTYPE html>
<html lang="fr">
  <head>
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="styles.css" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta charset="utf-8" />
    <title id="connexion">Login</title>
    <link
      href="https://fonts.googleapis.com/css?family=Krona+One"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Reem+Kufi"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="wrapper">
      <div class="top-bar">
        <div class="top-bar-img">
          <a href="/"><img src="/images/logo-notext.png" /></a>
        </div>
        <a>Utiliser une base de donnée MySQL avec PHP</a>
      </div>
   	  <div class="login">
        <h1 class="title_connexion">CONNEXION</h1>
        <form action="login.php" method="post" class="form_log">
            <input class="email" type="email" name="email" placeholder="Email:" required>
            <input class="mdp" type="password" name="password" placeholder="Mot de passe:" required>
            <a href="">Mot de passe oublié ?</a>
            <div class="remember">
                <input type="checkbox" id="check" name="remember">
                <label for="check">Se souvenir de moi</label>
            </div>
            <button id="btn" class="connect_button" type="submit">Se connecter</button>
            <?php
            // Replace with your own database credentials
            $host = "localhost";
            $creds = file(".creds");
            $creds_line = $creds[0];
            $creds_parts = explode(":", $creds_line);
            $username = $creds_parts[0];
            $password = $creds_parts[1];
            $dbname = "employees";

            // Connect to the database
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Get the email and password from the form
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            
            // Prepare and execute the query to check if the user exists
            $sql = "SELECT password FROM creds WHERE email = " .  $email
            $result = mysqli_query($conn, $sql);
            if ($result) {
              $row = mysqli_fetch_assoc($result);
              $hashed_password = $row['password'];
              echo '$password \n $hashed_password'
              if (password_verify($password, $hashed_password)) {
                  echo "Credentials are goods"
              } else {
                  echo "Error, bad email or password"
              }
            } 
                echo "Error, bad email or password"
            }
            ?>  
        </form>
        <a class="link_compt_crea" href="">Vous n'avez pas de compte ? Créez le</a>
      </div>
    </div>
  </body>
  <div class="bottom-bar">
    <a>© take-eir</a>
    <a href="/contact.html">Nous contacter</a>
    <div class="medias">
      <!-- https://icons8.com/icons/set/social-media -->
      <a href="https://linkedin.com/"
        ><img src="/images/icons8-linkedin-24.png" />
      </a>
      <a href="https://youtube.com/"
        ><img src="/images/icons8-youtube-logo-24.png"
      /></a>
      <a href="https://twitter.com/"
        ><img src="/images/icons8-twitter-24.png" />
      </a>
      <a href="https://instagram.com/"
        ><img src="/images/icons8-instagram-24.png" />
      </a>
    </div>
  </div>
</html>
