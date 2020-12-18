<?php

$user = $sgbd->request("SELECT * FROM user WHERE email=?",array($_SESSION["user"]["email"]))[0];
$technos = $sgbd->request("SELECT * FROM technologie left join usertechnologie on  usertechnologie.id_technologie = technologie.id where usertechnologie.id_user = ?",array($_SESSION["user"]["id"]));
//echo "<div id='usertechnos' style='display:none'>".json_encode($technos) ."</div>";

$pageContent = array(
    'data' => json_encode($technos)
);