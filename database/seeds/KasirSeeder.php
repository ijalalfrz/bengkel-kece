<?php

use Illuminate\Database\Seeder;

class KasirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      DB::table('users')->insert([
          'name' => 'kasir',
          'email' => 'kasir@gmail.com',
          'password' => bcrypt('kasir123'),
          'role' => 'kasir',
          'foto' => '-',
          'alamat' => 'Bandung',
          'no_hp' => '087879384',
      ]);
    }
}
