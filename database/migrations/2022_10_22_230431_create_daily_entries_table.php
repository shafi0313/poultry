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
        Schema::create('daily_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('farm_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sub_farm_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('dead')->nullable();
            $table->tinyInteger('reject')->nullable();
            $table->tinyInteger('feed')->nullable();
            $table->date('date')->index();
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
        Schema::dropIfExists('daily_entries');
    }
};
