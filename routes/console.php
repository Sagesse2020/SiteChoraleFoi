<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Dans routes/console.php
Artisan::command('storage:fix', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (!file_exists($link)) {
        symlink($target, $link);
        $this->info('Lien storage créé avec succès !');
    } else {
        $this->info('Le lien storage existe déjà.');
    }
})->describe('Vérifie et crée le lien storage si nécessaire.');
