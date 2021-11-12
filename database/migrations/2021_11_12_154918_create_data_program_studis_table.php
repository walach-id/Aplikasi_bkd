<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataProgramStudisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_program_studis', function (Blueprint $table) {
            $table->id();
            $table->string('program_studi');
            $table->string('ketua_prodi');
            $table->string('ses_prodi');
            $table->string('ttd_kp');
            $table->string('ttd_kr');
            $table->string('kode_pt');
            $table->char('kode_jen', 1);
            $table->string('jabatan_kadep');
            $table->string('jabatan_koor');
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
        Schema::dropIfExists('data_program_studis');
    }
}
