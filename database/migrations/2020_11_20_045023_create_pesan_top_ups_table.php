<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTopUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan_top_ups', function (Blueprint $table) {
            $table->id();
            $table->string('game');
            $table->string('userID');
            $table->string('nominal');
            $table->double('harga');            
            $table->string('pembayaran');
            $table->string('uname');
            $table->string('konfirmasi');
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
        Schema::dropIfExists('pesan_top_ups');
    }
}
