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
        Schema::table('file_upload', function (Blueprint $table) {
            $table->timestamps(); // Ini akan menambahkan updated_at dan created_at
        });
    }
    
    public function down()
    {
        Schema::table('file_upload', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
    
};
