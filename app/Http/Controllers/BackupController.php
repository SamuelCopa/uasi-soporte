<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function backup()
{
    $filename = env('DB_DATABASE') . '-' . now()->format('Y-m-d-H-i-s') . '.sql';

    // Ruta segura y portable
    $backupPath = storage_path('app/backups');

    if (!file_exists($backupPath)) {
        mkdir($backupPath, 0755, true);
    }

    $path = $backupPath . '/' . $filename;

    $command = sprintf(
        '%s --user=%s --password=%s --host=%s %s > %s',
        env('MYSQLDUMP_PATH', 'mysqldump'),
        escapeshellarg(env('DB_USERNAME')),
        escapeshellarg(env('DB_PASSWORD')),
        escapeshellarg(env('DB_HOST')),
        escapeshellarg(env('DB_DATABASE')),
        escapeshellarg($path)
    );

    $output = [];
    $result = null;

    exec($command, $output, $result);

    return response()->download($path)->deleteFileAfterSend(true);
}


    public function backupSuccess()
{
    return redirect()->back()
    ->with('success', '¡Éxito!')         
    ->with('text', 'Backup generado con éxito')         
    ->with('icono', 'success');
}

}
