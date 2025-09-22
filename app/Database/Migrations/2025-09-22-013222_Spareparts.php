<?php
// filepath: app/Database/Migrations/20240922000000_create_sparepart_table.php
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spareparts extends Migration
{
    public function up()
    {
        // Buat table spareparts
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'partNumber' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'serialNumber' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'jenisId' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['OK', 'NOT OK', 'Rusak'],
                'default' => 'OK',
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
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
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('jenisId', 'jenisSparepart', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sparepart');

        // Buat table trxSparepart
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kegiatanId' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'sparepartId' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'posisiId' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'kondisi' => [
                'type' => 'ENUM',
                'constraint' => ['OK', 'NOT OK', 'Rusak'],
                'default' => 'OK',
            ],
            'jenisTransaksi' => [
                'type' => 'ENUM',
                'constraint' => ['Masuk', 'Keluar', 'Pindah'],
                'default' => 'Masuk',
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
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sparepartId', 'sparepart', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('posisiId', 'satkai', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('trxSparepart');
    }

    public function down()
    {
        $this->forge->dropTable('trxSparepart');
        $this->forge->dropTable('sparepart');
    }
}