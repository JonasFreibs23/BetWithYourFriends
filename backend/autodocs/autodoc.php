<?php

require "../vendor/autoload.php";
require "../app/controllers/BankController.php";
require "../app/controllers/BaseController.php";
require "../app/controllers/BetController.php";
require "../app/controllers/LoginController.php";

use Sumtum\Autodoc\Builder;
use Sumtum\Autodoc\Exception;

$classes = array(
    'Doc\Controller\BankController',
    'Doc\Controller\BaseController',
    'Doc\Controller\BetController',
    'Doc\Controller\LoginController'
);

$output_dir  = __DIR__.'/';
$output_file = 'index.html'; // defaults to index.html

try {
    $builder = new Builder($classes, $output_dir, 'Bet API', '');
    $builder->generate();
} catch (Exception $e) {
    echo 'There was an error generating the documentation: ', $e->getMessage();
}
