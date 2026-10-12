<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== National Works ===\n";
foreach (App\model\NationalWork::all() as $item) {
    print_r($item->getAttributes());
}

echo "\n=== International Works ===\n";
foreach (App\model\InternationalWork::all() as $item) {
    print_r($item->getAttributes());
}

echo "\n=== Local Projects ===\n";
foreach (App\model\LocalProject::all() as $item) {
    print_r($item->getAttributes());
}
