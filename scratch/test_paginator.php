<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$p = new Illuminate\Pagination\LengthAwarePaginator([1,2,3], 20, 10, 1);
echo $p->links();
