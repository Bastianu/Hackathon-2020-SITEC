<?php
$techno = null;
$clients = null;
$action = null;
$clt = null;

if(isset($_POST['cltAdd']) && isset($_POST['techno']) && isset($_POST['version'])
    && !(empty($_POST['techno']) || empty($_POST['version']))) {
    
    $clt = intval($_GET['clt']);
    $techno = htmlspecialchars($_POST['techno']);
    $version = htmlspecialchars($_POST['version']);

    $buf = $sgbd->request(
        "SELECT * FROM technologie WHERE LOWER(technoname)=LOWER(?) AND LOWER(version)=LOWER(?)",
        array($techno, $version)
    );

    if(empty($buf)) {
        $sgbd->request(
            "INSERT INTO technologie(technoname, version) VALUE (?, ?)",
            array($techno, $version),
            false
        );
        $sgbd->request(
            "INSERT INTO usertechnologie VALUE (?, ?)",
            array($clt, $sgbd->lastInsertId()),
            false
        );
    } else {
        $sgbd->request(
            "INSERT INTO usertechnologie VALUE (?, ?)",
            array($clt, $buf[0]['id']),
            false
        );
    }

    header('Refresh:0');

} else if(isset($_POST['cltEdit']) && isset($_POST['techno']) && isset($_POST['version'])
&& !(empty($_POST['cltEdit']) || empty($_POST['techno']) || empty($_POST['version']))) {
    $clt = intval($_GET['clt']);
    $tech = intval($_POST['cltEdit']);
    $techno = htmlspecialchars($_POST['techno']);
    $version = htmlspecialchars($_POST['version']);

    $buf = $sgbd->request(
        "SELECT * FROM technologie WHERE LOWER(technoname)=LOWER(?) AND LOWER(version)=LOWER(?)",
        array($techno, $version)
    );

    if(empty($buf)) {
        $sgbd->request(
            "INSERT INTO technologie(technoname, version) VALUE (?, ?)",
            array($techno, $version),
            false
        );
        $sgbd->request(
            "INSERT INTO usertechnologie VALUE (?, ?)",
            array($sgbd->lastInsertId(), $clt, $tech),
            false
        );
    } else {
        $sgbd->request(
            "UPDATE usertechnologie SET id_technologie=? WHERE id_user=? AND id_technologie=?",
            array($buf[0]['id'], $clt, $tech),
            false
        );
    }

    header('Refresh:0');
} else if(isset($_GET['clt'])) {
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