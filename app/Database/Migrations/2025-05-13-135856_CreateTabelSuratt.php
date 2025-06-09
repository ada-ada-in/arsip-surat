<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelSurat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user'    => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'id_jenis'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_sifat'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_status'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_disposisi_kepada'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'id_disposisi_petunjuk'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'perihal'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nomor_surat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'nomor_agenda'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'tanggal_diterima'       => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'is_completed'       => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
                'default'    => '0',
            ],
            'lampiran'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'dari'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'tipe_surat'       => [
                'type'       => 'ENUM',
                'constraint' => ['masuk', 'keluar'],
                'null'       => false,
            ],
            'link_surat'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_jenis', 'jenis_laporan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_sifat', 'sifat_laporan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_status', 'status_laporan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_disposisi_kepada', 'disposisi_kepada', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_disposisi_petunjuk', 'disposisi_petunjuk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat');
    }

    public function down()
    {
        $this->forge->dropTable('surat');
    }
}
