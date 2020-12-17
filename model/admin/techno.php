<?php
$techno = null;
$clients = null;

if(isset($_GET['clt'])) {
    $clt = intval($_GET['clt']);
    $clt = $sgbd->request("SELECT id, lastname, firstname FROM user WHERE id=?",
        array($clt))[0];

    $techno = $sgbd->request(
        "SELECT tech.* FROM usertechnologie utech
        INNER JOIN technologie tech ON tech.id = utech.id_technologie
        WHERE utech.id_user = ?",
        array($clt['id'])
    );
} else
    $clients = $sgbd->request("SELECT * FROM user WHERE rol != 'administrateur'");

$pageContent = array(
    'clts' => $clients,
    'clt' => $clt,
    'techno' => $techno
);