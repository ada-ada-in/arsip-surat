<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;

class BackUpController extends ResourceController
{
    public function bakcup()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $sql = "";

        foreach ($tables as $table) {
            // Struktur tabel
            $query = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();
            $sql .= "\n\n" . $query['Create Table'] . ";\n\n";

            // Data isi tabel
            $builder = $db->table($table);
            $data = $builder->get()->getResultArray();

            foreach ($data as $row) {
                $columns = array_map(function($col) {
                    return "`$col`";
                }, array_keys($row));

                $values = array_map(function($val) use ($db) {
                    if (is_null($val)) {
                        return "NULL";
                    } else {
                        return "'" . $db->escapeString((string) $val) . "'";
                    }
                }, array_values($row));

                $sql .= "INSERT INTO `$table` (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ");\n";
            }
        }

        // Simpan ke file
        $filename = WRITEPATH . 'backups/backup_arsip_db' . date('Ymd_His') . '.sql';
        file_put_contents($filename, $sql);

        return $this->respond([
            'status' => 'success',
            'message' => 'Backup berhasil tanpa mysqldump.',
            'file' => $filename
        ]);
    }


    public function listBackups()
    {
        $backupPath = WRITEPATH . 'backups/';
        $files = scandir($backupPath);

        $logs = [];

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
                $fullPath = $backupPath . $file;

                $logs[] = [
                    'filename' => $file,
                    'size_kb'  => round(filesize($fullPath) / 1024, 2),
                    'created_at' => date('Y-m-d H:i:s', filemtime($fullPath)),
                    'download_url' => "{$file}"
                ];
            }
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
