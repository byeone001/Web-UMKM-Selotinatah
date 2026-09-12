<?php

$storagePath = getenv('LARAVEL_STORAGE_PATH')
    ?: ($_ENV['LARAVEL_STORAGE_PATH'] ?? $_SERVER['LARAVEL_STORAGE_PATH'] ?? dirname(__DIR__).'/storage');

$directories = [
    $storagePath.'/framework/views',
    $storagePath.'/framework/sessions',
    $storagePath.'/framework/cache',
    $storagePath.'/framework/cache/data',
    $storagePath.'/logs',
    $storagePath.'/app/private',
    $storagePath.'/app/public',
    '/tmp/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (! is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
}

require __DIR__.'/../public/index.php';
