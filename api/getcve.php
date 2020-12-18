<?php

define("ROOT", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("MODEL", ROOT."model".DIRECTORY_SEPARATOR);

/* ----------------------------- Files includes ----------------------------- */
require_once "../config.php";
require_once "../class/SGBD.class.php";
require_once "../vendor/autoload.php";

$sgbd = new SGBD(
    "mysql:host=".DB_CFG['HOST'].";dbname=".DB_CFG['DB_NAME'],
    DB_CFG['USER'],
    DB_CFG['PASSWORD']
);

if(isset($_GET["code"])){

    $code = $_GET["code"];
    echo json_encode(get_cve($sgbd, $code));
}
else{
    echo json_encode(array());
}

function get_cve($con, $code){
    $sql = $con->request("SELECT * FROM cve WHERE cve_id =?",array($code));
    $result = array();
    foreach($sql as $cve){
        array_push($result, array('code' => $cve["cve_id"], 'severity' =>$cve["severity"], 'desc' => $cve["description"], 'solutions' => $cve["solution"])); //++impact
    }
    return ($result);
}


?>