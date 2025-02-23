<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create('id_ID');
        $desa = Desa::create([
            "desa"=>"Slipi",
            "alamat_kantor"=>"Jalan S Parman Kav 69",
            'kodepos' => $faker->postcode,
            'telepon' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'sejarah' => $faker->paragraph,
            'visi' => $faker->sentence,
            'misi' => $faker->sentence
        ]);
        
        foreach (range(1, 10) as $index) {
            DB::table('pendidikans')->insert([
                'nama' => $faker->name,
            ]);
            DB::table('pekerjaans')->insert([
                'nama' => $faker->name,
            ]);
        }
        foreach (range(1, 200) as $index) {
            $randomNumber = rand(1, 10);
            DB::table('penduduks')->insert([
                'nik' => $faker->unique()->numerify('################'),
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2005-12-31'),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya']),
                'status_perkawinan' => $faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
                'alamat_kantor' => $faker->address,
                'desa_id' => $desa->id,
                'pendidikan_id' => $randomNumber,
                'pekerjaan_id' => $randomNumber,
                'rt' => $faker->numerify('0#'),
                'rw' => $faker->numerify('0#'),
            ]);
        }
        DB::table('geografis')->insert([
            'luas_wilayah'=>$faker->randomFloat(2, 10, 1000),
            'batas_utara'=>$faker->name,
            'batas_selatan'=>$faker->name,
            'batas_timur'=>$faker->name,
            'batas_barat'=>$faker->name,
            'radius_kecamatan'=>$faker->randomFloat(2, 10, 1000),
            'radius_kabupaten'=>$faker->randomFloat(2, 10, 1000),
            'radius_provinsi'=>$faker->randomFloat(2, 10, 1000),
            'radius_negara'=>$faker->randomFloat(2, 10, 1000),
            'desa_id'=>$desa->id
        ]);
    }
}
