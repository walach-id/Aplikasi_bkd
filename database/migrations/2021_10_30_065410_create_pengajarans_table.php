<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajarans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('matkul_id');
            $table->string('prodi_id');
            $table->string('jenis_kegiatan');
            $table->string('bukti_penugasan');
            $table->string('sks');
            $table->string('masa_penugasan');
            $table->string('bukti_dokumen');

            $table->string('jumlah_pertemuan');
            $table->string('wewenang_dosen_id');
            $table->string('jumlah_wewenang');
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
        Schema::dropIfExists('pengajarans');
    }
}
