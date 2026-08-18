<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */


    /**
     * The console command description.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    protected $description = 'Crear respaldo de base de datos';

    /**
     * Execute the console command.
     */
public function handle()
{
    $filename = storage_path('app/backups/' . date('Y-m-d_H-i-s') . '.sql');

    if (!file_exists(storage_path('app/backups'))) {
        mkdir(storage_path('app/backups'), 0755, true);
    }

    $mysqldump = '"' . env('MYSQLDUMP_PATH') . '"';

    $command = $mysqldump .
        " -h " . env('DB_HOST') .
        " -P " . env('DB_PORT') .
        " -u " . env('DB_USERNAME') .
        " " . env('DB_DATABASE') .
        " > \"" . $filename . "\"";


    exec($command, $output, $result);


    if ($result == 0) {
        $this->info('Respaldo creado correctamente: ' . $filename);
    } else {
        $this->error('Error al crear respaldo');
        print_r($output);
    }
}
}
