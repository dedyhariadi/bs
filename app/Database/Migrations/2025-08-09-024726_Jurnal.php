<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jurnal extends Migration
{
    public function up()
    {
        //table 1 : giatjurnal
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'kegiatan' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                ],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'updated_at' => ['type' => 'DATETIME', 'null' => true],
            ]
        );
        $this->forge->addKey('id', true);
        $this->forge->createTable('giatjurnal', true);

        $data = [
            ['kegiatan' => 'Harian'],
            ['kegiatan' => 'Survey Tim WASS / Leonardo'],
        ];

        $this->db->table('giatjurnal')->insertBatch($data);


        // table 2 :jurnal
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
            'giatId'   => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
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
        $this->forge->addForeignKey('giatId', 'giatjurnal', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jurnal', true);
    }

    public function down()
    {
        $this->forge->dropTable('jurnal', true);
        $this->forge->dropTable('giatjurnal', true);
    }
}
