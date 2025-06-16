<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use ZipStream\ZipStream;
use ZipStream\Option;


class BackUpController extends ResourceController
{


    public function backup()
    {
        $db = \Config\Database::connect();
        $tableOrder = [
            'users',
            'jenis_laporan',
            'sifat_laporan',
            'status_laporan',
            'disposisi_kepada',
            'disposisi_petunjuk',
            'surat',
            'migrations'
        ];
        $tables = $tableOrder;
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
            'download_url' => "{$folder}"        ];
    }

    return $this->respond([
        'status' => 'success',
        'log_files' => $logs
    ]);
}





        public function download($folderName)
        {
            $backupFolder = WRITEPATH . 'backups/' . $folderName;

            if (!is_dir($backupFolder)) {
                return $this->failNotFound('Folder backup tidak ditemukan.');
            }

            // Nama file ZIP yang akan muncul di browser
            $zipFileName = $folderName . '.zip';
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $zipFileName  .  '"');
            header('Pragma: no-cache');
            header('Expires: 0');

            // Inisialisasi ZipStream (langsung ke output browser)
            $zip = new ZipStream();

            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($backupFolder, \RecursiveDirectoryIterator::SKIP_DOTS)
            );

            foreach ($files as $file) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($backupFolder) + 1);

                // Tambahkan file ke zip stream (langsung dikirim)
                $zip->addFileFromPath($relativePath, $filePath);
            }

            $zip->finish(); // Penting agar file selesai dikirim
            exit;
        }

}