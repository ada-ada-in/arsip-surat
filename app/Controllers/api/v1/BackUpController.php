<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class BackUpController extends ResourceController
{
    // public function backup()
    // {
    //     $db = \Config\Database::connect();
    //     $tables = $db->listTables();
    //     $sql = "";

    //     foreach ($tables as $table) {
    //         // Struktur tabel
    //         $query = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();
    //         $sql .= "\n\n" . $query['Create Table'] . ";\n\n";

    //         // Data isi tabel
    //         $builder = $db->table($table);
    //         $data = $builder->get()->getResultArray();

    //         foreach ($data as $row) {
    //             $columns = array_map(function($col) {
    //                 return "`$col`";
    //             }, array_keys($row));

    //             $values = array_map(function($val) use ($db) {
    //                 if (is_null($val)) {
    //                     return "NULL";
    //                 } else {
    //                     return "'" . $db->escapeString((string) $val) . "'";
    //                 }
    //             }, array_values($row));

    //             $sql .= "INSERT INTO `$table` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n";
    //         }
    //     }

    //     // Simpan ke file
    //     $filename = WRITEPATH . 'backups/backup_arsip_db' . date('Ymd_His') . '.sql';
    //     file_put_contents($filename, $sql);

    //     return $this->respond([
    //         'status' => 'success',
    //         'message' => 'Backup berhasil tanpa mysqldump.',
    //         'file' => $filename
    //     ]);
    // }


    public function backup()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $sql = "";

        // Buat folder backup berdasarkan waktu
        $timestamp = date('Ymd_His');
        $backupFolder = WRITEPATH . "backups/backup_arsip_{$timestamp}/";
        if (!is_dir($backupFolder)) {
            mkdir($backupFolder, 0777, true);
        }

        // Backup struktur dan isi database
        foreach ($tables as $table) {
            $query = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();
            $sql .= "\n\n" . $query['Create Table'] . ";\n\n";

            $builder = $db->table($table);
            $data = $builder->get()->getResultArray();

            foreach ($data as $row) {
                $columns = array_map(fn($col) => "`$col`", array_keys($row));
                $values = array_map(function($val) use ($db) {
                    return is_null($val) ? "NULL" : "'" . $db->escapeString((string) $val) . "'";
                }, array_values($row));

                $sql .= "INSERT INTO `$table` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n";
            }
        }

        // Simpan file SQL ke dalam folder backup
        $sqlFile = $backupFolder . "backup_arsip_db.sql";
        file_put_contents($sqlFile, $sql);

        // Salin folder surat (dan isi) ke folder backup
        $sourceFolder = FCPATH . 'uploads/surat/';
        $targetFolder = $backupFolder . 'surat/';

        $this->recursiveCopy($sourceFolder, $targetFolder);

        return $this->respond([
            'status' => 'success',
            'message' => 'Backup database dan file surat berhasil.',
            'folder_backup' => $backupFolder,
            'file_sql' => $sqlFile
        ]);
    }


    private function recursiveCopy($src, $dst)
    {
        if (!is_dir($src)) return;

        @mkdir($dst, 0777, true);
        $files = scandir($src);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;

            $srcFile = $src . '/' . $file;
            $dstFile = $dst . '/' . $file;

            if (is_dir($srcFile)) {
                $this->recursiveCopy($srcFile, $dstFile);
            } else {
                copy($srcFile, $dstFile);
            }
        }
    }



   public function listBackups()
{
    $backupRoot = WRITEPATH . 'backups/';
    $folders = scandir($backupRoot);
    $logs = [];

    foreach ($folders as $folder) {
        $folderPath = $backupRoot . $folder;

        // Hanya proses folder backup
        if ($folder === '.' || $folder === '..' || !is_dir($folderPath)) {
            continue;
        }

        $sqlFile = $folderPath . '/backup_arsip_db.sql';

        $sqlSize = file_exists($sqlFile) ? round(filesize($sqlFile) / 1024, 2) : 0;

        $logs[] = [
            'folder'       => $folder,
            'sql_file'     => 'backup_arsip_db.sql',
            'size_kb'      => $sqlSize,
            'created_at'   => date('Y-m-d H:i:s', filemtime($folderPath)),
            'download_url' => "backup/{$folder}/backup_arsip_db.sql"
        ];
    }

    return $this->respond([
        'status' => 'success',
        'log_files' => $logs
    ]);
}



    public function download($filename)
        {
            $path = WRITEPATH . 'backups/' . $filename;

            if (!file_exists($path)) {
                return $this->failNotFound('File not found.');
            }

            if (!str_ends_with($filename, '.sql')) {
                $filename .= '.sql';
            }
            

            return $this->response
                ->download($path, null)
                ->setFileName($filename);
        }




}