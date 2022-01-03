<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajaranHonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajaran_honors', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengajaran_honor');

            $table->string('prodi_id');
            $table->string('matkul_id');
            $table->string('sks');
            $table->string('akademik_tahun');
            $table->string('jum_kelas');
            $table->string('jum_mengajar');
            $table->string('tipe_mengajar');

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
        Schema::dropIfExists('pengajaran_honors');
    }
}
