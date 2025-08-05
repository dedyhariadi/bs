<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kas extends Migration
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
    }

    public function down()
    {
        $this->forge->dropTable('kas', true);
    }
}
