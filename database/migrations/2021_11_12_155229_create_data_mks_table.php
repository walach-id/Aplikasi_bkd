<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mk');
            $table->string('id_prodi');
            $table->string('kat_matkul');
            $table->string('thn_akademik');
            $table->enum('periode_akademik', ['ganjil', 'genap']);
            $table->integer('semester');
            $table->integer('jml_sks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_mks');
    }
}
