<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSparepartTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'partNumber' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'serialNumber' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
                'null' => true,
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'tersedia',
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('sparepart');
    }

    public function down()
    {
        $this->forge->dropTable('sparepart');
    }
}
