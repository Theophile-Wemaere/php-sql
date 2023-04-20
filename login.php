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
        <a>Utiliser une base de donnée MySQL avec PHP</a>
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
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Connect to MySQL database
                $creds = file(".creds");
                $creds_line = $creds[0];
                $creds_parts = explode(":", $creds_line);
                $username = $creds_parts[0];
                $password = $creds_parts[1];
                $dbname = "employees";

                try {
                    $conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Execute SQL query
                    $sql = $_POST["query"];
                    $sql = str_replace(";", "", $sql);

                    // Check if query is a SELECT statement
                    if (preg_match("/^\s*SELECT/i", $sql)) {
                        $num_results = $_POST["num_results"];
                        $sql .= " LIMIT " . $num_results;
                    }

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Display results on HTML page
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (count($result) > 0) {
                        echo "<table>";
                        echo "<tr>";
                        foreach (array_keys($result[0]) as $field) {
                            echo "<th>" . $field . "</th>";
                        }
                        echo "</tr>";
                        foreach ($result as $row) {
                            echo "<tr>";
                            foreach ($row as $cell) {
                                echo "<td>" . $cell . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No results found.";
                    }

                    // Close MySQL connection
                    $conn = null;
                } catch(PDOException $e) {
                    echo "Error executing query: " . $e->getMessage();
                }
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
