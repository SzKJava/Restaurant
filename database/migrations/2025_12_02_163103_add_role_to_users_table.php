<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->enum( "role", [ "super", "admin", "user" ] )->after( "password" )->default( "user" );
            $table->timestamp( "banningtime" )->after( "role" )->nullable();
            $table->integer( "logincounter" )->after( "banningtime" )->default( 0 );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
