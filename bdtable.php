<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SITEC";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connected successfully<br>";

    // sql to create table
    $sql = "CREATE TABLE USER (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        rol ENUM('administrateur','client') NOT NULL,
        email VARCHAR(100),
        passwd VARCHAR(100)
    )";
   
    $conn->exec($sql);
    echo "Database USER successfully created<br>";

    $sql = "CREATE TABLE TECHNOLOGIE (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        technoname VARCHAR(30) NOT NULL,
        version VARCHAR(10) NOT NULL
        
    )";
    
    $conn->exec($sql);
    echo "Database TECHNOLOGIE successfully created<br>";

    $sql = "CREATE TABLE USERTECHNOLOGIE (
        id_user INT(6) UNSIGNED,
        id_technologie INT(6) UNSIGNED,
        CONSTRAINT fk_user_id FOREIGN KEY (id_user) REFERENCES USER(id),
        CONSTRAINT fk_user_id FOREIGN KEY (id_technologie) REFERENCES TECHNOLOGIE(id),
        PRIMARY KEY (id_user,id_technologie)
    )";

    $conn->exec($sql);
    echo "Database USERTECHNOlOGIE successfully created<br>";

    $sql = "CREATE TABLE CVE (
        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(50) NOT NULL,
        impact VARCHAR(50) NOT NULL,
        desc_cve VARCHAR(2048) NOT NULL, 
        solutions VARCHAR(2048) NOT NULL,
    )";

    $conn->exec($sql);
    echo "Database USERTECHNOlOGIE successfully created<br>";
    
    $sql = "CREATE TABLE CVETECHNO (
        id_cve INT(6) UNSIGNED,
        id_techno INT(6) UNSIGNED,
        CONSTRAINT fk_cve_id FOREIGN KEY (id_cve) REFERENCES CVE(id),
        CONSTRAINT fk_techno_id FOREIGN KEY (id_techno) REFERENCES TECHNOLOGIE(id),
        PRIMARY KEY (id_user,id_technologie)
    )";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


$conn = null;
?>