<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;

$mappings = [
    1 => 'synch_2026.jpg',
    2 => 'pesta_2026.jpg',
    3 => 'joyland_2026.jpg',
    4 => 'sounds_2026.jpg',
    5 => 'intim_2026.jpg',
];

foreach ($mappings as $id => $filename) {
    if ($event = Event::find($id)) {
        $event->banner = $filename;
        $event->save();
        echo "Updated Event #$id with $filename\n";
    }
}
