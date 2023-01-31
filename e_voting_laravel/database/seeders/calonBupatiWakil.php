<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class calonBupatiWakil extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Make dummy data for calon bupati and wakil

        for ($i=0; $i < 5; $i++) { 
            $user = new User;
            $user->name = $faker->name;
            $user->username = $faker->userName;
            $user->email = $faker->email;
            $user->password = bcrypt('12345678');
            $user->visi = $faker->text;
            $user->misi = $faker->text;
            $user->deskripsi_tambahan_calon = $faker->text;
            $user->role = 'bupati';
            $user->nik = $faker->numberBetween(100000000, 999999999);
            $user->nohp = $faker->phoneNumber;
            $user->muncul_dalam_pemilihan = true;
            
            // Download fake image for photo profile
            file_put_contents(public_path("img/calon") . '/' . $user->nik . '.jpg', file_get_contents('https://picsum.photos/200'));
            $user->foto_calon_bupati_wakil = $user->nik . '.jpg';

            $user->save();
        }

        for ($i=0; $i < 5; $i++) { 
            $user = new User;
            $user->name = $faker->name;
            $user->username = $faker->userName;
            $user->email = $faker->email;
            $user->password = bcrypt('12345678');
            $user->visi = $faker->text;
            $user->misi = $faker->text;
            $user->deskripsi_tambahan_calon = $faker->text;
            $user->role = 'wakil_bupati';
            $user->nik = $faker->numberBetween(100000000, 999999999);
            $user->nohp = $faker->phoneNumber;
            $user->muncul_dalam_pemilihan = true;

            // Download fake image for photo profile
            file_put_contents(public_path("img/calon") . '/' . $user->nik . '.jpg', file_get_contents('https://picsum.photos/200'));
            $user->foto_calon_bupati_wakil = $user->nik . '.jpg';

            $user->save();
        }

    }
}
