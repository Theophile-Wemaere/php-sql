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
    <div class="wrapper">
      <div class="top-bar">
        <div class="top-bar-img">
          <a href="/"><img src="/images/logo-notext.png" /></a>
        </div>
        <a>Utiliser une base de donnée MySQL avec PHP</a>
      </div>
      <div class="main-box">

	<form method="POST">
		<label for="query">Enter SQL query:</label><br>
		<textarea id="query" name="query" rows="5" cols="30"><?php if(isset($_POST['query'])) { echo htmlspecialchars($_POST['query']); } ?></textarea><br>
    <label for="num_results">Number of results per page:</label>
		<select id="num_results" name="num_results">
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select><br>
		<input type="submit" value="Execute" class="login-button">
	</form>

	<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Connect to MySQL database
   $servername = "localhost";

   $creds = file(".creds");
   $creds_line = $creds[0];
   $creds_parts = explode(":", $creds_line);
   $username = $creds_parts[0];
   $password = $creds_parts[1];

   $dbname = "employees";

   $conn = mysqli_connect($servername, $username, $password, $dbname);
   if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
   }

   // Execute SQL query
   $sql = $_POST["query"];
   $sql = str_replace(";", "", $sql);

   // Check if query is a SELECT statement
   if (preg_match("/^\s*SELECT/i", $sql)) {
     $num_results = $_POST["num_results"];
     $sql .= " LIMIT " . $num_results;
   }

   $result = mysqli_query($conn, $sql);
   // Display results on HTML page
   if ($result) {
     if (mysqli_num_rows($result) > 0) {
       echo "<table>";
       echo "<tr>";
       foreach (mysqli_fetch_fields($result) as $field) {
         echo "<th>" . $field->name . "</th>";
       }
       echo "</tr>";
       while ($row = mysqli_fetch_assoc($result)) {
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
   } else {
     echo "Error executing query: " . mysqli_error($conn);
     echo $sql;
   }

   // Close MySQL connection
   mysqli_close($conn);
 } ?>

        <div class="switcher">
          <a href="code.php" ><button class="page-button">&lt;</button></a>
          <a> 3/5 </a>
          <a href="login.php"><button class="page-button">&gt;</button></a>
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
