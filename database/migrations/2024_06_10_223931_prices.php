<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prices', function(Blueprint $table){
            $table->id();
            $table->float('value');
            $table->timestamps();
            $table->date('drop_at');

            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('type_of_vehicle_id');

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_of_vehicle_id')->references('id')->on('type_of_vehicles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
