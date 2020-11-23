<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerlangganansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berlangganans', function (Blueprint $table) {
            $table->id();
            $table->string('aplikasi');
            $table->string('email');
            $table->string('jenisLangganan');
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
        Schema::dropIfExists('berlangganans');
    }
}
