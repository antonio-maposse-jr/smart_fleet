<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->integer('inspector')->default(0);
            $table->date('inspection_date')->nullable();
            $table->integer('vehicle')->default(0);
            $table->integer('meter_reading_outgoing')->default(0);
            $table->integer('meter_reading_incoming')->default(0);
            $table->date('outgoing_date')->nullable();
            $table->time('outgoing_time')->nullable();
            $table->date('incoming_date')->nullable();
            $table->time('incoming_time')->nullable();
            $table->text('details')->nullable();
            $table->text('notes')->nullable();
            $table->integer('parent_id');
            $table->string('status')->nullable();
            $table->string('repair_status')->nullable();
            $table->string('fuel_level_outgoing')->nullable();
            $table->string('fuel_level_incoming')->nullable();
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
        Schema::dropIfExists('inspections');
    }
};
