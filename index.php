<?php
// Starting sessions
session_start();

//initializing errors
ini_set('display_errors', '1');

/* -------------------------- Constants definitions ------------------------- */
define("ROOT", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("MODEL", ROOT."model".DIRECTORY_SEPARATOR);

/* ----------------------------- Files includes ----------------------------- */
require_once ROOT."config.php";
require_once ROOT."class/SGBD.class.php";
require_once ROOT."vendor/autoload.php";

$sgbd = new SGBD(
    "mysql:host=".DB_CFG['HOST'].";dbname=".DB_CFG['DB_NAME'],
    DB_CFG['USER'],
    DB_CFG['PASSWORD']
);

/* --------------------------- Twig initialization -------------------------- */
$loader = new \Twig\Loader\FilesystemLoader("page");
$twig = new \Twig\Environment($loader, TWIG_CFG['dev']);

/* -------------------------------------------------------------------------- */
/*                                   Routeur                                  */
/* -------------------------------------------------------------------------- */

$pageContent = array();

if(isset($_GET['p']) && !empty($_GET['p']))
    $page = htmlspecialchars($_GET['p']);
else
    $page = 'login';

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    if($page === 'logout') {
        session_destroy();
        header('Refresh:0');
    } else {
        $template = $twig->load("accueil.twig");
    }
} else {
    require_once MODEL."login.php";
    $template = $twig->load("login.twig");
}

echo $template->render($pageContent);