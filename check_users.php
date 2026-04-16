<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Admins:\n";
foreach(App\Models\Admin::all() as $u) echo "- {$u->email}\n";
echo "Penyelenggaras:\n";
foreach(App\Models\Penyelenggara::all() as $u) echo "- {$u->email}\n";
echo "Penggunas:\n";
foreach(App\Models\Pengguna::all() as $u) echo "- {$u->email}\n";
