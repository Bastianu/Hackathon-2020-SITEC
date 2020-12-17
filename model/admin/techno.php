<?php
$techno = null;
$clients = null;
$action = null;
$clt = null;

if(isset($_GET['clt'])) {
    $clt = intval($_GET['clt']);

    if(isset($_GET['del']) && !empty($_GET['del'])){
        if($_SESSION['user']['rol'] != 'administrateur')
            header("Location: index.php?p=logout");

        echo "Salut";
        
        $sgbd->request(
            "DELETE FROM usertechnologie WHERE id_technologie=? AND id_user = ?",
            array(intval($_GET['del']), intval($clt)),
            false
        );

        header("Location: index.php?p=techno&clt=".$clt);
    }

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