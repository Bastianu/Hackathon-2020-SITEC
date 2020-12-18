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

$json_url = "https://cve.circl.lu/api/last";
$json = file_get_contents($json_url);
$json=str_replace('},
]',"}
]",$json);
$data = json_decode($json, true);


$result = array();
foreach($data as $d){
    if(isset($d["capec"])){
        foreach($d["capec"] as $cve){
            array_push($result, array('cve'=> $cve["id"], 'name' => $cve["name"], 'desc' => $cve["summary"], 'solution' => $cve["solutions"]));
        }
    }

    //array_push($result, $cve["capec"][0]["summary"]);
}
echo json_encode($result);

/*
echo $data[0]["capec"][0]["solutions"];
echo "<br>";
echo $data[0]["capec"][0]["summary"];
*/




?>