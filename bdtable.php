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
        cve_id VARCHAR(30) PRIMARY KEY,
        description TEXT, 
        severity VARCHAR(30),
        solution TEXT,
        name TEXT NOT NULL
    )";

    $conn->exec($sql);
    echo "Database CVE successfully created<br>";
    
    $sql = "CREATE TABLE CVETECHNO (
        id_cve VARCHAR(30),
        id_techno INT(6) UNSIGNED,
        CONSTRAINT fk_cve_id FOREIGN KEY (id_cve) REFERENCES CVE(cve_id),
        CONSTRAINT fk_techno_id FOREIGN KEY (id_techno) REFERENCES TECHNOLOGIE(id)
    )";

    $conn->exec($sql);
    echo "Database CVETECHNO successfully created<br>";

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


$conn = null;
?>