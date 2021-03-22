<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rekening extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent')->nullable();
            $table->integer('head')->nullable();
            $table->string('kode_akun', 30)->nullable();
            $table->string('nama_akun', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('tipe_akun')->nullable();
            $table->integer('level')->nullable();
            $table->string('sn', 2)->nullable();
            $table->bigInteger('period_id')->nullable();
            $table->double('begining_balance')->nullable();
            $table->bigInteger('link_id')->nullable();
            $table->integer('endpoin')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
