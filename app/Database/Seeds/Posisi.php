<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Posisi extends Seeder
{
    public function run()
    {
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
    }
}
