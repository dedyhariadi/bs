<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TcmSeeder extends Seeder
{
    public function run()
    {
        // Data dummy untuk tabel jenis
        $dataJenis = [
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
        $this->db->table('jenis')->insertBatch($dataJenis);

        // Data dummy untuk tabel tcm (pastikan jenisId sesuai dengan data jenis di atas)
        $dataTcm = [
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
        ];
        $this->db->table('tcm')->insertBatch($dataTcm);

        // Data dummy untuk tabel surat
        $dataSurat = [
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
        $this->db->table('surat')->insertBatch($dataSurat);

        // Data dummy untuk tabel satkai
        $dataSatkai = [
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
        $this->db->table('satkai')->insertBatch($dataSatkai);

        // Data dummy untuk tabel kegiatan (pastikan suratId dan transferId sesuai dengan data di atas)
        $dataKegiatan = [
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
        $this->db->table('kegiatan')->insertBatch($dataKegiatan);

        // Data dummy untuk tabel trxTcm (pastikan kegiatanId, tcmId, posisiId sesuai dengan data di atas)
        $dataTrxTcm = [
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
        $this->db->table('trxTcm')->insertBatch($dataTrxTcm);
    }
}
