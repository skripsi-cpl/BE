<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dpnas', function (Blueprint $table) {
            $table->string('file_upload')->nullable()->after('mata_kuliah');
            // Tambahkan atribut lain jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dpnas', function (Blueprint $table) {
            //
        });
    }
};
