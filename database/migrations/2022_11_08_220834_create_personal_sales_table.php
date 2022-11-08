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
        Schema::create('personal_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name', 80)->nullable();
            $table->string('phone', 80)->nullable();
            $table->string('address', 80)->nullable();
            $table->tinyInteger('age');
            $table->integer('quantity');
            $table->decimal('weight',8,3);
            $table->decimal('price',8,2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_sales');
    }
};
