<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();

            $table->string('nidn');
            $table->string('nidk');
            $table->string('nup');

            $table->string('foto');

            $table->string('nama');
            $table->enum('jenkel', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('kewarganegaraan')->default("Indonesia");

            $table->string('program_studi_id');
            $table->string('nohp');
            $table->string('email');
            $table->string('status_isi');
            $table->string('jabatan');
            $table->string('dosen_type');
            $table->string('user_profile');

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
        Schema::dropIfExists('profils');
    }
}
