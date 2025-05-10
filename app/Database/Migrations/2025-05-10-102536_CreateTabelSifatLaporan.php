<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelSifatLaporan extends Migration
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
            'nama_sifat_laporan'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
        ]);

        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sifat_laporan');
    }

    public function down()
    {
        $this->forge->dropTable('sifat_laporan');
    }
}
