<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooking', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('mesyuarat')->nullable();
            $table->date('tarikhMula')->nullable();
            $table->date('tarikhTamat')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('pengerusi')->nullable();
            $table->string('makanan')->nullable();
            $table->string('minuman')->nullable();
            $table->string('bil_ahli')->nullable();
            $table->string('nama_pemohon')->nullable();
            $table->string('email_pemohon')->nullable();
            $table->string('jawatan_pemohon')->nullable();
            $table->string('bahagian_pemohon')->nullable();
            $table->string('ext_pemohon')->nullable();
            $table->string('pengesahan_pemohon')->nullable();
            $table->string('tarikh_pemohon')->nullable();
            $table->string('pengesahan_bkp')->nullable();
            $table->string('nama_bkp')->nullable();
            $table->string('tarikh_bkp')->nullable();
            $table->string('catatan_bkp')->nullable();
            $table->string('lampiran1')->nullable();
            $table->string('lampiran2')->nullable();
            $table->string('mohon_tukar')->nullable();
            $table->string('catatan_tukar')->nullable();
            $table->string('sn')->nullable();
            $table->string('sah_tukar')->nullable();
            $table->string('ext2')->nullable();
            $table->string('ext3')->nullable();
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
        Schema::dropIfExists('ebooking');
    }
}
