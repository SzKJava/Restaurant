<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuitemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $sql = file_get_contents( __DIR__ . "/menuitem.sql" );

        DB::unprepared( $sql );
    }
}
