<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tcm extends Migration
{
    public function up()
    {
        // tabel kas
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'pemasukan' => [
                'type' => 'int',
                'constraint' => '11',
                'null' => true,
            ],
            'pengeluaran' => [
                'type' => 'DECIMAL',
                'constraint' => '11',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('kas');


        // TCM
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

        $data = [
            [
                'nama' => 'Zoka Sed Jammer',
                'file' => 'tcm.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Mechanical Adaptor',
                'file' => 'tcm2.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Zoka Sed Exercise',
                'file' => 'tcm5.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Mobile Acoustic Jammer',
                'file' => 'tcm4.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'nama' => 'Mobile Acoustic Decoy',
                'file' => 'tcm8.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Low Sinking Acoustic Jammer',
                'file' => 'tcm10.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Low Sinking Acoustic Decoy',
                'file' => 'tcm11.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],


        ];

        // Insert data into the jenis table
        $this->db->table('jenis')->insertBatch($data);



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

        // Tabel 4: posisi
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'posisi'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'jenis'      => ['type' => 'ENUM', 'constraint' => ['Arsenal', 'Surface Ship', 'Submarines'], 'default' => 'Arsenal'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('posisi');

        $data = [
            [
                'posisi' => 'Arsenal Gd. 05',
                'jenis' => 'Arsenal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'Arsenal Gd. 91',
                'jenis' => 'Arsenal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'KRI REM-331',
                'jenis' => 'Surface Ship',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'KRI SIM-367',
                'jenis' => 'Surface Ship',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'KRI Cakra-401',
                'jenis' => 'Submarines',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'KRI Nanggala-402',
                'jenis' => 'Submarines',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'KRI Nagapasa-403',
                'jenis' => 'Submarines',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'KRI Ardadedali-404',
                'jenis' => 'Submarines',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'posisi' => 'KRI Alugoro-405',
                'jenis' => 'Submarines',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ];

        // Insert data into the posisi table
        $this->db->table('posisi')->insertBatch($data);




        // Tabel 5: Kegiatan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'jenisGiat' => ['type' => 'ENUM', 'constraint' => ['Barang Masuk', 'Barang Keluar', 'PUT', 'PUS'], 'default' => 'Barang Masuk'],
            'suratId' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'posisiId' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tglPelaksanaan' => ['type' => 'DATETIME', 'null' => true],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('suratId', 'surat', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('posisiId', 'posisi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kegiatan');

        // Tabel 6: trxTcm
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kegiatanId'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tcmId'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kegiatanId', 'kegiatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tcmId', 'tcm', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('trxTcm');
    }

    public function down()
    {
        // Drop tables in reverse order
        $this->forge->dropTable('trxTcm', true);
        $this->forge->dropTable('kegiatan', true);
        $this->forge->dropTable('posisi', true);
        $this->forge->dropTable('surat', true);
        $this->forge->dropTable('tcm', true);
        $this->forge->dropTable('jenis', true);
        $this->forge->dropTable('kas', true);
    }
}
