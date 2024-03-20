<?php

namespace App\app;

define('ROOT_DIR', __DIR__);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/loader.php';

$app = Loader::init();
