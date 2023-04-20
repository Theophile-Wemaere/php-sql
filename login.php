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
    <link
    rel="stylesheet"
    href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css"
  />
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
  <script>
    hljs.highlightAll();
  </script>
  </head>
  <body>
    <div class="wrapper">
      <div class="top-bar">
        <div class="top-bar-img">
          <a href="/"><img src="/images/logo-notext.png" /></a>
        </div>
        <a>Utiliser une base de données MySQL avec PHP</a>
      </div>
      <div class="main-box">
        <div class="login">
        <?php
        $phpCode = '//Get the email and password from the form
$email = $_POST["email"];
$password = md5($_POST["password"]);

// Prepare and execute the query to check if the user exists
$sql = "SELECT password FROM creds WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(["email" => $email]);
$result = $stmt->fetchColumn();

if ($stmt->rowCount() > 0) {
  $row = $stmt->fetch();
  $password_hash = $row[\'password\'];
  if (password_verify($password, $password_hash)) {
    echo "Password is valid";
  } else {
      echo "Invalid password";
  }
} else {
  echo "Error, bad credentials";
};';
        echo '<pre><code class="language-php">' .
          htmlspecialchars($phpCode) .
          "</code></pre>";
        echo '<a href="https://www.php.net/manual/en/function.password-verify.php">password_verify documentation page</a>';
        ?>
        
          <h1 class="title_connexion">CONNEXION</h1>
          <form action="login.php" method="post" class="form_log">
              <input class="email" type="email" name="email" placeholder="Email:" required>
              <input class="mdp" type="password" name="password" placeholder="Mot de passe:" required>
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

              // Connect to the database using PDO
              $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
              $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
              ];
              try {
                $pdo = new PDO($dsn, $username, $password, $options);
              } catch (PDOException $e) {
                echo "error connecting";
                throw new PDOException($e->getMessage(), (int) $e->getCode());
              }

              // Get the email and password from the form
              $email = $_POST["email"];
              $password = $_POST["password"];

              // Prepare and execute the query to check if the user exists
              $sql = "SELECT password FROM creds WHERE email = :email";
              $stmt = $pdo->prepare($sql);
              $stmt->execute(["email" => $email]);
              if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $password_hash = $row["password"];
                if (password_verify($password, $password_hash)) {
                  echo "Password is valid!";
                  echo '<script>alert("Your password is valid ! Congratulation")</script>';
                } else {
                  echo "Invalid password.";
                }
              } else {
                echo "Error, bad credentials";
              }
              ?>
          </form>
        </div>
        <div class="switcher">
            <a href="demo.php" ><button class="page-button">&lt;</button></a>
            <a> 4/5 </a>
            <a href="sqli.php"><button class="page-button">&gt;</button></a>
        </div>
      </div>
    </div>
  </body>
  <div class="bottom-bar">
    <a>© take-eir</a>
    <a href="/contact.html">Nous contacter</a>
    <div class="medias">
      <a href="https://github.com/Theophile-Wemaere/cool_buttons">
        <img src="images/icons8-github-24.png" />
      </a>
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
