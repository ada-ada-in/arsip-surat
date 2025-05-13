<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelDisposisiKepada extends Migration
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
            'nama_kordinator'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nip'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nama_disposisi_kepada'    => [
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
        $this->forge->createTable('disposisi_kepada');
    }

    public function down()
    {
        $this->forge->dropTable('disposisi_kepada');
    }
}
