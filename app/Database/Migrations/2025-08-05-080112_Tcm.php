<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tcm extends Migration
{
    public function up()
    {


        // Tabel 1: jenisTcm
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'      => ['type' => 'VARCHAR', 'constraint' => 150],
            'file'      => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenistcm');



        // Tabel 2: tcm
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'jenisId'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['Aktif', 'Fired', 'Eternal Patrol'], 'default' => 'Aktif'],
            'partNumber'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'serialNumber' => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jenisId', 'jenistcm', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tcm');



        // Tabel 3: surat
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'noSurat'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'pejabat'   => ['type' => 'VARCHAR', 'constraint' => 200],
            'perihal'   => ['type' => 'TEXT'],
            'tglSurat'  => ['type' => 'DATETIME', 'null' => true],
            'filePdf'   => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('surat');

        // Kurangi data dummy: hanya 2 record
        $data = [
            [
                'noSurat' => 'Sprin/70/I/2021',
                'pejabat' => 'Kadissenlekal',
                'perihal' => 'Surat Perintah PMB',
                'tglSurat' => '2021-12-20 00:00:00',
                'filePdf' => 'surat1.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'noSurat' => 'Sprin/67/X/2023',
                'pejabat' => 'Kadissenlekal',
                'perihal' => 'Surat Perintah Transfer',
                'tglSurat' => '2023-10-13 00:00:00',
                'filePdf' => 'surat2.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        // Insert data into the surat table
        $this->db->table('surat')->insertBatch($data);

        // Tabel 4: satkai
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'satkai'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis'     => ['type' => 'ENUM', 'constraint' => ['Arsenal', 'Surface Ship', 'Submarines'], 'default' => 'Arsenal'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('satkai');

        // Kurangi data dummy: hanya 3 record
        $data = [
            [
                'satkai' => 'Arsenal Gd. 05',
                'jenis' => 'Arsenal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'satkai' => 'Arsenal Gd. 91',
                'jenis' => 'Arsenal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'satkai' => 'KRI REM-331',
                'jenis' => 'Surface Ship',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data into the satkai table
        $this->db->table('satkai')->insertBatch($data);

        // Tabel 5: Kegiatan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'jenisGiat' => ['type' => 'ENUM', 'constraint' => ['Barang Masuk', 'Barang Keluar', 'PUT', 'PUS'], 'default' => 'Barang Masuk'],
            'suratId' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'transferDariId' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'transferKeId' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tglPelaksanaan' => ['type' => 'DATETIME', 'null' => true],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('suratId', 'surat', 'id', 'CASCADE', 'CASCADE');
        // Tambah foreign key untuk transferDariId dan transferKeId ke satkai
        $this->forge->addForeignKey('transferDariId', 'satkai', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('transferKeId', 'satkai', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kegiatan');



        // Tabel 6: trxTcm
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kegiatanId' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tcmId'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'posisiId'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'kondisi'   => ['type' => 'ENUM', 'constraint' => ['OK', 'Not OK'], 'default' => 'OK', 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kegiatanId', 'kegiatan', 'id', 'CASCADE', 'CASCADE', 'trxtcm_kegiatanId_foreign');
        $this->forge->addForeignKey('tcmId', 'tcm', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('posisiId', 'satkai', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('trxTcm');
    }

    public function down()
    {
        // Drop tables in reverse order (foreign keys will be dropped automatically with true)
        $this->forge->dropTable('trxTcm', true);
        $this->forge->dropTable('kegiatan', true);
        $this->forge->dropTable('satkai', true);
        $this->forge->dropTable('surat', true);
        $this->forge->dropTable('tcm', true);
        $this->forge->dropTable('jenisTcm', true);
    }
}
