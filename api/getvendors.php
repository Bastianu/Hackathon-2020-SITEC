<?php

define("ROOT", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("MODEL", ROOT."model".DIRECTORY_SEPARATOR);

/* ----------------------------- Files includes ----------------------------- */
require_once "../config.php";
require_once "../class/SGBD.class.php";
require_once "../vendor/autoload.php";
/*
$sgbd = new SGBD(
    "mysql:host=".DB_CFG['HOST'].";dbname=".DB_CFG['DB_NAME'],
    DB_CFG['USER'],
    DB_CFG['PASSWORD']
);
*/

$json_url = "https://cve.circl.lu/api/browse";
$json = file_get_contents($json_url);
$json=str_replace('},
]',"}
]",$json);
$data = json_decode($json, true);

echo json_encode($data["vendor"]);



?>