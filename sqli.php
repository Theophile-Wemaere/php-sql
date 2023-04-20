<!DOCTYPE html>

<head>
  <title>health-eir</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="styles.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="/images/logo-notext.png" type="image/icon type" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    rel="stylesheet"
    href="https://kit.fontawesome.com/bc424452bc.css"
    crossorigin="anonymous"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Krona+One&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Nunito&display=swap"
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

<html>
  <body>
    <style>
      pre {
        font-size: 25px;
      }
    </style>
    <div class="wrapper">
      <div class="top-bar">
        <div class="top-bar-img">
          <a href="/"><img src="/images/logo-notext.png" /></a>
        </div>
        <a>Utiliser une base de données MySQL avec PHP</a>
      </div>
      <div class="main-box">
      <?php
      $phpCode = '$email = $_POST["username"];
$password = $_POST["password"];
$query = \'SELECT * FROM users WHERE username = $username AND password = $password\';  
';
      echo '<pre><code class="language-php">' .
        htmlspecialchars($phpCode) .
        "</code></pre>";
      ?>
        <img src="https://academy.hackthebox.com/storage/modules/33/notadmin_diagram_1.png" width=50% height=auto>
        <?php
        $phpCode = '$email = $_POST["username"];
$password = $_POST["password"];
$sql = "SELECT password FROM creds WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(["email" => $email]);
';
        echo '<pre><code class="language-php">' .
          htmlspecialchars($phpCode) .
          "</code></pre>";
        ?>
        <div class="switcher">
          <a href="login.php" ><button class="page-button">&lt;</button></a>
          <a> 5/5 </a>
          <a><button class="page-button">&gt;</button></a>
        </div>
      </div>
    </div>
  </body>
  <div class="bottom-bar">
    <a>© take-eir</a>
    <a href="/contact.html">Nous contacter</a>
    <div class="medias">
      <!-- https://icons8.com/icons/set/social-media -->
      <a href="https://github.com/Theophile-Wemaere/php-sql">
        <img src="images/icons8-github-24.png" />
      </a>
      <a href="https://linkedin.com/"
        ><img src="images/icons8-linkedin-24.png" />
      </a>
      <a href="https://youtube.com/"
        ><img src="images/icons8-youtube-logo-24.png"
      /></a>
      <a href="https://twitter.com/"
        ><img src="images/icons8-twitter-24.png" />
      </a>
      <a href="https://instagram.com/"
        ><img src="images/icons8-instagram-24.png" />
      </a>
    </div>
  </div>
</html>
