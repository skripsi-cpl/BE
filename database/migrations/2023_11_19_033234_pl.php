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
        Schema::create('pl', function (Blueprint $table) {
            $table->integer('id_pl')->primary();
            $table->string('nama_pl',100);
            $table->decimal('bobot_pl',4,2 );
            
            // Tambahkan foreign key jika diperlukan
            // $table->foreign('nama_pl')->references('kolom_referensi')->on('tabel_referensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pl');
    }
};
