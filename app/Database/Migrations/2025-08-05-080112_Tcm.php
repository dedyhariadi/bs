<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tcm extends Migration
{
    public function up()
    {
        // Tabel 1: jenis
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'  => ['type' => 'VARCHAR', 'constraint' => 150],
            'file' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis');

        // Tabel 2: tcm
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'jenisId'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['aktif', 'Fired', 'Eternal Patrol'], 'default' => 'aktif'],
            'partNumber' => ['type' => 'VARCHAR', 'constraint' => 100],
            'serialNumber'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jenisId', 'jenis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tcm');





        // Tabel 3: surat
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'noSurat'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'pejabat'   => ['type' => 'VARCHAR', 'constraint' => 200],
            'perihal'   => ['type' => 'TEXT'],
            'tglSurat' => ['type' => 'DATETIME', 'null' => true],
            'filePdf'   => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('surat');

        // Tabel 6: posisi
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'posisi'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis'      => ['type' => 'ENUM', 'constraint' => ['Arsenal', 'Surface Ship', 'Submarines'], 'default' => 'Arsenal'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('posisi');


        // Tabel 5: trxTcm
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'suratId'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'posisiId'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'keterangan'   => ['type' => 'TEXT'],
            'tcmId'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'giat'  => ['type' => 'ENUM', 'constraint' => ['PUT', 'PUS', 'Masuk', 'Keluar'], 'default' => 'Masuk'],
            'tglPelaksanaan' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('suratId', 'surat', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('posisiId', 'posisi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tcmId', 'tcm', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('trxTcm');
    }

    public function down()
    {
        // Drop tables in reverse order
        $this->forge->dropTable('trxTcm', true);
        $this->forge->dropTable('posisi', true);
        $this->forge->dropTable('surat', true);
        $this->forge->dropTable('tcm', true);
        $this->forge->dropTable('jenis', true);
    }
}
