<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FixStorageLink extends Command
{
    protected $signature = 'storage:fix';
    protected $description = 'Vérifie et recrée le lien storage si nécessaire';

    public function handle()
    {
        $link = public_path('storage');
        $target = storage_path('app/public');

        if (File::exists($link)) {
            $this->info('Le lien storage existe déjà ✅');
        } else {
            $this->info('Lien storage manquant, création en cours...');
            try {
                symlink($target, $link);
                $this->info('Lien storage créé avec succès ! 🎉');
            } catch (\Exception $e) {
                $this->error('Erreur lors de la création du lien : ' . $e->getMessage());
            }
        }
    }
}
