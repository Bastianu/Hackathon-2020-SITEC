<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SITEC";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('John', 'Doe', 'administrateur','john@example.com', sha1('admin'))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('John', 'Washington', 'client','washington@example.com', sha1('client'))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('Kennedy', 'Doe', 'client','kennedy@example.com', sha1('client'))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";







  
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>