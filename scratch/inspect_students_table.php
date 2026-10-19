<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

print_r(\Illuminate\Support\Facades\Schema::getColumnListing('students'));
$s = \Illuminate\Support\Facades\DB::table('students')->first();
print_r($s);
