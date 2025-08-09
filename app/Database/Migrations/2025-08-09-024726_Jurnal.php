<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jurnal extends Migration
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
            'tanggal' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'harian',
            ],
            'kegiatan' => [
                'type' => 'text',
                'null' => true,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('jurnal', true);
    }

    public function down()
    {
        $this->forge->dropTable('jurnal', true);
    }
}
