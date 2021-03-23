<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headlists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('header_id')->nullable();
            $table->bigInteger('account_id')->nullable();
            $table->bigInteger('cashflow_id')->nullable();
            $table->decimal('debit', 20, 2)->default(0.00);
            $table->decimal('kredit', 20, 2)->default(0.00);
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
        Schema::dropIfExists('headlists');
    }
}
