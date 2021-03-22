<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aruskas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashflows', function (Blueprint $table) {
            $table->id();
            $table->enum('aliran', ['penerimaan', 'pengeluaran'])->nullable();
            $table->enum('kategori', ['operasional', 'pendanaan', 'investasi'])->nullable();
            $table->string('nama', 100)->nullable();
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
        Schema::dropIfExists('cashflows');
    }
}
