<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTabelSuratMasuk extends Migration
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
            'id_user'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
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
                'null'       => false,
            ],
            'id_disposisi_petunjuk'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
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
            'tanggal_surat'       => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'lampiran'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'dibuat_oleh'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
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
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_jenis', 'jenis_laporan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_sifat', 'sifat_laporan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_status', 'status_laporan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_disposisi_kepada', 'disposisi_kepada', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_disposisi_petunjuk', 'disposisi_petunjuk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('surat_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('surat_masuk');
    }
}
