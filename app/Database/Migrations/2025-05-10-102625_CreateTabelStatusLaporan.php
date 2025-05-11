<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelStatusLaporan extends Migration
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
            'nama_status_laporan'    => [
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
        $this->forge->createTable('status_laporan');
    }

    public function down()
    {
        $this->forge->dropTable('status_laporan');
    }
}
