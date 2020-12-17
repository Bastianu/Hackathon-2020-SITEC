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
  VALUES ('Mickael', 'Rigonnaux', 'administrateur','mickael@example.com', password_hash('administrateur',PASSWORD_BCRYPT))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('John', 'Washington', 'client','washington@example.com', password_hash('client',PASSWORD_BCRYPT))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('Kennedy', 'Doe', 'client','kennedy@example.com', password_hash('client',PASSWORD_BCRYPT))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";
  
  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('Bruce', 'Harper', 'client','bruce@example.com', password_hash('client',PASSWORD_BCRYPT))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('Patrick', 'Evrette', 'client','patrick@example.com', password_hash('client',PASSWORD_BCRYPT))";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO TECHNOLOGIE (technoname, version)
  VALUES ('mariadb', '10.4.13')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO TECHNOLOGIE (technoname, version)
  VALUES ('apache', '2.3')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO TECHNOLOGIE (technoname, version)
  VALUES ('nginx', '1.18.0')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO TECHNOLOGIE (technoname, version)
  VALUES ('windows', '1809')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO TECHNOLOGIE (technoname, version)
  VALUES ('ubuntu', '18.0.4')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('2', '1')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('2', '2')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('2', '4')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('3', '3')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('3', '5')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('4', '1')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";
  
  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('4', '3')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";
  
  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('4', '5')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('5', '1')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('5', '2')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USERTECHNOLOGIE (id_user, id_technologie)
  VALUES ('5', '4')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";
  
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>