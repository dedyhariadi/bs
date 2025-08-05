<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Jenis extends Seeder
{
    public function run()
    {
        //$this->db->table('jenis')->truncate();
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
    }
}
