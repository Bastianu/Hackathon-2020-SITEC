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
  VALUES ('Mickael', 'Rigonnaux', 'administrateur','admin@admin.com', '".password_hash('administrateur',PASSWORD_BCRYPT)."')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('John', 'Washington', 'client','client@client.com', '".password_hash('client',PASSWORD_BCRYPT)."')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('Kennedy', 'Doe', 'client','kennedy@example.com', '".password_hash('client',PASSWORD_BCRYPT)."')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";
  
  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('Bruce', 'Harper', 'client','bruce@example.com', '".password_hash('client',PASSWORD_BCRYPT)."')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO USER (firstname, lastname, rol, email, passwd)
  VALUES ('Patrick', 'Evrette', 'client','patrick@example.com', '".password_hash('client',PASSWORD_BCRYPT)."')";
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

  $sql = "INSERT INTO CVE (cve_id, description, severity, solution, name)
  VALUES ('CVE-2010-3333','This type of attack leverages the use of tags or variables from a formatted configuration data to cause buffer overflow. The attacker crafts a malicious HTML page or configuration file that includes oversized strings, thus causing an overflow.' ,'9.3','Use a language or compiler that performs automatic bounds checking. Use an abstraction library to abstract away risky APIs. Not a complete solution. Compiler-based canary mechanisms such as StackGuard, ProPolice and the Microsoft Visual Studio /GS flag. Unless this provides automatic bounds checking, it is not a complete solution. Use OS-level preventative functionality. Not a complete solution. Do not trust input data from user. Validate all user input.','Buffer Overflow in an API Call')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  $sql = "INSERT INTO CVETECHNO (id_cve, id_techno)
  VALUES ('CVE-2010-3333',1)";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully<br>";

  
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>