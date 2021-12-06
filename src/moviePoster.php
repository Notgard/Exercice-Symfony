<?php
declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

$id = isset($_GET["id"]) ? $_GET["id"] + 0: null;

(new Dotenv())->load(__DIR__.'/../.env');

$kernel = new Kernel('dev', true);
$kernel->boot();

$poster = $kernel->getContainer()
    ->get('doctrine.orm.entity_manager')
    ->getRepository('App\Entity\Image')
    ->find($id);
var_dump($poster->getContenu());
