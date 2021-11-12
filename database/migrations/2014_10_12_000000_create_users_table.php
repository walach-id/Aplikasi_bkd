<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('nik');
            /* ****************************************************** */
            $table->string('nidn')->nullable();
            $table->string('nidk')->nullable();
            $table->string('nup')->nullable();
            $table->string('nip')->nullable();

            $table->string('foto')->nullable();

            $table->string('nama')->nullable();
            $table->enum('jenkel', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kewarganegaraan')->nullable()->default('Indonesia');

            $table->string('program_studi_id')->nullable();
            $table->string('nohp')->nullable();
            $table->string('email')->nullable();
            $table->string('status_isi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('dosen_type')->nullable();
            $table->string('user_profile')->nullable();
            /* ****************************************************** */

            $table->integer('jenis');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
