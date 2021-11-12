<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajaranPddiktisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajaran_pddiktis', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama_dosen');
            $table->string('prodi_id');
            $table->string('matkul_id');
            $table->string('sks');
            $table->string('semester');
            $table->string('jum_kelas');
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
        Schema::dropIfExists('pengajaran_pddiktis');
    }
}
