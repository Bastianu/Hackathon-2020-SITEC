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
require_once ROOT."vendor/autoload.php";

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

if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {}
else {
    require_once MODEL."login.php";
    $template = $twig->load("login.twig");
}

echo $template->render($pageContent);