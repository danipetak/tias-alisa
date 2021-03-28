<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HeaderTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('period_id')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->string('reff', 5)->nullable();
            $table->integer('nomor')->nullable();
            $table->text('uraian')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->text('informasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('headers');
    }
}
