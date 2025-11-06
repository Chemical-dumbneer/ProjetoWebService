<?php
error_reporting(E_COMPILE_ERROR | E_ERROR | E_PARSE | E_CORE_ERROR | E_USER_ERROR);
ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../src/routes/routes.php";
require_once __DIR__ . '/../bootstrap.php';

use Pecee\SimpleRouter\SimpleRouter;
use enum\TipoUsuario;

$rotasPublicas = ['/login', '/logout'];
$currentUrl = $_SERVER['REQUEST_URI'];
if (!isset($_SESSION['logado']) && !in_array($currentUrl, $rotasPublicas)) {
    SimpleRouter::response()->redirect('/login');
    exit;
}

if (isset($_SESSION['logado']) && $currentUrl === '/login') {
    SimpleRouter::response()->redirect('/home');
}

if((isset($_SESSION['logado']) && ($_SESSION['tipoUsuario'] === TipoUsuario::Usuario)) && (($currentUrl === '/user/new') ||($currentUrl === '/user/listar')))  {
     SimpleRouter::response()->redirect('/home');
}

SimpleRouter::start();

?>