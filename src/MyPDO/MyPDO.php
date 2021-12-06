<?php declare(strict_types=1);

use App\MyPDO\template\MyPDO;

require_once "template/MyPDO.php";

MyPDO::setConfiguration('mysql:host=localhost;dbname=movies;charset=utf8', 'Notgard');
