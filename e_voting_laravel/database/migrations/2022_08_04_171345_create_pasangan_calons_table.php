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
        Schema::create('pasangan_calons', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasangan') -> nullable();
            $table->bigInteger('id_calon_bupati');
            $table->bigInteger('id_calon_wakil_bupati');
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
        Schema::dropIfExists('pasangan_calons');
    }
};
