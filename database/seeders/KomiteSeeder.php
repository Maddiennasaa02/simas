// database/seeders/KomiteSeeder.php
<?php
namespace Database\Seeders;

use App\Models\Komite;
use Illuminate\Database\Seeder;

class KomiteSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['urutan'=>1, 'nama'=>'Nama Ketua',          'jabatan'=>'Ketua',                'unsur'=>'Orang Tua Siswa',     'telepon'=>null],
            ['urutan'=>2, 'nama'=>'Nama Wakil',          'jabatan'=>'Wakil Ketua',          'unsur'=>'Orang Tua Siswa',     'telepon'=>null],
            ['urutan'=>3, 'nama'=>'Nama Sekretaris I',   'jabatan'=>'Sekretaris I',         'unsur'=>'Orang Tua Siswa',     'telepon'=>null],
            ['urutan'=>4, 'nama'=>'Nama Sekretaris II',  'jabatan'=>'Sekretaris II',        'unsur'=>'Tokoh Masyarakat',    'telepon'=>null],
            ['urutan'=>5, 'nama'=>'Nama Bendahara I',    'jabatan'=>'Bendahara I',          'unsur'=>'Orang Tua Siswa',     'telepon'=>null],
            ['urutan'=>6, 'nama'=>'Nama Bendahara II',   'jabatan'=>'Bendahara II',         'unsur'=>'Orang Tua Siswa',     'telepon'=>null],
            ['urutan'=>7, 'nama'=>'Nama Anggota 1',      'jabatan'=>'Anggota Bid. Akademik','unsur'=>'Orang Tua Siswa',     'telepon'=>null],
            ['urutan'=>8, 'nama'=>'Nama Anggota 2',      'jabatan'=>'Anggota Bid. Sarana',  'unsur'=>'Tokoh Masyarakat',    'telepon'=>null],
            ['urutan'=>9, 'nama'=>'Nama Anggota 3',      'jabatan'=>'Anggota Bid. Humas',   'unsur'=>'Alumni / Masyarakat', 'telepon'=>null],
        ];

        foreach ($data as $d) {
            Komite::create($d);
        }
    }
}