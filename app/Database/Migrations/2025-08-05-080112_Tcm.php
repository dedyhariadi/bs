<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tcm extends Migration
{
    public function up()
    {
        // Hapus tabel kas karena tidak relevan dengan inventaris TCM

        // Tabel 1: jenis
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'      => ['type' => 'VARCHAR', 'constraint' => 150],
            'file'      => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jenis');

        // Kurangi data dummy: hanya 3 record sebagai contoh
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
                'nama' => 'Mobile Acoustic Jammer',
                'file' => 'tcm4.pdf',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('jenis')->insertBatch($data);

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
        $this->forge->addForeignKey('jenisId', 'jenis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tcm');

        // Kurangi data dummy: hanya 3 record
        $this->db->table('tcm')->insertBatch([
            [
                'jenisId' => 1,
                'status' => 'Aktif',
                'partNumber' => '5845-9841-0020',
                'serialNumber' => '000001',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'jenisId' => 1,
                'status' => 'Aktif',
                'partNumber' => '5845-9841-0020',
                'serialNumber' => '000002',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'jenisId' => 2,
                'status' => 'Fired',
                'partNumber' => '5845-9841-0030',
                'serialNumber' => '000003',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

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

        // Kurangi data dummy: hanya 2 record
        $data = [
            [
                'jenisGiat' => 'Barang Masuk',
                'suratId' => 1,
                'transferDariId' => 1,
                'transferKeId' => 2,
                'tglPelaksanaan' => '2023-10-13 00:00:00',
                'keterangan' => 'Kegiatan penerimaan barang masuk dari Arsenal Gd. 05 ke Arsenal Gd. 91',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'jenisGiat' => 'Barang Keluar',
                'suratId' => 2,
                'transferDariId' => 2,
                'transferKeId' => 3,
                'tglPelaksanaan' => '2023-10-15 00:00:00',
                'keterangan' => 'Kegiatan pengeluaran barang dari Arsenal Gd. 91 ke KRI REM-331',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        // Insert data into the kegiatan table
        $this->db->table('kegiatan')->insertBatch($data);

        // Tabel 6: trxTcm
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kegiatanId' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tcmId'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'posisiId'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kegiatanId', 'kegiatan', 'id', 'CASCADE', 'CASCADE', 'trxtcm_kegiatanId_foreign');
        $this->forge->addForeignKey('tcmId', 'tcm', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('posisiId', 'satkai', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('trxTcm');

        // Kurangi data dummy: hanya 3 record
        $data = [
            [
                'kegiatanId' => 1,
                'tcmId' => 1,
                'posisiId' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatanId' => 1,
                'tcmId' => 2,
                'posisiId' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'kegiatanId' => 2,
                'tcmId' => 3,
                'posisiId' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        // Insert data into the trxTcm table
        $this->db->table('trxtcm')->insertBatch($data);
    }

    public function down()
    {
        // Drop tables in reverse order (foreign keys will be dropped automatically with true)
        $this->forge->dropTable('trxTcm', true);
        $this->forge->dropTable('kegiatan', true);
        $this->forge->dropTable('satkai', true);
        $this->forge->dropTable('surat', true);
        $this->forge->dropTable('tcm', true);
        $this->forge->dropTable('jenis', true);
    }
}
