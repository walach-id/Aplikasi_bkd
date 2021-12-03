<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlihAjarPddiktiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alih_ajar_pddikti', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->text('nama_dosen');
            $table->string('prodi_id');
            $table->string('matkul_id');

            $table->integer('sks', 11);
            $table->string('akademik_tahun');


            $table->integer('jum_kelas', 11);
            $table->string('dosen_alih');
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
        Schema::dropIfExists('alih_ajar_pddikti');
    }
}
