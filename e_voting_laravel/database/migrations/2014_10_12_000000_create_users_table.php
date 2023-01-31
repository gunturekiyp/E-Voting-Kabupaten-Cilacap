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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->enum('role', ['admin', 'user', 'bupati', 'wakil_bupati'])->default('user');
            $table->string('nohp')->unique();
            $table->string('nik')->unique();
            $table->string('visi')->nullable() -> comment("Khusus untuk role bupati dan wakil");
            $table->string('misi')->nullable() -> comment("Khusus untuk role bupati dan wakil");
            $table->string('foto_calon_bupati_wakil')->nullable();
            $table->text('deskripsi_tambahan_calon')->nullable();
            $table->boolean('muncul_dalam_pemilihan')->default(true);

            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
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
};
