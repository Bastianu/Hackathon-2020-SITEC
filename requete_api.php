<?php
require_once "config.php";
require_once "class/SGBD.class.php";
require_once "vendor/autoload.php";

$sgbd = new SGBD(
"mysql:host=".DB_CFG['HOST'].";dbname=".DB_CFG['DB_NAME'],
DB_CFG['USER'],
DB_CFG['PASSWORD']
);

$select_technoname = $sgbd->request('SELECT technoname FROM TECHNOLOGIE');
//$insert_cve = $sgbd->request('INSERT INTO cve (cve_id, description, severity, solution, id_techno) VALUES()');
$url = 'https://services.nvd.nist.gov/rest/json/cves/1.0?cpeMatchString=cpe:2.3:*:';
$url2 = 'https://cve.circl.lu/api/cve/';
$cve_ids = array();

function callAPI($url) {
    $json = file_get_contents($url);
    $json=str_replace('}​​​​​,

    ]',"}​​​​​

    ]",$json);
    $data = json_decode($json, true);

    return $data;
}

function parser($data, $techno) {
    global $cve_ids;
    //var_dump($cve_ids);
    foreach($data as $key=>$value) {
        if(is_array($value)) {
            parser($value, $techno);
        }
        else if($key === 'ID') {
            $cve_ids[$techno][] = $value;
        }
    }
}

function getData($url) {
    $json = file_get_contents($url);
    $json = str_replace('}​​​​​,]',"}​​​​​]",$json);
    $data = json_decode($json, true);
    $result = array();
    foreach($data["capec"] as $cve) {
        array_push($result, array('name' => $cve["name"], 'desc' => $cve["summary"], 'solution' => $cve["solutions"]));
    }
    return $result;
}

//$data = callAPI($url);
//parser($data);
//print_r($cve_ids);

for($i = 0; $i < sizeof($select_technoname); $i++) {
    //echo $select_technoname[$i][0] .'<br>';
    $data = callAPI($url .$select_technoname[$i][0]);
    parser($data, $select_technoname[$i][0]);
    //var_dump($cve_ids);
    //print_r($cve_ids[$select_technoname[$i][0]]);    
}

foreach($cve_ids as $key => $value) {
    $techno_id = $sgbd->request('SELECT id FROM TECHNOLOGIE WHERE technoname = "' .$key. '"');
    //var_dump($techno_id[0][0]);
    foreach($value as $key2 => $value2) {
        var_dump(getData($url2 .$value2));
        //var_dump($value2);
        //$sgbd->request('INSERT INTO cve (cve_id) VALUES ("' . $value2 .'")',[]);
        //echo('INSERT INTO cve (cve_id) VALUES ("' . $value2 .'")');
        //$sgbd->request('INSERT INTO cvetechno (cve_id, techno_id) VALUES ("' . $value2 . '", "' . intval($techno_id[0][0]) . '")',[]);
    }    
}
//var_dump($cve_ids);



//print_r(($sgbd->request('SELECT id FROM TECHNOLOGIE WHERE technoname = "' .$cve_ids[$key]. '"')));

//echo(callAPI($url));*/
?>