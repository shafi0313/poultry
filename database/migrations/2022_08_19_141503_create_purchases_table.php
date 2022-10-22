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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sub_farm_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type',['chicken','feed']);
            $table->integer('quantity');
            $table->date('date');
            $table->boolean('status')->default(0)->comment('1=closed');
            $table->string('tran');
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
        Schema::dropIfExists('purchases');
    }
};
