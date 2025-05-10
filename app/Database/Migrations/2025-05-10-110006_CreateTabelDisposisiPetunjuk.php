<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelDisposisiPetunjuk extends Migration
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
            'nama_disposisi_petunjuk'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
        ]);

        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('disposisi_petunjuk');
    }

    public function down()
    {
        $this->forge->dropTable('disposisi_petunjuk');
    }
}
