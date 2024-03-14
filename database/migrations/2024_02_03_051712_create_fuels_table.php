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
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle')->default(0);
            $table->integer('driver')->default(0);
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('total_amount')->default(0);
            $table->string('fuel_location')->nullable();
            $table->integer('meter_reading')->nullable();
            $table->string('receipt')->nullable();
            $table->text('notes')->nullable();
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('fuels');
    }
};
