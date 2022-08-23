<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class perumahan_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perumahans')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'Grand Permata Tembalang',
            'address' => 'Rowosari, Kec. Tembalang, Kota Semarang'
        ]);
        DB::table('perumahans')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'name' => 'Graha Estetika',
            'address' => 'Jl.Taman Ceria No.41'
        ]);

    }
}
