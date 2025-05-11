<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelJenisLaporan extends Migration
{
    public function up()
    {
        
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_jenis_laporan'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('jenis_laporan');
    }

    public function down()
    {
        $this->forge->dropTable('jenis_laporan');
    }
}
